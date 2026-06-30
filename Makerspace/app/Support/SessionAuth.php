<?php

namespace App\Support;

class SessionAuth
{
    public static function check(): bool
    {
        return session()->has('auth_user');
    }

  /**
     * @return array{id: int|null, name: string, email: string}|null
     */
    public static function user(): ?array
    {
        $user = session('auth_user');

        return is_array($user) ? $user : null;
    }
}
