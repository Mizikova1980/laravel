
@extends('layouts.app')

@section('title')
Работа с категориями товаров
@endsection


@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row justify-content-center">
        <h1>Добавление новой категории товара</h1>
            <form method="POST" action="{{ route('createCategory')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label" >Название категории</label>
              <input type="name" class="form-control" name='name'>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label" >Описание</label>
              <input type="name" class="form-control" name='description'>
            </div>
            <div class="mb-3">
                <label class="form-label" >Изображение</label>
                <input type="file" class="form-control" name='picture'>
              </div>

            <button type="submit" class="btn btn-primary">Добавить</button>
          </form>




        <h1>Список существующих категорий</h1>
        <table class='table table-border'>
        <thead>
            <tr>
                <th>id</th>
                <th>Название </th>
            </tr>
        </thead>
        @foreach ($categories as $category)
            <tr>
                <td>{{$category->id }}</td>
                <td>{{ $category->name }}</td>
            </tr>
        @endforeach


        <tbody>

        </tbody>
    </table>


</div>
@endsection
