@include('authentication/header')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="/login">
                @csrf
                <span class="login100-form-title p-b-43 loginform">
                    Tasker Login
                </span>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email Address">
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                </div>
                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">

                    </div>
                </div>
                @if ($errors->has('email'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
                @endif
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn loginform">Login</button>
                </div>
               
            </form>
            <div class="login100-more" style="background-image: url('/authentication/images/bg-01.jpg');"></div>
        </div>
    </div>
</div>

@include('authentication/footer')