@extends('layouts.app')

@section('title', 'Перегляд користувачів')

@section('content')
    <h1>Вітальна сторінка!</h1>

    <h2>Кнопки для навігації:</h2>

    <p><a href="{{ route('users.create') }}">Створення користувачів + перегляд користувачів по 6 штук (прогорнути нижче)</a></p>
    <p><a href="{{ route('users.see') }}">Перегляд користувачів по 6 штук</a></p>
    <p><a href="{{ route('users.show', ['id' => 1]) }}">Перегляд конкретних користувачів</a></p>
    <p><a href="{{ route('positions') }}">Список користувачів (ідентифікатор + ім'я)</a></p>
    <p><a href="{{ route('token') }}">Створення токена (і нічого більше)</a></p>

    <h4>Короткий звіт:</h4>
    <p>Те, що перший пункт ТЗ не просто загальні побажання по підходу, а посилання на цілком конкретну заготовку, роздивився вже коли були готові всі інші пункти. Тож прийшлося дещо переробити, але зрештою сайт функціональний, хоча один метод залишив так як є, бо робив в вихідні, в hr не доуточнити, про нього розповім далі.</p>
    <p>Спочатку про зображення — про них в заготовці з п.1 ТЗ нічого не сказано, тож зробив на свій розсуд. Форма завантаження знаходиться на сайті за адресою /image/upload. Збереження йде в локальний Storage.</p>
    <p>По користувачам вимоги були виводити інформацію різними способами. Попідписував кнопки, повинно бути зрозуміло. По токену стояла задача генерувати його і нічого більше не робити. Виконав в точності з вимогами.</p>
    <p></p>
    <p>
        <b>Перелік виконаних завдань</b>:
    </p>
    <ol>
        <li>Реалізація простого REST API</li>
        <li>Генерація токену для реєстрації</li>
        <li>Реалізація пагінації (можна побачити на сторінці перегляду користувачів по 6 штук, там все працює через штатну пагінацію, кожні 6 користувачів — окрема сторінка. Просто в рамках завдання виводжу їх всіх одночасно в межах кількості кліків кнопки)</li>
        <li>Підключення і налагодження взаємодії зі стороннім сервісом</li>
        <li>Механізм додавання користувача</li>
        <li>Фабрика правдоподібних користувачів</li>
        <li>Створення інструкції по розгортанню проекта</li>
        <li>Робота з передачею і модифікацією зображень</li>
        <li>Робота з локальним сховищем</li>
        <li>Взаємодія з БД, створення нових даних та виведення наявних</li>
    </ol>
    <p>
        <b>Перелік використаних інструментів</b>:
    </p>
    <ol>
        <li>PHP 8.2 і Laravel v.10 — серверна частина</li>
        <li>Vue 3 і Blade — фронтова частина</li>
        <li>TinyPNG API — оптимізація зображень</li>
        <li>Composer — для встановлення потрібних пакетів бібліотек</li>
        <li>NPM — для запуску частини напрацювань фронта</li>
        <li>Git — для перекидання і розгортання проекту (контролювати версії тут для мене — занад-то дрібно)</li>
        <li>Postman — не використовував, але програму знаю і вмію застосовувати. Але тут АРІ такого рівня, що користуватися постменом — ганьбити себе і свої навички)</li>
        <li>Пошукова система Google</li>
        <li>ChatGPT</li>
    </ol>
    <p>
        <b>Час, витрачений на завдання</b>:
    </p>
    <ol>
        <li>Продумування реалізації — година</li>
        <li>Робота з зображенням — максимум, що приходилося робити — це перезбирати зображення, щоб уникнути впровадження шкідливих програм (хоча на Python робив ще розпізнавання тексту засобами OCR), а так — передавати самі зображення кудись. На модифікацію їх, ознайомлення з АРІ TinyPNG, читання документації, метод проб і помилок пішло десь з 6 годин</li>
        <li>Робота з користувачами для мене звична, тут процес пішов швидше. Продумування архітектури взаємодій і фактичне написання зайняло години 3-4, хоча продуктивного кодингу тільки 2-3, оскільки  не полінувався попрацювати над стилями</li>
        <li>Пошук і вирішення питання з сервером — біля двох годин</li>
        <li>Дообдумування і доопрацювання після того, як розгледів, що в п.1 є посилання — до двух годин</li>
        <li>Тестування функціоналу і його працездатності — година</li>
        <li>Написання і оформлення — година</li>
        <li>Зміни після вказіки про частково неправильну інтерпритацію технічного завдання — дві години</li>
    </ol>
@endsection