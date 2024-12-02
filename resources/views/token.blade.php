@extends('layouts.app')

@section('title', 'Перегляд користувачів')

@section('content')
    <h1>Generate Registration Token</h1>

    <!-- Кнопка для отримання токену -->
    <form action="{{ route('register.token') }}" method="POST">
        @csrf
        <button type="submit">Generate Token</button>
    </form>

    @if(session('token'))
        <p><strong>Token:</strong> {{ session('token') }}</p>
        <p><strong>Token Expiry:</strong> {{ now()->addMinutes(40)->toTimeString() }}</p>
    @endif
@endsection
