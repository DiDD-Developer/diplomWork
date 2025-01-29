<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Models\Category;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Вывод каталога с тур. местами для пользователей
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function TouristPlaceView(Request $request)
    {
        $placesQuery = Place::query();

        // Фильтрация по названию
        if ($request->filled('filter_name')) {
            $placesQuery->where('name', 'like', '%' . $request->input('filter_name') . '%');
        }

        // Фильтрация по адресу
        if ($request->filled('filter_address')) {
            $placesQuery->where('address', 'like', '%' . $request->input('filter_address') . '%');
        }

        // Фильтрация по категории
        if ($request->filled('filter_category')) {
            $placesQuery->where('category_id', $request->input('filter_category'));
        }

        // Фильтрация по рейтингу
        if ($request->filled('filter_rating')) {
            $placesQuery->withAvg('reviews', 'rating'); // Получаем средний рейтинг

            switch ($request->input('filter_rating')) {
                case 'positive':
                    $placesQuery->having('reviews_avg_rating', '>=', 4)
                        ->orderByDesc('reviews_avg_rating'); // Сортировка по рейтингу от большего к меньшему
                    break;

                case 'negative':
                    $placesQuery->having('reviews_avg_rating', '<', 4)
                        ->orderBy('reviews_avg_rating'); // Сортировка по рейтингу от меньшего к большему
                    break;

                case 'no_reviews':
                    // Фильтр для тур. мест без отзывов
                    $placesQuery->whereDoesntHave('reviews'); // Места без отзывов
                    break;
            }
        }


        // Сортировка
        if ($request->filled('sort')) {
            $sort = $request->input('sort');

            switch ($sort) {
                case 'name_asc':
                    $placesQuery->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $placesQuery->orderBy('name', 'desc');
                    break;
                case 'address_asc':
                    $placesQuery->orderBy('address', 'asc');
                    break;
                case 'address_desc':
                    $placesQuery->orderBy('address', 'desc');
                    break;
            }
        } else {
            // Сортировка по умолчанию
            $placesQuery->orderBy('created_at', 'asc');
        }

        // Добавляем средний рейтинг
        $placesQuery->withAvg('reviews', 'rating');

        // Получаем результаты
        $places = $placesQuery->get();

        $user = Auth::user();

        // Если пользователь авторизован, получаем избранное, иначе создаем пустую коллекцию
        $favorites = $user ? $user->favorites()->with('place')->get() : collect();

        // Получение категорий для фильтра
        $categories = Category::all();

        return view('TouristPlace', compact('places', 'favorites', 'categories'));
    }


    /**
     * Вывод главной страницы с 3 тур. местами, у которых наивысший рейтинг по оставленным на них отзывам
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function MainPage()
    {
        // Получаем пользователя, если он авторизован
        $user = Auth::user();

        $favorites = $user ? $user->favorites()->with('place')->get() : collect();

        // Получаем 3 места с наивысшим рейтингом
        $topRatedPlaces = Place::withAvg('reviews', 'rating') // Вычисляем средний рейтинг
        ->orderByDesc('reviews_avg_rating') // Сортируем по среднему рейтингу
        ->take(3) // Берем только 3 записи
        ->get();

        return view('main', compact('user', 'topRatedPlaces', 'favorites'));
    }




    /**
     * Вывод страницы с тур. местами для администратора
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function PlaceView(Request $request)
    {
        $placesQuery = Place::query();

        // Фильтрация по названию
        if ($request->filled('filter_name')) {
            $placesQuery->where('name', 'like', '%' . $request->input('filter_name') . '%');
        }

        // Фильтрация по адресу
        if ($request->filled('filter_address')) {
            $placesQuery->where('address', 'like', '%' . $request->input('filter_address') . '%');
        }

        // Фильтрация по категории
        if ($request->filled('filter_category')) {
            $placesQuery->where('category_id', $request->input('filter_category'));
        }

        // Фильтрация по рейтингу
        if ($request->filled('filter_rating')) {
            $placesQuery->withAvg('reviews', 'rating'); // Получаем средний рейтинг

            switch ($request->input('filter_rating')) {
                case 'positive':
                    $placesQuery->having('reviews_avg_rating', '>=', 4)
                        ->orderByDesc('reviews_avg_rating'); // Сортировка по рейтингу от большего к меньшему
                    break;

                case 'negative':
                    $placesQuery->having('reviews_avg_rating', '<', 4)
                        ->orderBy('reviews_avg_rating'); // Сортировка по рейтингу от меньшего к большему
                    break;

                case 'no_reviews':
                    // Фильтр для тур. мест без отзывов
                    $placesQuery->whereDoesntHave('reviews'); // Места без отзывов
                    break;
            }
        }

        // Сортировка
        if ($request->filled('sort')) {
            $sort = $request->input('sort');

            switch ($sort) {
                case 'name_asc':
                    $placesQuery->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $placesQuery->orderBy('name', 'desc');
                    break;
                case 'address_asc':
                    $placesQuery->orderBy('address', 'asc');
                    break;
                case 'address_desc':
                    $placesQuery->orderBy('address', 'desc');
                    break;
                case 'created_at_asc':
                    $placesQuery->orderBy('created_at', 'asc');
                    break;
                case 'created_at_desc':
                    $placesQuery->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Сортировка по умолчанию
            $placesQuery->orderBy('created_at', 'asc');
        }

        // Добавляем средний рейтинг
        $placesQuery->withAvg('reviews', 'rating');

        $places = $placesQuery->get();

        $categories = Category::all();

        return view('Admins.places.add_place', compact('places', 'categories'));
    }

    /**
     * Добавление нового тур. места в БД
     * @param AddPlaceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AddPlacePost(AddPlaceRequest $request)
    {
        $validated = $request->validated();

        // Сохраняем файл с уникальным именем
        $file = $request->file('image');
        $filePath = $file->store('places', 'public'); // Сохраняется в storage/app/public/places

        // Сохраняем путь к файлу в БД
        $validated['image'] = $filePath;

        // Создаем запись в таблице
        Place::create($validated);

        return back()->with(['add_place' => $validated['name']]);
    }

    /**
     * Изменение текущих параметров у тур. места
     * @param UpdatePlaceRequest $request
     * @param Place $place
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdatePlacePost(UpdatePlaceRequest $request, Place $place)
    {
        $validated = $request->validated(); // Валидация данных

        $old_edit_place = $place->name;

        // Проверяем, было ли загружено новое изображение
        if ($request->hasFile('image')) {
            // Сохраняем новое изображение
            $newImagePath = $request->file('image')->store('places', 'public');
            $place->image = $newImagePath;
        }

        // Обновляем остальные поля
        $place->name = $validated['name'];
        $place->short_description = $validated['short_description'];
        $place->description = $validated['description'];
        $place->address = $validated['address'];
        $place->category_id = $validated['category_id'];

        $place->save(); // Сохраняем изменения

        return back()->with(['edit_place' => $place->name, 'old_edit_place' => $old_edit_place]);
    }

    /**
     * Удаление тур. места
     * @param Place $place
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RemovePlace(Place $place)
    {
        $delete_name = $place->name;
        $place->delete();
        return back()->with(['delete_place'=>$delete_name]);
    }

    /**
     * Вывод данных выбранного тур. места из каталога на отдельной шаблонной странице
     * @param Request $request
     * @param Place $place
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function catalogPlacesView(Request $request, Place $place)
    {
        $placeOne = Place::findOrFail($place->id);

        // Вычисляем средний рейтинг
        $averageRating = $placeOne->reviews()->avg('rating');
        $averageRating = $averageRating ? round($averageRating, 1) : null; // Округляем до 1 знака

        // Подсчитываем количество отзывов
        $reviewsCount = $placeOne->reviews()->count();

        // Применяем фильтры для отзывов
        $reviewsQuery = $placeOne->reviews();

        if ($request->filled('rating_filter')) {
            $filter = $request->input('rating_filter');
            if ($filter === 'positive') {
                $reviewsQuery->where('rating', '>=', 4);
            } elseif ($filter === 'negative') {
                $reviewsQuery->where('rating', '<=', 2);
            }
        }

        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            if ($sort === 'newest') {
                $reviewsQuery->orderBy('created_at', 'desc');
            } elseif ($sort === 'oldest') {
                $reviewsQuery->orderBy('created_at', 'asc');
            }
        }

        if ($request->filled('filter_user') && auth()->check()) {
            $reviewsQuery->where('user_id', auth()->id());
        }

        $reviews = $reviewsQuery->get();

        $user = Auth::user();
        $favorites = $user ? $user->favorites()->with('place')->get() : collect();

        return view('place_item', compact('placeOne', 'reviews', 'averageRating', 'reviewsCount', 'user', 'favorites'));
    }
}
