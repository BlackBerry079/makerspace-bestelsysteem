<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// Dit model vormt een gebruiker in het systeem
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // $fillable - Mass Assignment protection (whitelist)
    // Velden die je mag opslaan in de database
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // $hidden - Gevoelige velden verbergen (password & token)
    // Velden die je NIET mag zien in responses (voor veiligheid)
    protected $hidden = [
        'password',        // Wachtwoord verborgen
        'remember_token',  // Token verborgen
    ];

    // casts() - Type conversie voor datums
    // Zet velden om naar het juiste type
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    // orders() - Database relatie met bestellingen
    // Gebruiker heeft veel bestellingen
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
