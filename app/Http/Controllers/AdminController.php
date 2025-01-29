<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Вывод страницы с панелью администратора
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function AdminView()
    {
        return view('Admins.admin');
    }

    /**
     * Вывод страницы с пользователями и заданными на ней фильтрами
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function AdminUsersView(Request $request)
    {
        $usersQuery = User::query();

        // Фильтрация по логину
        if ($request->filled('login')) {
            $usersQuery->where('login', 'like', '%' . $request->input('login') . '%');
        }

        // Фильтрация по email
        if ($request->filled('email')) {
            $usersQuery->where('email', 'like', '%' . $request->input('email') . '%');
        }

        // Фильтрация по статусу администратора
        if ($request->filled('isAdmin')) {
            $usersQuery->where('isAdmin', $request->input('isAdmin'));
        }

        // Сортировка
        $sortColumn = $request->input('sort_column', 'name'); // По умолчанию сортировка по имени
        $sortOrder = $request->input('sort_order', 'asc'); // По умолчанию сортировка по возрастанию

        if ($sortColumn === 'patronymic') {
            // Сортировка по отчеству с учетом null
            $usersQuery->orderByRaw("COALESCE(patronymic, '') $sortOrder");
        } else {
            $usersQuery->orderBy($sortColumn, $sortOrder);
        }

        // Получаем результаты
        $users = $usersQuery->get();

        return view('Admins.Users.users', compact('users'));
    }

    /**
     * Обновление данных пользователя и сохранение изменений
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateUsersView(UpdateUserRequest $request, User $user) {
        $request->validated();

        $old_edit_user = $user->name;

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->patronymic = $request->input('patronymic');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->login = $request->input('login');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->isAdmin = $request->input('isAdmin');


        $user->save();

        return back()->with(['edit_userName'=>$user->name, 'edit_userSurname'=>$user->surname,  'old_edit_user'=>$old_edit_user]);
    }

    /**
     * Удаление пользователя
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RemoveUser(User $user) {
        $delete_user = $user->name;
        $user->delete();
        return back()->with(['delete_user'=>$delete_user]);
    }

}
