<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReviewRequest;
use App\Http\Requests\EditReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Создание нового отзыва для конкретного тур. места
     * @param AddReviewRequest $request
     * @param $placeId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function CreateReviewPost(AddReviewRequest $request, $placeId)
    {
        Review::create($request->validated() + [
                'user_id' => auth()->id(),
                'place_id' => $placeId,
            ]);

        return back()->with('success', 'Ваш отзыв успешно создан!');
    }

    /**
     * Изменение параметров отзыва, созданного пользователем или администратором
     * @param EditReviewRequest $request
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function EditReviewPost(EditReviewRequest $request, Review $review)
    {
        $request->validated();

        $review->text = $request->input('text');
        $review->rating = $request->input('rating');
        $review->save();
        return back()->with(['nameReview'=>$review->place->name]);
    }

    /**
     * Удаление отзыва, созданного пользователем или администратором
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RemoveReviewPost($id)
    {
        // Находим отзыв по ID
        $reviewID = Review::findOrFail($id);

        // Проверяем, является ли пользователь автором отзыва или администратором
        if ($reviewID->user_id == Auth::id() || Auth::user()->isAdmin) {
            // Удаляем отзыв
            $reviewID->delete();

            return back()->with('success', 'Отзыв был успешно удалён!');
        }

        // Если пользователь не имеет прав на удаление, возвращаем ошибку
        return back()->with('error', 'У вас нет прав для удаления этого отзыва.');
    }
}
