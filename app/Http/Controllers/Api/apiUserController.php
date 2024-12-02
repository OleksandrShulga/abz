<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class apiUserController extends Controller
{
    public function getUsers(Request $request)
    {
        $users = User::paginate(6);

        return response()->json($users);
    }

    // Генерація токену для реєстрації нового користувача
    public function generateRegistrationToken()
    {
        // Генерація унікального токену
        $token = Str::random(60);

        // Зберігаємо токен в кеші на 40 хвилин (відповідає вимогам)
        Cache::put('registration_token_' . $token, true, now()->addMinutes(40));

        return response()->json([
            'success' => true,
            'token' => $token,
            'expires_in' => 2400,  // Тривалість токену в секундах (40 хвилин)
        ]);
    }
}
