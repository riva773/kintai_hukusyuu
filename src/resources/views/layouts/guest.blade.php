<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
</head>

<body>
    @include('partials.simple_header')
    <div class="container">
        @yield('content')
    </div>
</body>


</html>