<!DOCTYPE html>
<html>
<head>
    <title>Добавить работника</title>
</head>
<body>
    <h1>Добавить нового работника</h1>

    <!-- Форма для добавления работника -->
    <form action="{{ route('users.store') }}" method="POST">
        @csrf <!-- CSRF-токен для защиты от подделки запросов -->
        
        <div>
            <label for="first_name">Имя:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>

        <div>
            <label for="last_name">Фамилия:</label>
            <input type="text" id="last_name" name="last_name" required>
        </div>

        <div>
            <label for="email">Электронная почта:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <button type="submit">Создать работника</button>
        </div>
    </form>
</body>
</html>
