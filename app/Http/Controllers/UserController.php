<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tinify\Tinify;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class UserController extends Controller
{
    public function create()
    {
        $positions = Position::all(); // Отримуємо всі позиції
        return view('users.create', compact('positions'));
    }

    public function see()
    {
        return view('users.see');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'position_id' => 'required|integer|min:1',
            'token' => 'required|string|max:60',
        ]);

        $token = Token::where('token', $validated['token'])->where('created_at', '>=', Carbon::now()->subMinutes(240))->first();
        if (empty($token)) {
            throw ValidationException::withMessages([
                'token' => ['Token not found or has expired'],
            ]);
        } else if (!empty($token->use)) {
            throw ValidationException::withMessages([
                'token' => ['Token was used'],
            ]);
        } else {
            Token::where('token', $validated['token'])->update(['use' => true]);
        }

        $imagePath = $this->insertUserImage($request->file('image'));

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'photo' => $imagePath,
            'position_id' => $validated['position_id'],
        ]);

        $users = User::with('position')->get();

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user['position'] = Position::find($user['position_id'])->name;

        return response()->json(['success' => true, 'positions' => $user]);
    }

    public function positions()
    {
        $position = Position::all(['id', 'name']);

        if (!$position) {
            return response()->json(['message' => 'Users not found'], 404); // Якщо користувач не знайдений
        }

        return response()->json(['success' => true, 'positions' => $position]); // Повернути дані користувача у форматі JSON
    }

    public function token()
    {
        $this->generateRegistrationToken();
        return view('token', [
            'token' => session('token'),
            'expiryTime' => session('token_expiry'),
        ]); // Повертаємо Blade шаблон, де буде форма або кнопка
    }

    public function generateRegistrationToken()
    {
        // Генерація унікального токену
        $token = Str::random(60);

        // Зберігаємо токен в кеші на 40 хвилин (відповідає вимогам)
        Cache::put('registration_token_' . $token, true, now()->addMinutes(40));

        Token::create(['token' => $token, 'use' => false]);

        session([
            'token' => $token,
            'token_expiry' => now()->addSeconds(2400),
        ]);
    }

    private function insertUserImage ($uploadedImage)
    {
        // Отримуємо шлях до тимчасового файлу
        $imagePath = $uploadedImage->getPathname();

        // Завантажуємо зображення
        $image = imagecreatefrompng($imagePath);
        if (!$image) {
            throw new \Exception('Unable to process image');
        }

        // Отримуємо розміри зображення
        $width = imagesx($image);
        $height = imagesy($image);

        // Налаштування для обрізки
        $newWidth = 70;
        $newHeight = 70;
        $cropX = ($width - $newWidth) / 2;
        $cropY = ($height - $newHeight) / 2;

        // Створюємо обрізане зображення
        $croppedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled(
            $croppedImage,
            $image,
            0, 0,
            $cropX, $cropY,
            $newWidth, $newHeight,
            $newWidth, $newHeight
        );

        // Зберігаємо зображення в папці `public/storage`
        $fileName = 'upload_' . uniqid() . '.png';
        $savePath = storage_path('app/public/' . $fileName);
        imagepng($croppedImage, $savePath);

        // Очищення пам'яті
        imagedestroy($image);
        imagedestroy($croppedImage);

        // Оптимізація зображення (опціонально)
        $this->optimizeImage($savePath);

        // Повертаємо шлях до збереженого зображення
        return 'storage/' . $fileName;
    }

    private function optimizeImage($savePath)
    {
        $mimeType = mime_content_type($savePath);
        if (!in_array($mimeType, ['image/png'])) {
            throw new \Exception('Unsupported file type. Only PNG is allowed.');
        }

        $apiKey = env('TINYPNG_API_KEY');
        if (!$apiKey) {
            throw new \Exception('TINYPNG_API_KEY is not set in .env file');
        }

        \Tinify\setKey($apiKey);
        $source = \Tinify\fromFile($savePath);

        // Генеруємо шлях для збереження оптимізованого файлу
        $optimizedPath = storage_path('app/public/optimized_' . basename($savePath));

        // Зберігаємо оптимізоване зображення
        $source->toFile($optimizedPath);

        // Повертаємо шлях до оптимізованого зображення
        return 'storage/app/optimized_' . basename($savePath);
    }
}
