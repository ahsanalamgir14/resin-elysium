function changeType() {
    var type = $("#password").attr('type');
    switch (type) {
        case 'password':
            {
                $("#password").attr('type', 'text');
                $(".type-text").show();
                $(".type-pass").hide();
                return;
            }
        case 'text':
            {
                $("#password").attr('type', 'password');
                $(".type-text").hide();
                $(".type-pass").show();
                return;
            }
    }
}

function changeTypeConfirm() {
    var type = $("#password-confirm").attr('type');
    switch (type) {
        case 'password':
            {
                $("#password-confirm").attr('type', 'text');
                $(".type-text-confirm").show();
                $(".type-pass-confirm").hide();
                return;
            }
        case 'text':
            {
                $("#password-confirm").attr('type', 'password');
                $(".type-text-confirm").hide();
                $(".type-pass-confirm").show();
                return;
            }
    }
}

$('tr[data-href]').on("click", function (e) {
    var status = $(e.target).hasClass('admin-status');
    var del = $(e.target).hasClass('delete-btn');
    var actions = $(e.target).hasClass('actions');
    // alert(status);
    // alert(del);
    try {
        if (del || status || actions) {
            throw "exit";
            return false;
        }
        else {
            // alert('redirecting ');
            document.location = $(this).data('href');
        }
    } catch (e) {
        console.log(e);
    }
});


function add_to_cart(el, product_id) {
    
    k = 0;
    var quotes = [];
    var qty = $(el).parent().find("input").val();
    if (!qty) {
        qty = 1;
    }
    var no_of_quotes = $('#no_of_quotes').val();
    $('#dynamic-quotes input').each(function () {
        quotes[k++] = $(this).val();
    });

    $.ajax({
        url: 'api/add-to-cart',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_id: product_id,
            qty: qty,
            no_of_quotes: no_of_quotes,
            quotes: quotes
        },
        success: function (data) {
            if (data.status) {
                window.location.reload();
            }
        }
    });
}

function submit_order() {
    var payment = $('input[name="payment_type"]');
    if (payment.is(':checked')) {
        // alert($('input[name="payment_type"]:checked').val() === 'card');
        if ($('input[name="payment_type"]:checked').val() === 'card') {
            if ($('#card_name').val() != '' && $('#card_number').val() != '' && $('#card_cvc').val() != ''
                && $('#card_month').val() != '' && $('#card_year').val() != '') {
                number = $('.card-number').val();
                var $form = $("#orderForm");
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);

                function stripeResponseHandler(status, response) {
                    if (response.error) {
                        $('.stripe-error')
                            .removeClass('hide')
                            .html(response.error.message);
                    } else {
                        /* token contains id, last4, and card type */
                        var token = response['id'];
                        var $form = $("#orderForm");
                        // return token;
                        $form.find('input[type=text]').empty();
                        $form.append("<input form='orderForm' type='hidden' name='source' value='" + token + "'/>");
                        $form.get(0).submit();
                    }
                }
            } else {
                alert('Please select enter card details');
            }
        } else {
            $('#orderForm').trigger('submit');
        }
    }
    else {
        alert("Please select payment type to place order.");
    }
}

function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;

}

function CreatePDFfromHTML(id) {
    var HTML_Width = $(".pdf-content").width();
    var HTML_Height = $(".pdf-content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".pdf-content")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) {
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
        }
        pdf.save(id + "-invoice.pdf");
        // $(".pdf-content").hide();
    });
}

function applyFilter() {
    $('#filterForm').trigger('submit');

    // var form = $('#catCheckFilters')[0];
    // var data = new FormData(form);
    // console.log(data);
    // $.ajax({
    //     type: 'POST',
    //     enctype: 'multipart/form-data',
    //     url: '/api/products-filter',
    //     data: data,
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     processData: false,
    //     contentType: false,
    //     cache: false,
    //     // dataType: 'json',
    //     success: function (res) {
    //         if (res.status) {

    //         }
    //     },
    //     error: function (res) {
    //     }
    // });
    // alert('Filter will be applied'); 
}

