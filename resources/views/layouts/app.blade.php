<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  @include('includes.style')
</head>
<body class="d-flex justify-content-center">
  @yield('content')

  @stack('prepend-script')
  @include('includes.script')
  @stack('addon-script')

</body>
</html>