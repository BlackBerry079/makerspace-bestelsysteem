<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Login</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <body>
    
    <!-- hoort GET te zijn -->
      <div class="login_pagina">
        <h1>Login</h1>
        
        <form action="/Dashboard" method="GET" enctype="multipart/form-data" class="formulier">
            @csrf
            <input type="text" placeholder="studentnummer">
            <input type="text" placeholder="Emailadress">
            <button type="submit" class="knop">Login</button>
        </form>
    </div>

</body>
</html>