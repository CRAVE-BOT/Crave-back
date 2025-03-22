<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>@yield('title', 'Dashboard - NiceAdmin')</title>

    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="{{asset('front')}}/assets/img/favicon.png" rel="icon" />
    <link href="{{asset('front')}}/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{asset('front')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{asset('front')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{asset('front')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="{{asset('front')}}/assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="{{asset('front')}}/assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="{{asset('front')}}/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="{{asset('front')}}/assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{asset('front')}}/assets/css/style.css" rel="stylesheet" />

    <!-- ✅ تضمين Vue.js لتشغيل الشات بوت -->
    @vite(['resources/js/app.js'])
</head>

<body>

<!-- ✅ تضمين الهيدر والسايد بار -->
@include('Layouts.header')
@include('Layouts.sidebar')

<!-- ✅ هنا يتم تحميل محتوى الصفحة -->
<div class="content">
    @yield('content')
</div>

<!-- ✅ أيقونة الشات بوت ستكون متاحة في جميع الصفحات -->
<div id="app">
    <chatbot></chatbot>
</div>

<!-- ✅ تضمين ملفات JavaScript -->
@include('Layouts.Js')

</body>

</html>
