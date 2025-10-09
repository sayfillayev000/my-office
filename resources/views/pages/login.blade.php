<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- Required meta tags  --> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover"> 
    <meta http-equiv="x-ua-compatible" content="ie=edge"> 
 
    <title>Synterra</title> 
    <link rel="icon" type="image/png" href="https://my.synterra.uz/assets/img/favicon.png"> 
 
    <!-- Fonts --> 
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap-grid.min.css" integrity="sha512-dOjUSaLkr6G2pwQ7ry9juX+iXw5602zg1kg8yH+guR3uSEidGyCnOEQnGlr7xwu/8WE+pVm1ZNqaIs5ETTIJQg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:wght@100;400;500;600&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet"> 
    <style> 
        :root { 
            --adminuiux-content-font: 'Roboto'; 
            --adminuiux-content-font-weight: 400; 
            --adminuiux-title-font: "Fira Sans Condensed"; 
            --adminuiux-title-font-weight: 500; 
        } 
    </style> 
 
    <script defer src="https://my.synterra.uz/assets/js/app.js?7e4316178ad989670ad8"></script><link href="https://my.synterra.uz/assets/css/app.css?7e4316178ad989670ad8" rel="stylesheet"> 
</head> 

  <body class="main-bg main-bg-opac main-bg-blur adminuiux-sidebar-fill-white adminuiux-sidebar-boxed theme-blue roundedui" data-theme="theme-blue" data-sidebarfill="adminuiux-sidebar-fill-white" data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" tabindex="0">
      <main class="flex-shrink-0 pt-0 h-100">
        <div class="container-fluid">
          <div class="auth-wrapper">

            <!-- login wrap -->
            <div class="row gx-3">
              <div class="col-12 col-md-6 col-xl-4 minvheight-100 d-flex flex-column px-0">
                  <div class="h-100 px-2 py-3">
                    <div class="row gx-3 h-100 align-items-center justify-content-center mt-md-3">
                      <div class="col-12 col-sm-8 col-md-11 col-xl-11 col-xxl-10 login-box">
                        <div class="text-center mb-3">
                          <h1 class="mb-2">Welcome&#9996;</h1>
                          <p class="text-secondary">Enter your credential to login</p>
                        </div>
                        <div class="position-relative">
                            <form method="POST" action="/backm/login" id="login-form">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" maxlength="19" required value="{{ old('phone') }}">
                                    <label for="phone">Phone</label>

                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-lg btn-theme w-100 mb-3">Login</button>
                            </form>
                        </div>

                    
                        <br>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="col-12 col-md-6 col-xl-8 p-4 d-none d-md-block">
                <div class="card adminuiux-card bg-theme-1-space position-relative overflow-hidden h-100">
                  <div class="position-absolute start-0 top-0 h-100 w-100 coverimg opacity-75 z-index-0">
                    <img src="assets/img/background-image/backgorund-image-8.jpg" alt="">
                  </div>
                  <div class="card-body position-relative z-index-1">
                    <div class="row h-100 d-flex flex-column justify-content-center align-items-center gx-0 text-center">
                      <div class="col-10 col-md-11 col-xl-8 mb-4 mx-auto">

                        <!-- Slider container -->
                        <div class="swiper swipernavpagination pb-5">
                          <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                              <img src="assets/img/investment/slider.png" alt="" class="mw-100 mb-3">
                              <h2 class="text-white mb-3">Create and Manage your Investment appointments easily at your own very personalized space.</h2>
                              <p class="lead opacity-75">You are at the best Adminuiux Investment UX<br>HTML template demo preview</p>
                            </div>
                            <div class="swiper-slide">
                              <img src="assets/img/investment/slider.png" alt="" class="mw-100 mb-3">
                              <h2 class="text-white mb-3">Create and Manage your Investment appointments easily at your own very personalized space.</h2>
                              <p class="lead opacity-75">You are at the best Adminuiux Investment UX<br>HTML template demo preview</p>
                            </div>
                            <div class="swiper-slide">
                              <img src="assets/img/investment/slider.png" alt="" class="mw-100 mb-3">
                              <h2 class="text-white mb-3">Create and Manage your Investment appointments easily at your own very personalized space.</h2>
                              <p class="lead opacity-75">You are at the best Adminuiux Investment UX<br>HTML template demo preview</p>
                            </div>
                          </div>
                          <!-- pagination -->
                          <div class="swiper-pagination white bottom-0"></div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </main>
      <script>
document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.getElementById("phone");
    const form = document.getElementById("login-form");

    // Dastlab +998 chiqib turadi
    phoneInput.value = "+998 ";

    phoneInput.addEventListener("input", function () {
        let val = this.value;

        // +998 ni o‘chirib bo‘lmaydi
        if (!val.startsWith("+998 ")) {
            val = "+998 ";
        }

        // Faqat raqamlarni olib qolamiz (prefixdan tashqari)
        let digits = val.replace("+998", "").replace(/\D/g, "");

        // 9 ta raqamdan ko‘p yozilmasin
        digits = digits.substring(0, 9);

        // Formatlash: 99 123 45 67
        let formatted = "";
        if (digits.length > 0) formatted = digits.substring(0, 2);
        if (digits.length >= 3) formatted += " " + digits.substring(2, 5);
        if (digits.length >= 6) formatted += " " + digits.substring(5, 7);
        if (digits.length >= 8) formatted += " " + digits.substring(7, 9);

        this.value = "+998 " + formatted.trim();
    });

    // Form yuborishda faqat 9 ta raqam ketadi
    form.addEventListener("submit", function () {
        let raw = phoneInput.value.replace(/\D/g, ""); // faqat raqam
        let userPart = raw.substring(3); // +998 ni olib tashlaymiz
        phoneInput.value = userPart; // backendga faqat 9 ta raqam ketadi
    });
});
</script>

      <script src="https://my.synterra.uz/assets/js/investment/investment-auth.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js" integrity="sha512-nKXmKvJyiGQy343jatQlzDprflyB5c+tKCzGP3Uq67v+lmzfnZUi/ZT+fc6ITZfSC5HhaBKUIvr/nTLCV+7F+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>

</html>