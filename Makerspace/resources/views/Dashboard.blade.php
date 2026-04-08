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
                <li><h1><a href="/dashboard">Dashboard</a></h1></li>
                <li><h1><a href="/printers">printers</a></h1></li>
                <li><h1><a href="/newsletters">nieuwsbrief</a></h1></li>
                <li><h1><a href="/orders">Orders</a></h1></li>
            </ul>
            </nav>
        </header>
        
        

        <div class="status">
            <p>printers</p>
            <p>voorraad</p>
            <p>Orders</p> 
        </div>
            
        <div class="orders">
        </div>
            


        <div class="sidebar">
            <h1>nieuwsbrief</h1>
        </div>
            
    </body>
</html>
