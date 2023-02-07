<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Маркетплейс туров</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @if (Auth::check())
      <script>
        window.Laravel = {!!json_encode([
                'isLoggin' => true,
                'currentUser' => Auth::user(),
                'currentUserRole' => Auth::user()->roles->pluck('name')->toArray(),
                'permissions' => Auth::user()->getAllPermissions()->pluck('name')->toArray()
            ])!!}
      </script>
    @else
      <script>
        window.Laravel = {!!json_encode([
                'isLoggin' => false,
                'currentUser' => '',
                'currentUserRole' => '',
                'permissions' => ''
            ])!!}
      </script>
    @endif
    <div id="app">
        <main-app></main-app>
    </div>
</body>
</html>
