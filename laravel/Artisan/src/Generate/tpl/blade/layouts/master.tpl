<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Laravel APP</title>
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}"/>
</head>
<body id="body">
<header>
    <!-- navigation -->
</header>
<!-- header -->
<div id="main" role="main">
    @yield('content')
</div>
<!-- main -->
@section('script')
@show
</body>
</html>

