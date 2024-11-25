
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="{{ asset('public/css/login_signup.css') }}" rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="container">
        <div class="form-container" id="login-form">
            <div >
                <a class="logo" href="{{ url('/home') }}">        
                  <img src="{{ asset('public/images/logo.png') }}" alt="Logo" class="logo">
                </a>
            </div>
            <h2>Đăng nhập</h2>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="login-username">Tài khoản</label>
                    <input type="text" id="login-username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="login-password">Mật khẩu</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                <button type="submit">Đăng nhập</button>
                <p><a href="">Quên mật khẩu?</a></p>
                <p>Nếu bạn chơi có tài khoản <a href="{{ url('/signup') }}" id="show-register">Đăng kí tại đây</a></p>
            </form>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>