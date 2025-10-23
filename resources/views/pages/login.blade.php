<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"> 
    <meta http-equiv="x-ua-compatible" content="ie=edge"> 
    <title>Synterra</title> 
    <link rel="icon" type="image/png" href="https://my.synterra.uz/assets/img/favicon.png"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap-grid.min.css" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:wght@100;400;500;600&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet"> 
    <link href="https://my.synterra.uz/assets/css/app.css?7e4316178ad989670ad8" rel="stylesheet"> 
</head> 

<body class="main-bg main-bg-opac main-bg-blur adminuiux-sidebar-fill-white adminuiux-sidebar-boxed theme-blue roundedui">
    <main class="flex-shrink-0 pt-0 h-100">
        <div class="container-fluid">
            <div class="auth-wrapper">
                <div class="row gx-3">
                    <div class="col-12 col-md-6 col-xl-4 minvheight-100 d-flex flex-column px-0">
                        <div class="h-100 px-2 py-3">
                            <div class="row gx-3 h-100 align-items-center justify-content-center mt-md-3">
                                <div class="col-12 col-sm-8 col-md-11 col-xl-11 col-xxl-10 login-box">
                                    <div class="text-center mb-3">
                                        <h1 class="mb-2">Welcome ✌️</h1>
                                        <p class="text-secondary">Enter your credential to login</p>
                                    </div>

                                    {{-- Umumiy xatolar --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif  

                                    <div class="position-relative">
                                        {{-- 🔥 APP_ENV ga qarab login route tanlash --}}
                                        <form method="POST" 
                                            action="{{ app()->environment('local') ? url('/login') : secure_url('/backm/login') }}" 
                                            id="login-form">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="text" 
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       id="phone" name="phone" required value="{{ old('phone') }}">
                                                <label for="phone">Phone</label>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-lg btn-theme w-100 mb-3">Login</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- O‘ng tarafdagi slider --}}
                    <div class="col-12 col-md-6 col-xl-8 p-4 d-none d-md-block">
                        <div class="card adminuiux-card bg-theme-1-space position-relative overflow-hidden h-100">
                            <div class="position-absolute start-0 top-0 h-100 w-100 coverimg opacity-75">
                                <img src="https://my.synterra.uz/assets/img/background-image/backgorund-image-8.jpg" alt="">
                            </div>
                            <div class="card-body position-relative z-index-1">
                                <div class="row h-100 d-flex flex-column justify-content-center align-items-center text-center">
                                    <div class="col-10 col-md-11 col-xl-8 mb-4 mx-auto">
                                        <div class="swiper swipernavpagination pb-5">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="https://my.synterra.uz/assets/img/investment/slider.png" class="mw-100 mb-3">
                                                    <h2 class="text-white mb-3">Create and Manage your Investment appointments easily.</h2>
                                                    <p class="lead opacity-75">Adminuiux Investment UX demo preview</p>
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="https://my.synterra.uz/assets/img/investment/slider.png" class="mw-100 mb-3">
                                                    <h2 class="text-white mb-3">Track and manage investments easily.</h2>
                                                    <p class="lead opacity-75">You are at the best UX demo preview</p>
                                                </div>
                                            </div>
                                            <div class="swiper-pagination white bottom-0"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const phoneInput = document.getElementById("phone");
            const form = document.getElementById("login-form");

            phoneInput.value = "+998 ";

            phoneInput.addEventListener("input", function () {
                let val = this.value;
                if (!val.startsWith("+998 ")) {
                    val = "+998 ";
                }
                let digits = val.replace("+998", "").replace(/\D/g, "").substring(0, 9);
                let formatted = "";
                if (digits.length > 0) formatted = digits.substring(0, 2);
                if (digits.length >= 3) formatted += " " + digits.substring(2, 5);
                if (digits.length >= 6) formatted += " " + digits.substring(5, 7);
                if (digits.length >= 8) formatted += " " + digits.substring(7, 9);
                this.value = "+998 " + formatted.trim();
            });

            form.addEventListener("submit", function () {
                let raw = phoneInput.value.replace(/\D/g, ""); 
                let userPart = raw.substring(3); 
                phoneInput.value = userPart; 
            });
        });
    </script>

    <script src="https://my.synterra.uz/assets/js/investment/investment-auth.js"></script>
</body>
</html>
