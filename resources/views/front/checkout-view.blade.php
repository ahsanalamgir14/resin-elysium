@extends('layouts.frontend')

@section('content')
    <div class="body-wrapper">
        <!-- Begin Li's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{ url('home') }}">Home</a></li>
                        <li><a href="{{ url('checkout') }}">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--Checkout Area Strat-->
    @if (!empty($cart_items))
        <div class="checkout-area pt-60 pb-30">
            <div class="container">
                @if (empty($data))
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-accordion">
                                <!--Accordion Start-->
                                <h3>You are not login to Resin Alysium. Have account <span id="showlogin"> Click here to
                                        login
                                    </span> or <span id="showsignup">Click here to signup</span></h3>
                                <div id="checkout-login" class="coupon-content">
                                    <div class="coupon-info">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <h3>Login Form</h3>
                                            <p class="form-row-first">
                                                <label for="email" class="col-form-label">{{ __('Email') }}<span
                                                        class="required"> *</span></label>
                                                <input id="email" type="email" class="@error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required autocomplete="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </p>
                                            <p class="form-row-last">
                                                <label for="password" class="col-form-label">{{ __('Password') }}<span
                                                        class="required"> *</span></label>
                                                {{-- <div class="checkout-password"> --}}
                                                <input id="password" type="password"
                                                    class="@error('password') is-invalid @enderror" name="password" required
                                                    autocomplete="current-password">
                                                {{-- <div class="input-group-append">
                                                    <span class="input-group-text align-icon" onclick="changeType()">
                                                        <span class="type-text" style="display:none">
                                                            <div><i class="fa fa-eye"></i></div>
                                                        </span>
                                                        <span class="type-pass">
                                                        <div><i class="fa fa-eye-slash"></i></div>
                                                        </span>
                                                    </span>
                                                </div> --}}
                                                {{-- </div> --}}
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </p>
                                            <p>
                                                <input type="hidden" name="checkout_login" value="1">
                                            </p>
                                            <p class="form-row">
                                                <input type="submit"></input>
                                                <label>
                                                    <input type="checkbox">
                                                    Remember me
                                                </label>
                                            </p>
                                            <p class="lost-password"><a href="#">Lost your password?</a></p>
                                        </form>
                                    </div>
                                </div>
                                <div id="checkout-signup" class="coupon-content">
                                    <div class="coupon-info">
                                        <form action="#">
                                            <h3>Signup Form</h3>
                                            <p class="form-row-first">
                                                <label>Username or email <span class="required">*</span></label>
                                                <input type="text">
                                            </p>
                                            <p class="form-row-last">
                                                <label>Password <span class="required">*</span></label>
                                                <input type="text">
                                            </p>
                                            <p class="form-row">
                                                <input value="Login" type="submit">
                                                <label>
                                                    <input type="checkbox">
                                                    Remember me
                                                </label>
                                            </p>
                                            <p class="lost-password"><a href="#">Lost your password?</a></p>
                                        </form>
                                    </div>
                                </div>
                                <!--Accordion End-->
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-6 col-12">
                        @if (!empty($data))
                            <form id="orderForm" method="POST" action="{{ route('place-order') }}"
                                class="require-validation" data-cc-on-file="false"
                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                                @csrf
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>First Name <span class="required">*</span></label>
                                                <input id="first_name" name="first_name" value={{ $data['first_name'] }}
                                                    placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input id="last_name" name="last_name" value={{ $data['last_name'] }}
                                                    placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input id="email" name="email" value={{ $data['email'] }} placeholder=""
                                                    type="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Mobile <span class="required">*</span></label>
                                                <input id="mobile" name="mobile" value={{ $data['mobile'] }}
                                                    placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input id="address" name="address" value={{ $data['address'] }}
                                                    placeholder="Street address" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Town / City <span class="required">*</span></label>
                                                <input id="city" name="city" value={{ $data['city'] }} placeholder=""
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>State <span class="required">*</span></label>
                                                <input id="state" name="state" value={{ $data['state'] }} placeholder=""
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>County <span class="required">*</span></label>
                                                <input id="country" name="country" value={{ $data['country'] }}
                                                    placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postcode / Zip <span class="required">*</span></label>
                                                <input id="zip_code" name="zip_code" value={{ $data['zip_code'] }}
                                                    placeholder="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart_items as $item)
                                            <tr class="cart_item">
                                                <td class="cart-product-name">{{ $item->product->name }}<strong
                                                        class="product-quantity"> × {{ $item->qty }}</strong></td>
                                                <td class="cart-product-total"><span
                                                        class="amount">{{ $item->product->price * $item->qty }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">{{ $total }}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">{{ $total }}</span></strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <label>Select Payment Method: <span class="required">*</span></label>
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <div class="form-check">
                                                    <input form="orderForm" class="form-check-input cod-payment"
                                                        type="radio" name="payment_type" value="cod" id="cod-payment">
                                                    <label class="form-check-label" for="cod-payment">Cash On
                                                        Delivery</label>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" id="#payment-2">
                                                    <div class="form-check">
                                                        <input form="orderForm" class="form-check-input card-payment"
                                                            type="radio" name="payment_type" value="card" id="card-payment">
                                                        <label class="form-check-label" for="card-payment">Card
                                                            Payment</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card" id="card-payment-form">
                                                {{-- <form role="form" action="{{ route('stripe.post') }}" method="post"
                                                    class="require-validation" data-cc-on-file="false"
                                                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                    id="payment-form">
                                                    @csrf --}}
                                                <div class='form-row row mt-5 mb-5'>
                                                    {{-- <div class='col-xs-12 col-md-6 '> --}}
                                                    <div class="col-xs-12 col-md-6 form-group checkout-form-list mb-5">
                                                        <label class='control-label'>Name on Card</label>
                                                        <input form="orderForm" size='4' type='text'>
                                                    </div>
                                                    <div
                                                        class='col-xs-12 col-md-6 form-group checkout-form-list required mb-5'>
                                                        <label class='control-label'>Card Number</label>
                                                        <input form="orderForm" autocomplete='off' class=' card-number'
                                                            size='20' type='text'>
                                                    </div>
                                                </div>
                                                <div class='form-row row mb-5'>
                                                    <div
                                                        class='col-xs-12 col-md-4 form-group cvc checkout-form-list required mb-5'>
                                                        <label class='control-label'>CVC</label>
                                                        <input form="orderForm" autocomplete='off' class=' card-cvc'
                                                            placeholder='ex. 311' size='4' type='text'>
                                                    </div>
                                                    <div
                                                        class='col-xs-12 col-md-4 form-group expiration checkout-form-list required mb-5'>
                                                        <label class='control-label'>Expiration Month</label>
                                                        <input form="orderForm" class=' card-expiry-month' placeholder='MM'
                                                            size='2' type='text'>
                                                    </div>
                                                    <div
                                                        class='col-xs-12 col-md-4 form-group expiration checkout-form-list required mb-5'>
                                                        <label class='control-label'>Expiration Year</label>
                                                        <input form="orderForm" class='card-expiry-year' placeholder='YYYY'
                                                            size='4' type='text'>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <input form="orderForm" type="hidden" name="amount"
                                                        value="{{ $total }}">
                                                    <input form="orderForm" type="hidden" name="currency" value="PKR">
                                                    <input form="orderForm" type="hidden" name="description"
                                                        value="Online Payment">
                                                </div>
                                                {{-- <div class='form-row row'>
                                                    <div class='col-md-12 error form-group hide'>
                                                        <div class='alert-danger alert'>Please correct the errors and try
                                                        again.
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="form-row row">
                                                        <div class="col-xs-12">
                                                            <button class="btn btn-primary btn-sm btn-block"
                                                                type="submit">Pay Now</button>
                                                        </div>
                                                    </div> --}}
                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                            Card Payment
                                        </button> --}}
                                    </div>
                                    <div class="order-button-payment">
                                        @if (empty($data))
                                            <i class="submit-lock-icon fa fa-lock"></i>
                                        @endif
                                        <input value="Place order" type="button" onclick="submit_order()" !empty($data) ? ''
                                            : 'disabled' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="hopping-cart-area pt-60 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="text-center">Your Cart is Empty. <a href="/">Browse latest products here.</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--Checkout Area End-->

    <!-- Delete Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Online Payment Through Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="col-md-12">
                            <div class="panel panel-default credit-card-box">
                                <div class="panel-heading">
                                    <div class="row">
                                        <h3>Payment Details</h3>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success text-center">
                                            <a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">×</a>
                                            <p>{{ Session::get('success') }}</p><br>
                                        </div>
                                    @endif
                                    <br>
                                    <form role="form" action="{{ route('stripe.post') }}" method="post"
                                        class="require-validation" data-cc-on-file="false"
                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                        @csrf
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-6 form-group required'>
                                                <label class='control-label'>Name on Card</label>
                                                <input class='form-control' size='4' type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-6 form-group required'>
                                                <label class='control-label'>Card Number</label>
                                                <input autocomplete='off' class='form-control card-number' size='20'
                                                    type='text'>
                                            </div>
                                        </div>
                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label>
                                                <input autocomplete='off' class='form-control card-cvc'
                                                    placeholder='ex. 311' size='4' type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Month</label>
                                                <input class='form-control card-expiry-month' placeholder='MM' size='2'
                                                    type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Year</label>
                                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                    type='text'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <input type="hidden" name="amount" value="{{ $total }}">
                                            <input type="hidden" name="currency" value="PKR">
                                            <input type="hidden" name="description" value="Online Payment">
                                        </div>
                                        <div class="form-row row">
                                            <div class="col-xs-12">
                                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay
                                                    Now</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {
            if ($('input[name="payment_type"]:checked').val() === "card") {
                var $form = $(".require-validation");
                $('form.require-validation').bind('submit', function(e) {
                    var $form = $(".require-validation"),
                        inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]',
                            'input[type=file]', 'textarea'
                        ].join(', '),
                        $inputs = $form.find('.required').find(inputSelector),
                        $errorMessage = $form.find('div.error'),
                        valid = true;
                    $errorMessage.addClass('hide');
                    $('.has-error').removeClass('has-error');
                    $inputs.each(function(i, el) {
                        var $input = $(el);
                        if ($input.val() === '') {
                            $input.parent().addClass('has-error');
                            $errorMessage.removeClass('hide');
                            e.preventDefault();
                        }
                    });
                    if (!$form.data('cc-on-file')) {
                        e.preventDefault();
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('.card-number').val(),
                            cvc: $('.card-cvc').val(),
                            exp_month: $('.card-expiry-month').val(),
                            exp_year: $('.card-expiry-year').val()
                        }, stripeResponseHandler);
                    }
                });
            }

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='source' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>

@endsection
