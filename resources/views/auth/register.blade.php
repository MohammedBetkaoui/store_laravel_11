@extends('auth.master')
@section('title', 'Register')

@section('content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">
  <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-sm">
    <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
    <div class="tx-center mg-b-30">Create your account to continue</div>

    <form id="registerForm">
      @csrf
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
        <small class="text-danger" id="error-name"></small>
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        <small class="text-danger" id="error-email"></small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        <small class="text-danger" id="error-password"></small>
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
        <small class="text-danger" id="error-password_confirmation"></small>
      </div>
      <div class="form-group tx-12">
        By clicking the Sign Up button, you agree to our <a href="#">Privacy Policy</a> and <a href="#">Terms of Use</a>.
      </div>
      <button type="submit" class="btn btn-info btn-block" id="registerButton">Sign Up</button>
    </form>

    <div class="mg-t-30 tx-center">Already have an account? <a href="{{ route('login') }}" class="tx-info">Sign In</a></div>
  </div>
</div>

<script>
  document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const submitButton = document.getElementById('registerButton');
    const errorFields = ['name', 'email', 'password', 'password_confirmation'];

    // Clear previous error messages
    errorFields.forEach(field => {
      document.getElementById(`error-${field}`).innerText = '';
    });

    submitButton.disabled = true;
    submitButton.innerText = 'Processing...';

    fetch('{{ route('register') }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'Accept': 'application/json',
      },
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw response;
      }
      return response.json();
    })
    .then(data => {
      if (data.errors) {
        for (let key in data.errors) {
          document.getElementById(`error-${key}`).innerText = data.errors[key][0];
        }
      } else if (data.success) {
        alert('Registration successful!');
        window.location.href = '{{ route('home') }}';
      }
    })
    .catch(async (error) => {
      if (error.json) {
        const errorData = await error.json();
        for (let key in errorData.errors) {
          document.getElementById(`error-${key}`).innerText = errorData.errors[key][0];
        }
      } else {
        window.location.href = '{{ route('home') }}';      }
    })
    .finally(() => {
      submitButton.disabled = false;
      submitButton.innerText = 'Sign Up';
    });
  });
</script>
@endsection