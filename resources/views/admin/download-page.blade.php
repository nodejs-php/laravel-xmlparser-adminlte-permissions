@extends('admin.layouts.dashboard')

@section('content_header')
    <h1>Выгрузка продуктов</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop


@section('content')
    <div class="row">
        <button type="submit" class="btn btn-block btn-secondary download"
                onclick="window.location.href='{{asset('admin/download-products')}}'">Скачать Excel файл
        </button>
    </div>
@stop



