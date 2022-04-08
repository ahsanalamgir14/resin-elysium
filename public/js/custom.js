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
    alert(product_id, qty);
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
            if(data.status){
                window.location.reload();
            }
        }
    });
}