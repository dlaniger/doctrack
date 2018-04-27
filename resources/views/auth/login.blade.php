@extends('layouts.app')

@section('content')
<div class="account-container">

    <div class="content clearfix">

       <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        
        <h1>User Login</h1>       

        <div class="login-fields">

            <p>Please provide your details</p>

            <div class="field">
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control login username-field" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color:red!important">{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

        </div> <!-- /field -->

        <div class="field">
          <div class="col-md-6">
            <input id="password" type="password" class="form-control login password-field" placeholder="Password" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong style="color:red!important">{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

    </div> <!-- /password -->

</div> <!-- /login-fields -->

<div class="login-actions">

 <div class="form-group">

    <button type="submit" class="button btn btn-success btn-large">Sign In</button>

</div> <!-- .actions -->

</div>

</form>

</div> <!-- /content -->

</div> <!-- /account-container -->



<div class="login-extra">
   <a class="" href="{{ route('password.request') }}">
        Forgot Your Password?
    </a>
</div>  --><!-- /login-extra

@endsection
