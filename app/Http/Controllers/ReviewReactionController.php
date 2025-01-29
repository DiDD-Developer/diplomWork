<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewReaction;
use Illuminate\Http\Request;

class ReviewReactionController extends Controller
{
    /**
     * Добавление лайка/дизлайка на отзыв о туристическом месте
     * @param Request $request
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleReaction(Request $request, Review $review)
    {
        $user = auth()->user();
        $isLike = $request->input('is_like') == 1;

        // Найти существующую реакцию
        $reaction = ReviewReaction::where('user_id', $user->id)
            ->where('review_id', $review->id)
            ->first();

        if ($reaction) {
            // Если текущая реакция совпадает с запросом, удалить её
            if ($reaction->is_like == $isLike) {
                $reaction->delete();
                return back();
            }

            // Если реакция отличается, обновить её
            $reaction->update(['is_like' => $isLike]);
            return back();
        }

        // Если реакции нет, создать новую
        ReviewReaction::create([
            'user_id' => $user->id,
            'review_id' => $review->id,
            'is_like' => $isLike,
        ]);

        return back();
    }

}
