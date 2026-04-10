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
                <li><h1><a href="/">Dashboard</a></h1></li> <!-- / is dashboard als standaard -->
                <li><h1><a href="/printer">printers</a></h1></li>
                <li><h1><a href="/nieuwsbrief">nieuwsbrief</a></h1></li>
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

            <form action="{{ route('create_nieuwsbrief') }}" method="POST">
                @csrf
                <input type="text" name="title" placeholder="Titel van nieuwsbrief" class="invoer">
                <input type="text" name="description" placeholder="Beschrijving van nieuwsbrief" class="invoer">
                <input type="text" name="type" placeholder="Type van nieuwsbrief" class="invoer"><!-- announcement stock error -->
                <button type="submit" class="knop">Maak nieuwsbrief aan</button>
            </form>
        </div>
        
        <div class="nieuwsbrief">
            @foreach($nieuwsbrief as $item)
            <div class="nieuwsbrief-item">
                <h2>{{ $item->title }}</h2>
                <p>{{ $item->description }}</p>
                <p>{{ $item->type }}</p>
                
                <form action="{{ route('delete_nieuwsbrief', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="knop">Verwijder</button>
                </form>
            </div>
            @endforeach
        </div>


            
    </body>
</html>
