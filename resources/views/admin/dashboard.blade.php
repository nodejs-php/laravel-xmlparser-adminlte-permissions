@extends('admin.layouts.dashboard')

@section('content_header')
    <h1>Таблица товаров</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
@stop


@section('content')
    <div class="row mt-2">
        <div class="col-12 form-group">
            <label for="search">Поиск</label>
            <input type="search" name="search" id="search" class="form-control"/>
            <button class="btn btn-primary my-3" id="searchBtn">Search</button>
        </div>
        <div class="col-12">
            <table id="datatable" class="table"  style="width:100%">
                <thead class="table-dark">
                <tr>
                    <td>ID</td>
                    <td>Category ID</td>
                    <td>Parent ID</td>
                    <td>Category Name</td>
                    <td>Offer ID</td>
                    <td>Available</td>
                    <td>Url</td>
                    <td>Price</td>
                    <td>Old Price</td>
                    <td>Currency ID</td>
                    <td>Picture</td>
                    <td>Offer Name</td>
                    <td>Vendor</td>
                    <td>Created At</td>
                    <td>Updated At</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop


@section('js')
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>

    {{-- Data table Code --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.list-offers') }}',
                    type: "POST",
                    data: function (data) {
                        data.cSearch = $("#search").val();
                    }
                },
                order: ['1', 'DESC'],
                pageLength: 10,
                searching: false,
                bAutoWidth: true,
                aoColumns: [
                    {
                        data: 'id',
                    },
                    {
                        data: 'category_id',
                    },
                    {
                        data: 'parent_id',
                    },
                    {
                        data: 'category_name',
                    },
                    {
                        data: 'offer_id',
                    },
                    {
                        data: 'available',
                        render: function (data, type, row) {
                            return Boolean(row.available);
                        }
                    },
                    {
                        data: 'url',
                        render: function (data, type, row) {
                            return `<a href="${row.url}">Move</a>`;
                        }
                    },
                    {
                        data: 'price',
                    },
                    {
                        data: 'old_price',
                    },
                    {
                        data: 'currency_id',
                    },
                    {
                        data: 'picture',
                        render: function (data, type, row) {
                            return `<img src="${row.picture}"/>`;
                        }
                    },
                    {
                        data: 'offer_name',
                    },
                    {
                        data: 'vendor',
                    },
                    {
                        data: 'created_at',
                    },
                    {
                        data: 'updated_at',
                    }
                ]
            });
        });

        $("#searchBtn").click(function () {
            $('#datatable').DataTable().ajax.reload();
        })
    </script>
@stop



