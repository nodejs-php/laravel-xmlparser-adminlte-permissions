@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop

@section('js')
    <script>
        $("button#import").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/admin/logout",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    window.location.reload();
                },
                error: function (result) {
                    alert('Ошибка при выходе');
                }
            });
        });
    </script>
@stop
