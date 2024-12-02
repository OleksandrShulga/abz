@extends('layouts.app')

@section('title', 'Додати користувача')

@section('content')
    <p><a href="{{ route('users.create') }}">Створення користувачів + перегляд користувачів по 6 штук (прогорнути нижче)</a></p>
    <p><a href="{{ route('users.show', ['id' => 1]) }}">Перегляд конкретних користувачів</a></p>
    <p><a href="{{ route('positions') }}">Список користувачів (ідентифікатор + ім'я)</a></p>
    <p><a href="{{ route('token') }}">Створення токена (і нічого більше)</a></p>
    <h1>Create a New User</h1>

    <!-- Показуємо повідомлення про успіх -->
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <!-- Виведення помилок валідації -->
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Форма створення користувача -->
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>

        <label for="position_id">Position_id</label>
        <input type="number" id="position_id" name="position_id" value="{{ old('position_id') }}" required>

        <label for="image">Image (solo PNG):</label>
        <input type="file" name="image" id="image" accept="image/png" required>

        <button type="submit">Create User</button>
    </form>
    <div id="app">
        <users-list></users-list>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
