@extends('layouts.app')

@section('title', 'Все статьи')





@section('content')

<div style="display:flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
<h3>Опубликованные статьи</h3>

<div class="article-preview__score">
Всего опубликовано статей: {{$quantityOfArticles}}
</div>
</div>


@if(session()->get('success'))
<div>
    {{session()->get('success')}}
</div>
@endif












@foreach($articles as $key => $article)

<div class="article-preview">

<div class="article-preview__info-holder">
    <div class="article-preview__numbering">{{ $quantityOfArticles - ($articles->firstItem() + $key) + 1 }}</div>
    <div
    style="background-image: url('{{ Storage::url($article->article_cover) }}'); background-size: cover;" class="article-preview__img-holder">
    </div>
    <div class="article-preview__heading-holder">
        <h6>{{$article->smi_name}}</h6>
        <h5>{{$article->article_title}}</h5>
    </div>
</div>

<div class="article-preview__buttons-holder">

    <div class="article-preview__button article-preview__button_left">
    <a href="{{route('articles.show', $article)}}"><i class="material-icons">visibility</i></a>
    </div>

    <div class="article-preview__button article-preview__button_center">
    <a href="{{route('articles.edit', $article)}}"><i class="material-icons">create</i></a>
        
    </div>

    <div class="article-preview__button article-preview__button_right">

    <!-- <form action="{{route('articles.destroy', $article)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="article-preview__button-destroy" type="submit">
                <i class="material-icons">delete_forever</i>
                </button>
            </form> -->
            <button type="button" class="article-preview__button-destroy" data-toggle="modal" data-target="#deleteArticleModal-{{ $article->id }}">
  <i class="material-icons">delete_forever</i>
</button>
    
    </div>
</div>

</div>

@endforeach




<div style=" margin-bottom: 20px;">{{ $articles->links() }}</div>
<!-- <div>{{ $articles->onEachSide(5)->links() }}</div> -->




@foreach($articles as $article)
    <!-- Modal -->
<div class="modal fade" id="deleteArticleModal-{{ $article->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="myModalLabel">Вы хотите удалить статью {{ $article->article_title }}.</h6>
      </div>
      <div class="modal-body">
        После удаления восстановить статью будет уже невозможно. Вы уверены, что хотите ее удалить? 
      </div>
      <div class="modal-footer">
        
        <div style="display:flex; justify-content:space-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Нет, отменить удаление.</button>
        
        <form action="{{route('articles.destroy', $article)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-primary" type="submit">Да, удалить статью.</button>
        </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endforeach




@endsection
