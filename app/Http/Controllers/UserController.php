<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\EditDataAccountRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Вывод шаблона страницы регистрации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function RegisterView()
    {
        return view('users.register');
    }

    /**
     * Вывод шаблона страницы авторизации
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function AuthView()
    {
        return view('users.auth');
    }

    /**
     * Регистрация данных из запроса пользователя в базе данных
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RegisterPost(RegisterRequest $request)
    {
        $requests = $request->validated();
        $requests['password'] = Hash::make($requests['password']);

        User::create($requests);
        return redirect()->route('auth');
    }

    /**
     * Авторизация пользователя на сайте по его логину и паролю и проверка на их правильное указание
     * @param AuthRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AuthPost(AuthRequest $request)
    {
        if(Auth::attempt($request->only('login', 'password')))
        {
            $request->session()->regenerate();
            return redirect()->route('/');
        }
        return back()->withErrors(['login'=>'Неправильный логин или пароль!'])->withInput($request->except('password'));
    }

    /**
     * Выход из учетной записи пользователя на сайте
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('/');
    }

    /**
     * Вывод страницы личного кабинета пользователя с его данными
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function PersonalAccountView()
    {
        $user = Auth::user();

        $favorites = auth()->user()->favorites()->with('place')->get();

        return view('PersonalAccount/PersonalAccount', compact('user', 'favorites'));
    }

    /**
     * Смена данных пользователей на странице Личного кабинета
     * @param EditDataAccountRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditDataAccountPost(EditDataAccountRequest $request, User $user)
    {
        $request->validated();

        // Проверяем текущий пароль
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Текущий пароль указан неверно.']);
        }

        // Обновляем данные пользователя
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->patronymic = $request->input('patronymic');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->login = $request->input('login');

        // Обновляем пароль, если указан новый
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Обновляем аватар
        if ($request->hasFile('avatar')) {
            if ($user->avatar !== 'images/default-avatar.png') {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return back()->with('success', 'Вы успешно поменяли данные в своём аккаунте!');
    }



    /**
     * Удаление аккаунта на странице Личного кабинета
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function DeleteAccountPost(User $user)
    {
        $user->delete();
        return redirect()->route('/')->with('success', 'Вы успешно удалили свой аккаунт!');
    }
}