async function countryChange(code) {
    $.ajax({
        type: 'get',
        // data: {'code': code},
        url: '/api/get-states?code=' + code,
        dataType: 'json',
        success: function (res) {
            if (res.status) {
                var select = $('#selectState').empty();
                select.append('<option value="">--Select State </option>');
                $.each(res.data, function (i, item) {
                    select.append('<option value="'
                        + item.code
                        + '">'
                        + item.name
                        + '</option>');
                });
            }
        },
        error: function (res) {
            var select = $('#selectState').empty();
            select.append('<option value="">--Please Select Country First</option>');
        }
    });
}

function stateChange(code) {
    $.ajax({
        type: 'get',
        // data: {'code': code},
        url: '/api/get-cities?code=' + code,
        dataType: 'json',
        success: function (res) {
            if (res.status) {
                var select = $('#selectCity').empty();
                select.append('<option value="">--Select City </option>');
                $.each(res.data, function (i, item) {
                    select.append('<option value="'
                        + item.code
                        + '">'
                        + item.name
                        + '</option>');
                });
            }
        },
        error: function (res) {
            var select = $('#selectState').empty();
            select.append('<option value="">--Please Select State First</option>');
        }
    });
}

//page loads
$(function () {
    var countryCode = $('#selectCountry').val();
    var stateCode = $('#stateCode').val();
    var cityCode = $('#cityCode').val();

    if (countryCode) {
        countryChange(countryCode);
        setTimeout(
            function () {
                $('#selectState option[value=' + stateCode + ']').prop("selected", true);
            }, 1000
        );
        stateChange(stateCode);
        setTimeout(
            function () {
                $('#selectCity option[value=' + cityCode + ']').prop("selected", true);
            }, 1000
        );
    }
});

$(function () {
    sort = 'name_desc';
    $('#sort_by_filter').val(sort);

    // $('#sort option')
    //     .removeAttr('selected')
    //     .filter(`[value='${bladeVariables.sortBy}']`)
    //     .attr('selected', true);
    // $(`#sort option[value='${bladeVariables.sortBy}']`).prop("selected", true);
    // var value = $('#sort').val();
    // console.log('value :', value);

    // var dd = $('#sort > option').each(function() {
    //     if(this.value == sort){
    //         alert(this.text + ' ' + this.value);

    //         $(this).prop("selected", true);
    //         $(this).find(`option[value='${sort}']`).prop('selected', true);

    //     }
    // });
    // console.log('dd :', dd);


    // $(`#sort option[name="${bladeVariables.sortBy}"]`).prop("selected", true);
    // $('#sort option[value=' + bladeVariables.sortBy + ']').prop("selected", true);
});

function clearFilters() {
    $('#filterForm').val();
    $(':input', '#filterForm')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
    // this.applyFilter();
}

function update_cart(elem, product_id, user_id) {
    // alert(value);
    var $button = $(elem);
    console.log('$button :', $button);
    var oldValue = $button.parent().find("input").val();
    console.log('oldValue :', oldValue);
    if ($button.hasClass('inc')) {
        var newVal = parseFloat(oldValue) + 1;
        $button.parent().find("input").val(newVal);
    } else if ($button.hasClass('dec')) {
        // Don't allow decrementing below zero
        if (oldValue > 1) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 1;
        }
        $button.parent().find("input").val(newVal);
    }
    var qty = $button.parent().find("input").val();
    // return;
    $.ajax({
        url: 'api/update-cart',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_id: product_id,
            user_id: user_id,
            qty: qty
        },
        success: function (data) {
            window.location.reload();
        }
    });
}

function delete_cart_item(elem, product_id, user_id) {
    var $tr = $(elem).parents('tr');
    console.log('elem :', elem);
    var ddd = $(elem).html();
    console.log('ddd :', ddd);
    $tr.remove();
    $.ajax({
        url: 'api/delete-cart-item',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_id: product_id,
            user_id: user_id,
        },
        success: function (data) {
            if (data.status) {

            }
            else {
                $('.table').children('tbody').append('<tr>' + $tr.html() + '</tr>');
            }
            // window.location.reload();
        }
    });
}

function changeOrderStatus(order_id) {
    var newStatus = $('#admin-status-' + order_id).val();
    // alert(newStatus);
    // return;
    $.ajax({
        url: '/api/change-order-status',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            order_id: order_id,
            order_status: newStatus,
        },
        success: function (data) {
            if (data.status) {
                window.location.reload();
            }
        }
    });
}

function deleteCategory() {
    $('#submit_delete').submit();
    // alert('deleted');
}

