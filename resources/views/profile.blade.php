@extends('layouts.app')

@section('title')
Личный кабинет
@endsection

@section('style')
<style>

</style>
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

        @if (session()->has('profileUpdated'))
            <div class="alert alert-success">
                Профиль успешно обновлен!
            <div>
        @endif

        @if (session()->has('currentPasswordError'))
            <div class="alert alert-danger">
                Вы ввели неверный пароль!
            <div>
        @endif

        <form method="POST" action="{{ route('profileUpdate')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" >Почта</label>
                <input type="email" class="form-control" name='email' value="{{ $user->email }}" >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"> Имя </label>
                <input type="name" class="form-control @if ($errors-> has('name')) text-danger  @endif"
                    name='name'
                    value="{{ $user->name}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                    Текущий пароль
                </label>
                <input
                    autocomplete="new-password"
                    class="form-control"
                    name="current_password"
                    type="password"
                    >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                    Новый пароль
                </label>
                <input
                    class="form-control"
                    name="password"
                    type="password"
                    >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">
                     Повторите пароль
                </label>
                <input
                    class="form-control"
                    name="password_confirmation"
                    type="password"
                    >
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Список адресов
                </label>
                <br>
                @foreach ( $user->addresses as $address )
                    <span>
                        @if ($address->main)
                            <label for="{{ $address->id }}">
                                {{ $address->address }}
                            </label>
                            <input checked id="{{ $address->id }}" type="radio" name="main_address" value="{{ $address->id }}">
                        @else
                            <label for="{{ $address->id }}">
                                {{ $address->address }}
                            </label>
                            <input id="{{ $address->id }}" type="radio" name="main_address" value="{{ $address->id }}">
                         @endif
                    </span>
                    <br>
                @endforeach
            </div>


            <div class="mb-3">
                <label class="form-label">
                    Новый адрес
                </label>
                <input name="new_address" class="form-control">
                <label> Сделать основным </label>
                <input type="checkbox" name="main_new_address">
            </div>

            <div class="mb-3">
                <label class="form-label" >Изображение</label>
                <br>
                <img style="width: 200px; margin-bottom:10px;" src="{{ asset('storage/img/users')}}/{{$user->picture}}">
                <br>
                <input type="file" class="form-control" name='picture'>
             </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

@endsection

