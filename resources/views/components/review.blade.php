<div class="col-md-8 mx-auto mb-4">
    <div class="p-3 border rounded shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <img
                    src="{{ $review->user->avatar === 'images/default-avatar.png' ? asset($review->user->avatar) : asset('storage/' . $review->user->avatar) }}"
                    alt="Аватар пользователя"
                    class="rounded-circle border border-light"
                    style="width: 100px; height: 100px;">
                <h5 class="mb-0">{{ $review->user->name }} {{ $review->user->surname }}</h5>
            </div>
            <span class="text-warning">
                    @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                        ⭐
                    @else
                        ☆
                    @endif
                @endfor
                                </span>
        </div>
        <p class="mt-2">{{ $review->text }}</p>
        <small class="text-muted">Добавлено {{ $review->created_at->format('d.m.Y H:i') }}</small>
        <div class="d-flex align-items-center">
            <!-- Лайк и дизлайк -->
            <div class="d-flex align-items-center">
                <!-- Форма для лайка -->
                <form class="mt-3 me-2" method="POST" action="{{ route('reviews.toggleReaction', $review->id) }}">
                    @csrf
                    <button class="border-0 bg-white"
                            type="submit"
                            name="is_like"
                            value="1">
                        <img src="{{ $review->reactions->where('user_id', auth()->id())->where('is_like', true)->count() ? asset('images/like-active.png') : asset('images/like.png') }}"
                             width="30px" alt="Лайк на отзыв">
                        {{ $review->likesCount() }}
                    </button>
                </form>

                <!-- Форма для дизлайка -->
                <form class="mt-3" method="POST" action="{{ route('reviews.toggleReaction', $review->id) }}">
                    @csrf
                    <button class="border-0 bg-white"
                            type="submit"
                            name="is_like"
                            value="0">
                        <img src="{{ $review->reactions->where('user_id', auth()->id())->where('is_like', false)->count() ? asset('images/dislike-active.png') : asset('images/dislike.png') }}"
                             width="30px" alt="Дизлайк на отзыв">
                        {{ $review->dislikesCount() }}
                    </button>
                </form>
            </div>

            @auth
                @if($review->user_id == auth()->id() || auth()->user()->isAdmin)
                    <!-- Редактировать и удалить -->
                    <div class="d-flex align-items-center gap-4 mt-3 ms-3">
                        <!-- Кнопка для вызова модалки редактирования -->
                        <img type="button" class="ms-3" data-bs-toggle="modal" data-bs-target="#editReviewModal{{ $review->id }}"
                             src="{{ asset('images/icon_pencil.png') }}" width="30px" alt="иконка кнопки редактирования отзыва">

                        <!-- Модальное окно редактирования -->
                        <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="editReviewModalLabel{{ $review->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editReviewModalLabel{{ $review->id }}">Редактирование отзыва</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('EditReviewPost', $review->id) }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="review_text" class="form-label">Ваш отзыв</label>
                                                <textarea name="text" id="review_text{{ $review->id }}" class="form-control" rows="3">{{ $review->text }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="rating{{ $review->id }}" class="form-label">Оценка</label>
                                                <select name="rating" id="rating{{ $review->id }}" class="form-select">
                                                    <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                                                    <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                                                    <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>⭐⭐⭐</option>
                                                    <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>⭐⭐</option>
                                                    <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>⭐</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Кнопка для удаления -->
                        <img type="button" class="ms-1" data-bs-toggle="modal" data-bs-target="#removeReviewModal{{ $review->id }}"
                             src="{{ asset('images/icon_trash.png') }}" width="30px" alt="иконка кнопки удаления отзыва">

                        <!-- Модальное окно удаления -->
                        <div class="modal fade" id="removeReviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="removeReviewModalLabel{{ $review->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="removeReviewModalLabel{{ $review->id }}">Удаление отзыва про {{ $review->place->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Вы уверены, что хотите удалить этот отзыв?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                        <form method="POST" action="{{ route('RemoveReviewPost', $review->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
</div>
