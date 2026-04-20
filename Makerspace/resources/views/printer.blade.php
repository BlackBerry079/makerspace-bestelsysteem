<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <title></title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <body>
        
      <header>
        <div class="nav">
            <a href="/">Dashboard</a>
            <a href="/printer">Printers</a>
            <a href="/inventory">Voorraad</a>
            <a href="/users">Gebruiker</a>
        </div>
            <button class="logout">Logout</button>
    </header>
  
        
   
  <div class="container">
    <h2 class="koptekst">Maak een nieuwe printer aan</h2>
    
    <form action="/create_printer" method="POST" enctype="multipart/form-data" class="formulier">
        @csrf
        <input type="text" name="name" placeholder="Naam van printer" class="invoer">
        

        <select name="type" class="invoer">
            <option value="3D Printer">3D Printer</option>
            <option value="Laser Cutter">Laser Cutter</option>
            <option value="CNC Machine">CNC Machine</option>
        </select>
        
        <label for="beschrijving">Beschrijving</label>
        <input type="text" name="beschrijving" placeholder="" class="invoer beschrijving">
        
        <button type="submit" class="knop">Maak Printer aan</button>
    </form>
</div>

<div class="nieuwsbrief" id="nieuwsbrief">
    <div class="nieuws-header">
        <span class="arrow" onclick="toggleNieuws()">▶</span>
        Nieuwsbrief
    </div>
</div>
    
    
<script>
function toggleNieuws(){

    const panel = document.getElementById("nieuwsbrief");
    const main = document.getElementById("main");

    panel.classList.toggle("closed");
    main.classList.toggle("full");

}
</script>
    
    </body>
</html>