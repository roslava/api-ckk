@extends('layouts.app')
@section('title', 'Паннель управления')

@section('content')

<div class="content">

    <h3>Паннель управления</h3>
    <h6>Тут можно добавить, изменить или удалить статьи сайта ckk.ru</h6>


    <div class="dash-board__wrap">
        <div class="dash-board__column">
    <a href="{{ route('articles.index') }}" class="quantity-widget_link">
            <div class="quantity-widget">
                <div class="quantity-widget__description">Количество опубликованных статей:</div>
                <div class="quantity-widget__figure">{{$quantityOfArticles}}</div>
            </div>
    </a>
        </div>
        <div class="dash-board__column"></div>
        <div class="dash-board__column"></div>

    </div>

</div>

@endsection