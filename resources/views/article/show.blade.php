@extends('layouts.app')


@section('title', 'Просмотр статьи: '.$article->article_title)



@section('content')

{{--<?php
$articleTxt = str_ireplace('src="', 'src="/storage/img/', $article->article_text);
?>--}}

<?php
$articleTxt = $article->article_text;
?>

<div class="show">
<div style="margin-bottom: 20px;">
<img class="show__smi-cover" src="{{ Storage::url($article->article_cover) }}">
</div>
    <div class="show__smi-name">{{$article->smi_name}}</div>
    <div class="show__author">Автор: {{$article->smi_author}}</div>
    <div class="show__original">Источник: {{$article->smi_original}}</div>
    <div class="show__date">Дата публикации: {{$article->smi_date}}</div>
    <h2  class="show__title">{{$article->article_title}}</h2>
    <h6 class="show__lead">{{$article->article_lead}}</h6>
    <div class="show__text">{!!$articleTxt!!}</div>
    


    


    
    

    <a href="{{route('articles.edit', $article)}}"  class="article__articleButton_edit">Редактировать</a>
</div>

@endsection


