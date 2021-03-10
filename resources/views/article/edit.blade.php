@extends('layouts.app')
@section('title', 'Редактирование статьи: '.$article->article_title)

@section('content')
<h3>Редактирование статьи «{{ $article->article_title }}» </h3>

<div class="create-article">
        @if($errors->any())
        <div class="message__alert_danger">
                <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                </ul>
        </div>
        @endif

        <div id="article-form">
                <form action="{{ route('articles.update', $article)}}" method="POST" enctype="multipart/form-data">
                <div class="article-form">
                        @csrf
                        @method('PATCH')
                        <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_name">Название СМИ:</label>
                                <input value="{{ $article->smi_name }}" id="smi_name" name="smi_name" type="text" class="article-form__input" placeholder="Введите, пожалуйста, название статьи">
                        </div>

                        <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_author">Автор:</label>
                                <input value="{{ $article->smi_author }}" id="smi_author" name="smi_author" type="text" class="article-form__input" placeholder="Введите, пожалуйста, Имя автора">
                        </div>

                        <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_original">Ссылка на первоисточник:</label>
                                <input value="{{ $article->smi_original }}" id="smi_original" name="smi_original" type="text" class="article-form__input" placeholder="Введите, пожалуйста, ссылку на первоисточник">
                        </div>

                        <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_date">Дата:</label>
                                <input value="{{ $article->smi_date }}" id="smi_date" name="smi_date" type="text" class="article-form__input" placeholder="Введите, пожалуйста, дату публикации статьи">
                        </div>

                        <div class="article-form__groupe">
                                <label class="article-form__label" for="article_title">Заголовок:</label>
                                <input value="{{ $article->article_title }}" id="article_title" name="article_title" type="text" class="article-form__input" placeholder="Введите, пожалуйста, заголовок статьи">
                        </div>


                        <div class="article-form__groupe">
                                <label class="article-form__label" for="article_lead">Лид:</label>
                                <textarea id="article_lead" name="article_lead" class="article-form__leadarea" placeholder="Введите, пожалуйста, лид статьи">{{ $article->article_lead }}</textarea>
                        </div>


                        <div class="article-form__groupe">
                                <label class="article-form__label" for="article_text">Текст:</label>
                                <textarea value="{{ old('article_text') }}" id="article_text" name="article_text" class="article-form__textarea" placeholder="Введите, пожалуйста, текст статьи">{!!$article->article_text!!}</textarea>
                        </div>




                        <div class="article-form__groupe"> <label class="article-form__label" for="article_cover">Обложка статьи:</label></div>
                        <div class="ckk-inputfile">
                                <img style="width: 100px;" src="{{ Storage::url($article->article_cover) }}">
                                <label for="article_cover" class="inputfile_label">Выберать файл для замены обложки</label>
                                <input type="file" value="{{$article->article_cover}}" name="article_cover" id="article_cover" name="inputFile1" class="inputfile">
                        </div>




                        </div>

                        <div class="article-form__btn-groupe">
                                <input id="submit" type="submit" class="article-form__submit" value="Разместить отредактированную статью" />

                                <div class="article-form__cansel">
                                        <a href="{{ route('articles.index')}}">Отменить редактирование</a>
                                </div>
                        </div>

                </form>
        </div>







</div>





<!-- Modal wrapper bg -->
<div class="oversizeModalWrapper" id='oversizeModalWrapper'></div>

<!-- Modal -->
<div class="oversizeModal" id='oversizeModal'>

        <div>
                <p>Размер загружаемого файла в поле «Текст»<br>не должен превышать 5 мегабайтов.</p>
        </div>
        <button class="oversizeModalButton" id='oversizeModalButton'>Продолжить</button>

</div>












@endsection

@push('styles')


<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">
<!-- <link rel="stylesheet" href="{{ asset('plugins/summernote/bootstrap.min.css')}}"> -->
@endpush


@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
@endpush


@push('scripts')
<script src="{{asset('plugins/summernote/summernote-bs4.js')}}"></script>
<script src="{{asset('plugins/summernote/lang/summernote-ru-RU.min.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-customize.js')}}"></script>


@endpush