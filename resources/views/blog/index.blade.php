<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>Clean Blog - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link
      href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
      rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{asset('css/clean-blog.min.css')}}" rel="stylesheet">
  @stack('styles')

</head>

<body>

  <!-- Navigation -->
   @include('/blog/navigation')

  <!-- Page Header -->
  @if(Request::is('/'))
    @include('/blog/header')
  @endif
  <!-- Main Content -->
    @yield('content')

  <hr>

  <!-- Footer -->
  @include('/blog/footer')

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  @stack('scripts')

  <!-- Custom scripts for this template -->
  <script src="{{asset('js/clean-blog.min.js')}}"></script>

</body>

</html>
