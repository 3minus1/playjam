<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> @yield('title') </title>

          <meta property="og:url"           @yield('url-content') />
          <meta property="og:type"          content="website" />
          <meta property="og:title"         content="PlayJam - Create, curate, and share playlists!" />
          <meta property="og:description"   @yield('description') />
          <meta property="og:image"         content="https://maxcdn.icons8.com/Color/PNG/512/Music/playlist-512.png" />
       
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/materialize-tags.css">
        <!-- Compiled and minified JavaScript -->
        <script src="https://apis.google.com/js/api.js"></script>

         <script type="text/JavaScript" @yield('js_src')></script> 
         <script type="text/JavaScript" src="/js/materialize-tags.min.js"></script> 
              

    </head>

    <body>
        


       @include('shared.navbar')

       <div class="container">

        @yield('content')
       </div>
             
        
        <div  class="panel-footer">Developed by Akshat Karnwal&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='mailto:akforsn@gmail.com'>Email me!</a></div>

    </body>

</html>
