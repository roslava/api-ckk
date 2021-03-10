
@extends('layouts.app')
@section('title', 'Паннель управления')

@section('content')

<div class="content">
<h3>Паннель управления</h3>
<h6>Тут можно добавить, изменить или удалить статьи сайта ckk.ru</h6>
<p>Количество опубликованных статей: {{$quantityOfArticles}}</p>
</div>

    <!-- <div class="tw-py-12">
        <div class="tw-max-w-7xl tw-mx-auto sm:tw-px-6 lg:tw-px-8">
            <div class="tw-bg-white tw-overflow-hidden tw-shadow-xl sm:tw-rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> -->


    @endsection


