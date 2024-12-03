@extends('layouts.app')

@section('title', 'Перегляд користувачів')

@section('content')
    <h1>Generate Registration Token</h1>

    @if(session('token'))
        <p><strong>Token:</strong> {{ $token }}</p>
        <p><strong>Token Expiry (Greenwich time):</strong> {{ $expiryTime }}</p>
    @else
        <p>No token found in session.</p>
    @endif
@endsection
