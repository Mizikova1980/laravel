@extends('layouts.app')

@section('title')
    {{$title}}
@endsection

@section('content')

<div class="container">
    @auth
        Вы это читаете, потому что вы авторизованы
    @endauth

    @guest
        Пожалуйста, авторизуйтесь
    @endguest


    <h1>{{$title}}</h1>


    <home-component source="blade_templade" :categories="{{$categories}}" ></home-component>

</div>
@endsection
