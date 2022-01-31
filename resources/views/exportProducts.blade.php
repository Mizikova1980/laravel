
@extends('layouts.app')

@section('title')
Работа с товарами
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
        <h1>Добавление нового товара</h1>
            <form method="POST" action="{{ route('createProduct')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" >Название категории</label>
                <input type="name" class="form-control" name='category_id'>
              </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label" >Название товара</label>
              <input type="name" class="form-control" name='name'>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label" >Описание</label>
              <input type="name" class="form-control" name='description'>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label" >Цена</label>
                <input type="name" class="form-control" name='price'>
              </div>
            <div class="mb-3">
                <label class="form-label" >Изображение</label>
                <input type="file" class="form-control" name='picture'>
              </div>

            <button type="submit" class="btn btn-primary">Добавить</button>
          </form>




        <h1>Список существующих товаров</h1>
        <table class='table table-border'>
        <thead>
            <tr>
                <th>id</th>
                <th>Категория</th>
                <th>Название </th>
                <th>Описание</th>
                <th>Цена</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{$product->id }}</td>
                <td>{{ $product->category_id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description}}</td>
                <td>{{ $product->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


</div>
@endsection
