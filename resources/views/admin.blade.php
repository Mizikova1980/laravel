@extends('layouts.app')
@section('title')
Страница администратира
@endsection

@section('style')
<style>
    .btn-link {
        padding-left: 0px;
    }
</style>
@endsection

@section('content')
    <div class = "container">
        @if(session('startExportCategories'))
         <div class="alert alert-success">
            Выгрузка категорий запущена
        </div>
        @endif
        @if(session('startExportProducts'))
        <div class="alert alert-success">
           Выгрузка товаров запущена
       </div>
       @endif
       @if(session('startImportCategories'))
       <div class="alert alert-success">
          Загрузка категорий запущена
      </div>
      @endif
      @if(session('startImportProducts'))
        <div class="alert alert-success">
           Загрузка товаров запущена
       </div>
       @endif

        @if(session('saveFile'))
        <div class="alert alert-success">
            Загрузка файла завершена
        </div>
        @endif


        <a href="{{ route('users') }}"> Список пользователей </a>
        <br>
        <a href="{{ route('exportCategories') }}">Категории товаров</a>
        <br>
        <a href="{{ route('exportProducts') }}">Товары</a>
        <div>
            <form method="POST" action="{{ route('exportCategoriesJob') }}">
                @csrf
                <button type="submit" class="btn btn-link"> Выгрузка категорий</button>
            </form>
        </div>
        <div>
            <form method="POST" action="{{ route('exportProductsJob') }}">
                @csrf
                <button type="submit" class="btn btn-link"> Выгрузка продуктов</button>
            </form>
        </div>
        <div>
            <form method="GET" action="{{ route('importCategoriesJob') }}">
                @csrf
                <button type="submit" class="btn btn-link"> Загрузка категорий</button>
            </form>
        </div>
        <div>
            <form method="GET" action="{{ route('importProductsJob') }}">
                @csrf
                <button type="submit" class="btn btn-link"> Загрузка продуктов</button>
            </form>


            <h1>Загрузка файла с категориями</h1>
            <form method="POST" action="{{ route('saveFileCategories')}}" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <input type="file" class="form-control" name='file'>
                 </div>

                <button type="submit" class="btn btn-primary">Загрузить файл</button>
            </form>
            <h1>Загрузка файла с товарами</h1>
            <form method="POST" action="{{ route('saveFileProducts')}}" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <input type="file" class="form-control" name='file'>
                 </div>

                <button type="submit" class="btn btn-primary">Загрузить файл</button>
            </form>


        </div>
    </div>
@endsection
