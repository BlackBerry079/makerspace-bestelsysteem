<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <title></title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <body>
        
        <header>
            <nav>
            <ul>
                <li><h1><a href="/">Dashboard</a></h1></li>
                <li><h1><a href="/printer">printers</a></h1></li>
                <li><h1><a href="/newsletters">nieuwsbrief</a></h1></li>
                <li><h1><a href="/orders">Orders</a></h1></li>
            </ul>
            </nav>
        </header>
        
   
  <div class="container">
    <h2 class="koptekst">Maak een nieuwe printer aan</h2>
    
    <form action="/create_printer" method="POST" enctype="multipart/form-data" class="formulier">
        @csrf
        <input type="text" name="name" placeholder="Naam van printer" class="invoer">
        <input type="text" name="merk" placeholder="merk van printer" class="invoer">
        <label for="">Beschrijving</label style="color: black; font-size: 20px; margin-top: 10px;">
        <input type="text" name="beschrijving" placeholder="" style="height: 200px;" class="invoer">
        
        <button type="submit" class="knop">Maak Printer aan</button>
    </form>

   
</div>
    
    </body>
</html>
