<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title') - Game Kuis</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('includes.admin.style')

</head>

<body>

  @include('includes.admin.header')

  @include('includes.admin.sidebar')

  @yield('content')

  @include('includes.admin.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @stack('prepend-script')
  @include('includes.admin.script')
  @stack('addon-script')

</body>

</html>