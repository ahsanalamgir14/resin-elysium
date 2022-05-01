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

$('tr[data-href]').on("click", function () {
    document.location = $(this).data('href');
});


function add_to_cart(el, product_id) {

    var qty = $(el).parent().find("input").val();
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
    if ($('input[name="payment_type"]').is(':checked')) {
        $('#orderForm').trigger('submit');
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
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save(id+"-invoice.pdf");
        // $(".pdf-content").hide();
    });
}