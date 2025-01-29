<div class="row align-items-center">
    <!-- Левая колонка с изображением -->
    <div class="col-12 col-md-7 d-flex justify-content-center justify-content-md-start">
        <img src="{{ asset('storage/'.$placeOne->image) }}"
             class="img-fluid rounded shadow-lg"
             style="object-fit: cover; object-position: center; max-width: 90%; min-width: 75%;"
             alt="Фото {{ $placeOne->name }}">
    </div>

    <!-- Правая колонка с текстом -->
    <div class="col-md-5 mt-3 mt-md-0">
        <h3 class="display-4 mb-4">{{ $placeOne->name }}</h3>
        <p class="lead text-muted">{{ $placeOne->description }}</p>
        <hr>
        @if($averageRating)
            <p><strong>Средний рейтинг: </strong>⭐{{ $averageRating }}</p>
        @else
            <p><strong>Средний рейтинг:</strong> Отзывов пока нет</p>
        @endif
        <p><strong>Адрес:</strong> {{ $placeOne->address }}</p>
        @if($favorite = $favorites->firstWhere('place_id', $placeOne->id))
            <!-- Если место уже в избранном, показываем кнопку для удаления -->
            <form method="POST" action="{{ route('favorites.remove', $favorite->id) }}">
                @csrf
                <button type="submit" class="TrashBtnPlace btn btn-outline-danger btn-lg mt-3">
                    <i class="fa fa-trash text-danger" style="width: 35px; height: 30px; padding-left: 1px; padding-top: 1px; border-radius: 10px;"></i> Удалить из избранного
                </button>
            </form>
        @else
            <!-- Если место не в избранном, показываем кнопку для добавления -->
            <form method="POST" action="{{ route('favorites.add', $placeOne->id) }}">
                @csrf
                <button class="btn btn-outline-primary btn-lg mt-3" data-id="{{ $placeOne->id }}">
                    <i id="heart" class="far fa-heart"></i> Добавить в избранное
                </button>
            </form>
        @endif
    </div>

</div>
