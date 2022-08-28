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

    var qty = $(el).parent().find("input").val();
    if (!qty) {
        qty = 1;
    }
    // alert(product_id, qty);
    // $('#add-to-cart-form').preventDefault(e);
    $.ajax({
        url: 'api/add-to-cart',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            product_id: product_id,
            qty: qty
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