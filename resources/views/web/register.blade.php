@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
    <meta name="description" content="Assambigmart">
  @endsection

  @section('content')
        <!-- site__header / end -->
        <!-- site__body -->
        <div class="site__body">
            <div class="block-header block-header--has-breadcrumb block-header--has-title">
                <div class="container-fluid">
                    <div class="block-header__body">
                        <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb__list">
                                <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                                <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="index.html" class="breadcrumb__item-link">Home</a></li>
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Register</span></li>
                                <li class="breadcrumb__title-safe-area" role="presentation"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="container container-lg">
                    <div class="row">
                        <div class="col-md-8 d-flex" style="margin: 0 auto">
                            <div class="card flex-grow-1 mb-0 ml-0 ml-lg-3 mr-0 mr-lg-4">
                                <div class="card-body card-body--padding--2">
                                    @if (Session::has('message'))
                                    <div class="alert alert-success" >{{ Session::get('message') }}</div>
                                    @endif
                                    @if (Session::has('error'))
                                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                    @endif
                                    <h3 class="card-title">Register</h3>
                                    <form method="POST" action="{{ route("user.register") }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="checkout-phone">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" id="checkout-phone" placeholder="Full Name">
                                            @if($errors->has('full_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('full_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="checkout-email">Email address</label>
                                                <input type="email" class="form-control" name="email" id="checkout-email" placeholder="Email address">
                                                @if($errors->has('email'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="checkout-phone">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="checkout-phone" placeholder="Phone">
                                                @if($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="signup-password">Password</label>
                                            <input id="signup-password" type="password" name="password" class="form-control" placeholder="Secret word">
                                            @if($errors->has('password'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="signup-confirm">Repeat password</label>
                                            <input id="signup-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Secret word">
                                            @if($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-0"> 
                                            <small class="form-text text-muted"><a href="#">Already registered? Login</a></small>
                                            <button type="submit" class="btn btn-primary mt-3">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-space block-space--layout--before-footer"></div>
        </div>
        <!-- site__body / end -->
        <!-- site__footer -->
	@endsection
	
	@section('script')
	@endsection