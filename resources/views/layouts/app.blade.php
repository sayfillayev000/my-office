
<!DOCTYPE html> 
<html lang="en"> 
<!-- dir="rtl"--> 
 
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
    <!-- Pageloader --> 
    <div class="pageloader">
        <x-pageloader />
    </div>

    <!-- Header --> 
    <div class="adminuiux-header">
        {{-- Navbar --}}
        <x-navbar />
        <x-search />

        {{-- Content --}}
        <!-- <main class="p-6 flex-1">
            @yield('content')
        </main> -->
        <div class="adminuiux-wrap"> 
            <x-sidebar />
        </div>
        <main class="p-6 flex-1">
            @yield('content')
        </main>

        <!-- standard footer --> 
        <footer class="adminuiux-footer has-adminuiux-sidebar mt-auto">
        </footer>
    </div>
<!-- Page Level js --> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js" integrity="sha512-nKXmKvJyiGQy343jatQlzDprflyB5c+tKCzGP3Uq67v+lmzfnZUi/ZT+fc6ITZfSC5HhaBKUIvr/nTLCV+7F+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://my.synterra.uz/assets/js/investment/investment-goals.js"></script> 
</body> 
 
</html> 

 