$('#orderForm :input').change(function (e) {
    $('.stripe-error').addClass('hide');
});


$('#no_of_quotes').on('change', function () {
    var i = $('#no_of_quotes').val();

    var contentToRemove = document.querySelectorAll("#dynamic-quotes");
    // var values = $("input[name='quotes[]']")
    //     .map(function () { return $(this).val(); }).get();
    // alert(values);

    var arr = [];
    k = 0;
    $('#dynamic-quotes input').each(function () {
        arr[k++] = $(this).val();
    });
    $(contentToRemove).remove();
    var section = $('#quotes-copy');
    for (var j = 1; j <= i; j++) {
        html = '<div class="row" id="dynamic-quotes">' +
            '<div class="col-md-12 form-group">' +
            '<label for="quote-"' + j + 'class="control-label">Quote' + j + '</label>';
        if (j < i) {
            html += '<input id="quote-"' + j + 'value="" name="quotes[]" type="text" class="form-control" value="' + arr[j - 1] + '">'
        } else {
            html += '<input id="quote-"' + j + 'value="" name="quotes[]" type="text" class="form-control" value="">';
        }
        html += '</div>' +
            '</div>';
        $(html).insertBefore(section);
    }

});
function updateQuotes() {
    var section = $('#quotes-copy');
    var i = $('#no_of_quotes').val();
    alert(i);

    $(html).insertBefore(section);
}

function loadAddToCartModal(product) {
    let body = '<div class="row">' +
                    '<div class="col-lg-12">' +
                        '<p>This Product require ' + product.no_of_quotes + ' Fields to insert or review. Following quotes will be printed on your Art work.</p>' +
                    '</div>' +
                '</div>';
    body += `<div class="row">
                <input id="no_of_quotes" value="${product.no_of_quotes}" name="no_of_quotes[]" type="hidden">
                    <div class="col-md-12">`;
    product.quotes.forEach(function (quote, key) {
        body += `<div class="row" id="dynamic-quotes">
                            <div class="col-md-12 form-group">
                                <label for="quote-${key + 1}" class="control-label">Quote ${key + 1}</label>
                                <input id="quote" value="${quote}" name="quotes[]" type="text"
                                    class="form-control" >
                            </div>
                        </div>`;
    });
    body += `</div>
                </div>
                <div class="row">
                    <div class="col-lg-12 float-right">
                        <div class="feedback-btn pb-15">
                            <a href="javascript:void(0)" class="add-to-cart" type="button" onclick="add_to_cart(this, ${product.id})">Add to cart</a>
                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                        </div>
                    </div>
                </div>`;

    $('#addToCartHome .modal-body').html(body);
    $('#addToCartHome').modal('show');
}

$(function () {
    let html = '';
    $.ajax({
        url: 'api/get-cart-items',
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.items != 0) {
                $('.cart-item-count').html(data.items);
                let totalHtml = `Rs. ${data.cart_total}.00 <span class="cart-item-count">${data.items}</span>`;
                $('.item-text').html(totalHtml);
            }
            if (data.cart_items.length > 0) {
                data.cart_items.forEach(function (item, index) {
                    html += `<li>
                                <a href="" class="minicart-product-image">
                                    <img class="minicart-image"
                                        src="storage/products/${item.main_image}"
                                        alt="cart products">
                                </a>
                                <div class="minicart-product-details">
                                    <h6><a href="single-product.html">${item.name}</a></h6>
                                    <span>${item.price} x ${item.qty}</span>
                                </div>
                                <button class="close" title="Remove">
                                    <i class="fa fa-close"></i>
                                </button>
                            </li>`;
                });
                $('.minicart-product-list').html(html);
                let html2 = `<p class="minicart-total">SUBTOTAL: <span>Rs.  ${data.cart_total}.00</span></p>
                            <div class="minicart-button">
                                <a href="{{ url('cart-view') }}"
                                    class="li-button li-button-fullwidth li-button-dark">
                                    <span>View Full Cart</span>
                                </a>
                                <a href="/checkout-view"
                                    class="li-button li-button-fullwidth">
                                    <span>Checkout</span>
                                </a>
                            </div>`;
                $('.minicart').append(html2);
            }
        }
    });
});

$(function () {
    $("#example1").DataTable({
         lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All'],
        ],
        "order": [[ 1, 'asc' ]],
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "select": true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});