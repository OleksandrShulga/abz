@extends('layouts.app')

@section('title', 'Перегляд користувачів')

@section('content')
    <div id="app">
        <users-list></users-list>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
