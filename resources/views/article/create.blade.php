@extends('layouts.app')

@section('title', 'Создать статью')

@section('content')

       
        <h3>Создать статью</h3>
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


                        <form action="{{ route('articles.store')}}" method="POST" class="article-form" enctype="multipart/form-data">

                                @csrf


                               
                                <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_name">Название СМИ:</label>
                                <input value="{{ old('smi_author') }}" id="smi_name" name="smi_name" type="text" class="article-form__input" placeholder="Введите, пожалуйста, название СМИ">
                                </div>

                                <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_author">Автор:</label>
                                <input value="{{ old('smi_author') }}" id="smi_author" name="smi_author" type="text" class="article-form__input" placeholder="Введите, пожалуйста, Имя автора">
                                </div>

                                <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_original">Ссылка на первоисточник:</label>
                                <input value="{{ old('smi_original') }}" id="smi_original" name="smi_original" type="text" class="article-form__input" placeholder="Введите, пожалуйста, ссылку на первоисточник">
                                </div>

                                <div class="article-form__groupe">
                                <label class="article-form__label" for="smi_date">Дата:</label>
                                <input value="{{ old('smi_date') }}" id="smi_date" name="smi_date" type="text" class="article-form__input" placeholder="Введите, пожалуйста, дату публикации статьи">
                                </div>

                                <div class="article-form__groupe">
                                <label class="article-form__label" for="article_title">Заголовок:</label>
                                <input value="{{ old('article_title') }}" id="article_title" name="article_title" type="text" class="article-form__input" placeholder="Введите, пожалуйста, заголовок статьи">
                                </div>


                                <div class="article-form__groupe">
                                <label class="article-form__label" for="article_lead">Лид:</label>
                                <textarea id="article_lead" name="article_lead" class="article-form__leadarea" placeholder="Введите, пожалуйста, лид статьи">{{ old('article_lead') }}</textarea>
                                </div>


                                <div class="article-form__groupe">
                                <label class="article-form__label" for="article_text">Текст:</label>
                                <textarea id="article_text" name="article_text" class="article-form__textarea" >{{ old('article_text') }}
                                </textarea>
                                </div>




                        <div class="article-form__groupe"> <label class="article-form__label" for="article_cover">Обложка статьи:</label></div>
                                <div class="ckk-inputfile">  
                              
                                <input value="{{ old('article_cover') }}"  type="file" name="article_cover">

                                </div>
                                </div>
                                <div class="article-form__groupe">
                                <input id="submit" type="submit" class="article-form__submit" value="Разместить статью" />
                                </div>

                                <div>
                                        <a href="{{ route('articles.index')}}">Отмена</a>
                                </div>

                        </form>

        </div>





<!-- Modal wrapper bg -->
<div class="oversizeModalWrapper" id='oversizeModalWrapper'></div>

    <!-- Modal -->
<div class="oversizeModal" id='oversizeModal'>

<div><p>Размер загружаемого файла в поле «Текст»<br>не должен превышать 5 мегабайтов.</p></div>     
<button class="oversizeModalButton" id='oversizeModalButton'>Продолжить</button>

</div>






















@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
@endpush


@push('scripts')
<script src="{{asset('plugins/summernote/summernote-bs4.js')}}"></script>
<script src="{{asset('plugins/summernote/lang/summernote-ru-RU.min.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-customize.js')}}"></script>

@endpush