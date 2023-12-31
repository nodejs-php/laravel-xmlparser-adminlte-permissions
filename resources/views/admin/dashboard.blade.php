@extends('admin.layouts.dashboard')

@section('content_header')
    <h1>Таблица товаров</h1>
@stop

@section('content')
    <p>
        <button type="submit" class="btn btn-block btn-primary download"  onclick="window.location.href='{{asset('/export')}}'">Excel файл</button>
    </p>
@stop
