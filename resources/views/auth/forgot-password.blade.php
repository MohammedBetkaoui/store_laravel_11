@extends('auth.master')
@section('title', 'Forgot Password')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">
    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Starlight <span class="tx-info tx-normal">Admin</span></div>
        <div class="tx-center mg-b-60">Password Reset</div>
        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email">
            </div>
            <button type="submit" class="btn btn-info btn-block loginbtn">Send Reset Link</button>
        </form>

        <div class="mg-t-60 tx-center">Not yet a member? <a href="{{ route('register') }}" class="tx-info">Sign Up</a></div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    $('.loginbtn').click(function(e) {
        e.preventDefault();
        let email = $('#email').val();

        if (email === "") {
            Swal.fire({
                title: 'Error!',
                text: 'Please enter your email',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        } else {
            $.ajax({
                method: 'POST',
                url: '{{ route('password.email') }}',
                data: { email: email },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            });
        }
    });
});
</script>
@endsection
