<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registrasi Kunjungan Industri</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>SIMS</b>Life
  </div>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Buat Akun Kunjungan Industri</p>

      <form action="/register" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input id="name" type="text" placeholder="Your Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" placeholder="Your Email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
              </div>
          </div>
          @error('email')
              <div class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </div>
          @enderror
      </div>
        <div class="input-group mb-3">
          <input type="password" name="password" placeholder="Your Password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
          </div>
      </div>
      <div class="input-group mb-3">
          <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          <div class="input-group-append">
              <div class="input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
          </div>
      </div>
      <div id="password-mismatch" class="alert alert-danger" style="display: none;">
          Passwords do not match!
      </div>
      <div class="input-group mb-3">
        <input type="text" name="noHP" placeholder="Your Telephone Number" id="noHP" class="form-control @error('noHP') is-invalid @enderror" value="{{ old('noHP') }}" required autocomplete="tel">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-phone"></span>
            </div>
        </div>
        @error('noHP')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p>
        Sudah punya akun? <a href="/login" class="text-center">masuk</a>
      </p>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Add an event listener to the password confirmation field
        $('#password-confirm').on('keyup', function () {
            // Get the values of both password fields
            var password = $('#password').val();
            var confirmPassword = $(this).val();

            // Check if the passwords match
            if (password !== confirmPassword) {
                // Show the password mismatch notification
                $('#password-mismatch').show();
            } else {
                // Hide the password mismatch notification if the passwords match
                $('#password-mismatch').hide();
            }
        });
    });
</script>
</body>
</html>
