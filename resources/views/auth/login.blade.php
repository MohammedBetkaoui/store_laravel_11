@extends('auth.master')
@section('title','login')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
  <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
  <div class="tx-center mg-b-60">Professional Admin Template Design</div>

  <div class="form-group">
    <input type="text" id="email" class="form-control" placeholder="Enter your username">
  </div><!-- form-group -->
  <div class="form-group">
    <input type="password" id="password" class="form-control" placeholder="Enter your password">
    <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
  </div><!-- form-group -->
  <button type="submit" class="btn btn-info btn-block loginbtn">Sign In</button>

  <div class="mg-t-60 tx-center">Not yet a member? <a href="{{route('register')}}" class="tx-info">Sign Up</a></div>
</div><!-- login-wrapper -->
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('.loginbtn').click(function(e) {
        e.preventDefault();
        let email = $('#email').val();
        let password = $('#password').val();

        if (email == "" || password == "") {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter email and password',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        } else {
            $.ajax({
                method: 'POST', // Correction ici
                url: '/user/login',
                data: { // Correction ici (data au lieu de date)
                    email: email,
                    password: password
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) { // Correction de 'seccess' en 'success'
                    if (response.data == 1) {
                      // Redirect to admin dashboard
                      window.location.href = "{{route('admin.dashboard')}}";
                     Swal.fire({
                        title: 'Success!',
                        text: 'Login successful admin ',
                        icon:'success',
                        confirmButtonText: 'Close'
                    });
                    }else if(response.data == 2) {
                      window.location.href = "{{route('home')}}";

                      Swal.fire({
                        title: 'Success!',
                        text: 'Login successful user',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                  }
                  else{
                    Swal.fire({
                        title: 'Error!',
                        text: 'Invalid email or password',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
  }
                },
              
            });
        }
    });
});

</script>
@endsection