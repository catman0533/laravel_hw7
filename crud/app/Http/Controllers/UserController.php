<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
   

//use PDF; // Предполагается, что вы используете пакет для работы с PDF, например, `dompdf`.

class UserController extends Controller
{
    // Метод для получения всех пользователей
    public function index()
    {
        $users = User::all(); // Получаем всех пользователей
        return response()->json($users); // Возвращаем JSON-ответ
    }

    // Метод для получения одного пользователя по ID
    public function show($id)
    {
        $user = User::findOrFail($id); // Получаем пользователя по ID
        return response()->json($user); // Возвращаем JSON-ответ
    }

    // Метод для создания нового пользователя
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ // Валидация входных данных
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // Возвращаем ошибки валидации
        }

        $user = User::create([ // Создаем нового пользователя
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Хешируем пароль
        ]);

        return response()->json($user, 201); // Возвращаем созданного пользователя
    }

    // Метод для экспорта данных пользователя в PDF
    public function exportPdf($id)
    {
        $user = User::findOrFail($id); // Получаем пользователя по ID

        $pdf = PDF::loadView('users.pdf', compact('user')); // Загружаем представление для PDF
        return $pdf->download('user_' . $user->id . '.pdf'); // Возвращаем PDF-файл для скачивания
    }
}
