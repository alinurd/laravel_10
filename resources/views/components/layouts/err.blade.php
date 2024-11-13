<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
    
  <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta content="Themesbrand" name="author" />
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
 
    </head>
    <body class="antialiased">
    @yield('content')
    </body>
</html>
