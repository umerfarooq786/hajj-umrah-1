@extends('admin_layouts.auth')
@section('content')
<div class="px-3 px-md-0 mt-5 pt-3">

         <div class="mt-3">
            <div class="p-3 bg-white border_radius">
                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Fast Lines!</b>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                @endif

                @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
               <h4 class="text-center py-3">User Login</h4>
               <form method="POST" action="{{ route('login') }}"> 
                        @csrf
                   <div class="form-group">
                      <label for="email" style="font-size: 13px;font-weight: 500" class="w-100"> Email <span
                            class="float-right"><i class="fa fa-info-circle"></i> </span></label>
                      <input type="email" name="email" class="form-control p-2" placeholder="Enter an email" data-placement="top"
                         data-toggle="tooltip" title="Enter an email" id="email">
                   </div>

                   <div class="form-group">
                      <label for="password" style="font-size: 13px;font-weight: 500" class="w-100">Password <span
                            class="float-right"><i class="fa fa-info-circle"></i> </span></label>
                      <input type="password" name="password" class="form-control p-2" data-placement="top" data-toggle="tooltip"
                         title="Enter password" placeholder="Enter password" id="password">
                   </div>
                   <div class="d-flex justify-content-between align-items-center mb-3">
                      <div class="form-group form-check mb-0">
                         <input type="checkbox"  name="remember" class="form-check-input" id="exampleCheck1">
                         <label class="form-check-label" for="exampleCheck1">&nbsp; <small>Remember me </small></label>
                      </div>
                      <small><a href="{{ route('password.request') }}">Forgot Password</a></small>
                   </div>
                   <div>
                      <a href="index.html" class="w-100">
                         <button class="btn btn-primary w-100">Login</button>
                      </a>
                   </div>
               </form>
               <div class="text-center text-muted py-3">or</div>
               <div class="mb-2 social_share d-flex justify-content-center align-items-center">
                  <a href="#">
                     <i class="fa mx-2 fa-facebook"></i>
                  </a>
                  <a href="#">
                     <i class="fa mx-2 fa-google"></i>
                  </a>
                  <a href="#">
                     <i class="fa mx-2 fa-linkedin"></i>
                  </a>
               </div>
               <div class="text-center">
                  <small class="text-muted"> if you don't have an account. <a href="{{ route('register')}}"><b>Sign up</b></a></small>
               </div>

            </div>
         </div>
      </div>
      <!-- <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                      <h3>FAST LINES</h3>
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Login with FAST LINES</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}" novalidate>
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" name="email" class="form-control form-control-lg input-lg" id="user-name" placeholder="Your Email"
                        required>
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" name="password" class="form-control form-control-lg input-lg" id="user-password"
                        placeholder="Enter Password" required>
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            <input type="checkbox" id="remember-me" class="chk-remember">
                            <label for="remember-me"> Remember Me</label>
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                      </div>
                      <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="">
                    <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>
                    <p class="float-sm-right text-center m-0">New to Moden Admin? <a href="register-simple.html" class="card-link">Sign Up</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div> -->

@section('script')
<script type="text/javascript">
      window.setTimeout(function() {
          $(".alert").fadeTo(2000, 0).slideUp(2000, function(){
              $(this).remove(); 
          });
      }, 2000);
</script>
@endsection
@endsection