<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
        background-color: #f7f7f7;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh; /* Menggunakan view height agar card selalu berada di tengah vertikal */
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%; /* Menggunakan view height agar card selalu berada di tengah vertikal */
    }

    .card {
        width: 350px;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        background-color: #fff;
    }

    .card-title {
      font-size: 32px;
      font-weight: bold;
      text-align: center;
      color: #625757;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .btn-login {
        display: block;
        width: 100%;
        background-color: #625757 !important;
        border: none !important;
        color: #fefefe;
    }

    .btn-login:hover {
        color: #fefefe;
    }

    .btn-login:focus, .btn-login:active {
    border-color: #625757 !important;
    }

    .btn-login:focus {
        box-shadow: 0 0 0 0.2rem rgba(98, 87, 87, 0.3) !important;
    }

    .login-footer {
      margin-top: 30px;
      text-align: center;
    }

    .msg {
        width: 350px;
    }


    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(98, 87, 87, 0.3) !important;
        outline: none !important;
        border: none !important;
    }


    .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(98, 87, 87, 0.3) !important;
        outline: none !important;
        border: none !important;
    }

  </style>
</head>


<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if(session('error'))
                    <div class="alert alert-danger msg text-center">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success msg text-center">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <h2 class="card-title text-lg" style="letter-spacing: 2px">LOGIN</h2>
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-login btn-lg mt-5">Sign In</button>
                    </form>
                    <div class="login-footer">
                    <!-- <p>Forgot your password? <br> <a href="#">Reset Password</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
