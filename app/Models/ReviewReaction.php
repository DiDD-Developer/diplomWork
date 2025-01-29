<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReaction extends Model
{
    use HasFactory;
    /**
     * Защита поля 'id' в таблице users, чтобы предотвратить
     * случайное изменение идентификатора пользователя
     * при создании или обновлении модели.
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * Отношение к пользователю, поставившему реакцию
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Отношение к отзыву, на который была реакция
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function review()
    {
        return $this->belongsTo(Review::class);
    }
}
