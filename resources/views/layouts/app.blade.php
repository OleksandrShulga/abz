<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Тестове завдання для ABZ')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        form { max-width: 400px; margin: 0 auto; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        input { width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 1rem 2rem; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        a { padding: 0.5rem 1rem; background-color: #080358; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        li { margin-bottom: 10px; }
        ul { list-style-type: none; padding: 0; }
        .error { color: red; font-size: 0.9rem; margin-bottom: 1rem; }
        .success { color: green; font-size: 0.9rem; margin-bottom: 1rem; }
        .users-container { display: flex; flex-wrap: wrap; gap: 20px; }
        .user-item { width: calc(33.33% - 20px); box-sizing: border-box; }
    </style>
</head>
<body>
<main>
    @yield('content')
</main>
</body>
</html>
