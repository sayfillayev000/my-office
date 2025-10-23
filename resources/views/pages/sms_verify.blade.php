<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"> 
    <title>SMS Verify - Synterra</title> 
    <link rel="icon" type="image/png" href="{{ secure_asset('assets/img/favicon.png') }}"> 

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        body {
            background: #f5f8fa;
            font-family: 'Roboto', sans-serif;
        }
        .verify-box {
            max-width: 420px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head> 

<body>
    <div class="container">
        <div class="verify-box text-center">
            <h2 class="mb-3">SMS Verify </h2>
            @if(session('code'))
                <div class="alert alert-info">
                    Test uchun SMS kod: <strong>{{ session('code') }}</strong>
                </div>
            @endif
            <p class="text-muted">Telefon raqamingizga yuborilgan 4 xonali kodni kiriting</p>

            <form method="POST" action="{{ app()->environment('local') ? url('/sms-verify') : secure_url('/backm/sms-verify') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" 
                           class="form-control text-center fs-3" 
                           id="code" 
                           name="code" 
                           maxlength="4" 
                           placeholder="----" 
                           required>
                    <label for="code">Kodni kiriting</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Tasdiqlash</button>
            </form>

            <div>
                <small class="text-muted">Kodni olmadingizmi?</small><br>
                <form method="POST" action="{{ app()->environment('local') ? url('/sms-resend') : secure_url('/backm/sms-resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0">Qayta yuborish</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
