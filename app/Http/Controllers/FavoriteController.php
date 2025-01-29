<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Добавление тур. места в "Избранное" в личном кабинете
     * @param Place $place
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Place $place)
    {
        // Проверяем, не добавлено ли место уже в избранное
        if (Favorite::where('user_id', Auth::id())->where('place_id', $place->id)->exists()) {
            return redirect()->back()->with('error', 'Это место уже в избранном.');
        }

        // Добавляем место в избранное
        Favorite::create([
            'user_id' => Auth::id(),
            'place_id' => $place->id,
        ]);

        return redirect()->back();
    }

    /**
     * Удаление записи из раздела "Избранное"
     * @param Favorite $favorite
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return redirect()->back();
    }
}
