<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF8">
    <title>{{ $title or "Blog-Laravel" }}</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <script src="{{asset('bower/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="container navigation">
    <!-- class row  -->
    @include('partials.nav')
</div>
<!-- navigation -->
<div class="container header">
    <div class="row header">
        <div class="col-lg-8">
            <h1><a href="{{url('/')}}">Blog-Laravel</a></h1>
        </div>
        <div class="col-lg-4 col-xs-offset-4">
            <blockquote>
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
            </blockquote>
        </div>
    </div>
</div>
<!-- header-->
<div class="container content">
    <div class="row content">
        <div class="col-lg-8">
            @yield('content')
        </div>
        <div class="col-lg-4">
            @section('sidebar')
                <h2>étudiants</h2>
                @if(count($students)>0)
                    @foreach($students as $student)
                        <div class="clearfix">
                            <h2>{{$student->firstname}}, {{$student->name}}</h2>
                            <br><samll>{{$student->created_at->format('d/m/Y h:i:s')}}</samll>
                            <p>{{$student->bio}}</p>
                        </div>
                    @endforeach
                @endif
            @show
        </div>
    </div>
</div>
<!-- content -->
<div class="container footer text-right">
    <div class="row footer">
        @section('footer')
        @show
    </div>
</div>
<!-- content -->
</body>
</html>
