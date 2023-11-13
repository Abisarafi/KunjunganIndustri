


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> 
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <title>Kunjungan Industri SIMS Lifemedia</title>
  </head>
  <body>



    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
    @endif
  
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url({{ url('assets/images/kunjungan-industri.jpg') }});"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
              <div class="login-snip">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
		
            <h3>Halo, Selamat Datang Kembali !</h3>
            <p class="mb-4">Silahkan login ke akun Anda</p>
            {{-- <form action="root/public/sesi/login" method="POST"> --}}
              <form action="/register" method="POST">
              @csrf
              <div class="form-group first">
                <label for="username">Nama</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="form-group">
                <label for="username">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="your-email@gmail.com" id="email" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Your Password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
              </div>
              <div class="form-group last mb-3">
                <label for="password-confirm">Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
              

              <input type="submit" name="submit" value="Log In" class="btn btn-block btn-primary">
            </form>
          </div>
          <br>
          @guest
          <p class="mb-4">Sudah punya akun? <a href="{{ route('login') }}">masuk sekarang</a> </p>
          @endguest
        </div>
      </div>
    </div>

    
  </div>


    
    

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
  </body>
</html>