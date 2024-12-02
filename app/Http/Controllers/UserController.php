<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tinify\Tinify;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function see()
    {
        return view('users.see');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position_id' => 'required|integer|min:1',
        ]);

        $imagePath = $this->insertUserImage($request->file('image'));

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'photo' => $imagePath,
            'position_id' => $validated['position_id'],
        ]);

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function positions()
    {
        $users = User::all(['position_id', 'name']); // Знайти користувача за ID

        if (!$users) {
            return response()->json(['message' => 'Users not found'], 404); // Якщо користувач не знайдений
        }

        return response()->json(['success' => true, 'positions' => $users]); // Повернути дані користувача у форматі JSON
    }

    public function token()
    {
        return view('token'); // Повертаємо Blade шаблон, де буде форма або кнопка
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
