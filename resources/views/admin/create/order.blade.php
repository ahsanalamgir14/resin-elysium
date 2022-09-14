@extends('layouts.default')
@section('title', 'New Order')
@section('orders', 'active')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <button onclick="history.back()" class="btn btn-success mb-3 mt-3">Go Back</button>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Order</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/manage-orders') }}" method="post" enctype='multipart/form-data'>
                                @csrf
                                <div class="">
                                    <div class="row">
                                        {{-- <h2 class="font-weight-bold pl-2">User Details</h2> --}}
                                        <div class="col-md-12 form-group">
                                            <label for="user_id" class="control-label">User Details</label>
                                            <select id="user_id" name="user_id" type="text" class="form-control"
                                                onchange="getUserDetails(this.value)">
                                                <option value="">Select User</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }}
                                                        {{ $user->last_name }} ({{ $user->email }}) -- {{ $user->role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="invalid-feedback d-inline" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <h2 class="font-weight-bold pl-2 mb-3">Billing Details</h2>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>First Name <span class="required">*</span></label>
                                                <input id="first_name" class="form-control" name="first_name" value=""
                                                    placeholder="" type="text">
                                                @error('first_name')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input id="last_name" class="form-control" name="last_name" value=""
                                                    placeholder="" type="text">
                                                @error('last_name')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input id="email" class="form-control" name="email" value=""
                                                    placeholder="" type="email">
                                                @error('email')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Mobile <span class="required">*</span></label>
                                                <input id="mobile" class="form-control" name="mobile" value=""
                                                    placeholder="" type="text">
                                                @error('mobile')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input id="address" class="form-control" name="address" value=""
                                                    placeholder="Street address" type="text">
                                                @error('address')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Town / City <span class="required">*</span></label>
                                                <input id="city" class="form-control" name="city" value=""
                                                    placeholder="" type="text">
                                                @error('city')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>State <span class="required">*</span></label>
                                                <input id="state" class="form-control" name="state" value=""
                                                    placeholder="" type="text">
                                                @error('state')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>County <span class="required">*</span></label>
                                                <input id="country" class="form-control" name="country" value=""
                                                    placeholder="" type="text">
                                                @error('country')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postcode / Zip <span class="required">*</span></label>
                                                <input id="zip_code" class="form-control" name="zip_code"
                                                    value="" placeholder="" type="text">
                                                @error('zip_code')
                                                    <span class="invalid-feed">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="row mt-3">
                                    <div class="col-md-4 form-group">
                                        <label for="no_of_products" class="control-label">No of Products</label>
                                        <select id="no_of_products" name="no_of_products" type="text" class="form-control" onchange="getProductsForm(this.value)">
                                            <option value="">Select No of Products</option>
                                            @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        @error('product_id')
                                        <span class="invalid-feedback d-inline" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div> --}}

                                    <div class="container row mt-3">
                                        {{-- <h2 class="font-weight-bold pl-2 mb-3">Product Details</h2> --}}
                                        <div class="col-md-4 form-group">
                                            <label for="product_id" class="control-label">Product Details</label>
                                            <select class="selectpicker" multiple id="product_id_select"
                                                name="product_id" class="form-control" onchange="getProductDetails()">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product_id')
                                                <span class="invalid-feedback d-inline" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card" id="product-clone">
                                        <div class="card-header">
                                            <h3 class="card-title">Product 1 Detils</h3>
                                        </div>
                                        <div class="card-body">
                                            {{-- <form id="order-products-form"> --}}
                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group has-success">
                                                        <label for="name" class="control-label">Product Name</label>
                                                        <input id="name" value="{{ old('name') }}" name="name"
                                                            type="text" class="form-control">
                                                        @error('name')
                                                            <span class="invalid-feedback d-inline" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="main_image" class="control-label">Images</label>
                                                        <div style="display: flex" id="images">
                                                            <img id="main_image" width="50px" src=""
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="category_id" class="control-label">Category</label>
                                                    <select id="category_id" name="category_id" type="text"
                                                        class="form-control">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="invalid-feedback d-inline" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="slug" class="control-label">Product Slug</label>
                                                    <input id="slug" value="" name="slug" type="text"
                                                        class="form-control" value="{{ old('slug') }}">
                                                    @error('slug')
                                                        <span class="invalid-feedback d-inline" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="type" class="control-label">Product Type </label>
                                                    <input id="type" value="" name="type" type="text"
                                                        class="form-control" value="{{ old('type') }}">
                                                    @error('type')
                                                        <span class="invalid-feedback d-inline" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="SKU" class="control-label">Product SKU</label>
                                                    <input id="SKU" value="{{ old('SKU') }}" name="SKU"
                                                        type="text" class="form-control">
                                                    @error('SKU')
                                                        <span class="invalid-feedback d-inline" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label for="price" class="control-label">Product Price</label>
                                                    <input id="price" value="{{ old('price') }}" name="price"
                                                        type="text" class="form-control" value="">
                                                    @error('price')
                                                        <span class="invalid-feedback d-inline" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label for="qty" class="control-label">Order Quantity</label>
                                                    <input id="order-qty" value="{{ old('qty') }}" name="qty"
                                                        type="text" class="form-control" value="">
                                                    @error('qty')
                                                        <span class="invalid-feedback d-inline" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 form-group">
                                                    <label for="no_of_quotes" class="control-label">Number of
                                                        Quotes</label>
                                                    <select data-default="0" id="no_of_quotes" name="no_of_quotes"
                                                        type="text" class="form-control variable_priority">
                                                        <option value="">No of Quotes</option>
                                                        @for ($i = 0; $i <= 10; $i++)
                                                            <option value="{{ $i }}"
                                                                {{ $i == 0 ? 'selected' : '' }}>{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    @error('no_of_quotes')
                                                        <span class="invalid-feedback d-inline" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row" id="dynamic-quotes">
                                            </div>
                                            <div id="quotes-copy">
                                            </div>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                    <div id="product-copy"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_type"
                                                    id="cod">
                                                <label class="form-check-label" for="cod">
                                                    Cash on Delivery
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="payment_type"
                                                    id="card" checked>
                                                <label class="form-check-label" for="card">
                                                    Card Payment
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="submit" type="submit" class="btn btn-success btn-block">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
