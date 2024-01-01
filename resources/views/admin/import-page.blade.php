@extends('admin.layouts.dashboard')

@section('content_header')
    <h1>Импорт продуктов</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop


@section('content')
    <div class="row">
            <button id="import" class="btn btn-block btn-secondary import">Импортировать данные c API</button>
    </div>
@stop

@section('js')
    <script>
        $("button#import").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/admin/import-products/",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    alert('Товары импортированы успешно');
                },
                error: function (result) {
                    alert('Ошибка при импорте товаров');
                }
            });
        });
    </script>
@stop



