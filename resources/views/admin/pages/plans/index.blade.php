@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="row">
        <div class="col-md-10">
            <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark" id="test"><i class="fa fa-plus-square"></i></a></h1>
        </div>
    </div>
    <ol class="breadcrumb" style="margin-top: 20px">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    </ol>

@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- formulário de pesquisa -->
            <form method="POST" action="{{ route('plans.search') }}" class="form form-inline">
                @csrf
                <div class="row">
                    <input type="text" id="filter" name="filter" class="form-control" placeholder="Nome do Plano">
                    <button id="search_plans" type="submit" class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <!-- listagem dos planos -->
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody id="tbody">
            @foreach($plans as $plan)
                <tr>
                    <td>{{ucwords($plan->name)}}</td>
                    <td>R$ - {{number_format($plan->price, 2, ',','.')}}</td>
                    <td>{{$plan->description}}</td>
                    <td style="width: 350px;">
                        <a href="{{route('details.plans.index', $plan->url)}}" class="btn btn-primary"><i class="fa fa-adjust" aria-hidden="true"></i></a>
                        <a href="{{route('plans.show', $plan->url)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="{{route('plans.edit', $plan->url)}}" class="btn btn-warning"><i class="fas fa-edit"></i></i></a>
                        <a href="{{route('plans.profiles', $plan->id)}}" class="btn btn-secondary"><i class="far fa-fw fa-address-book"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
@stop
@section('js')
    <script>
        $(function(){

            function table_data_row(data) {
                var	rows = '';
                var i = 0;
                $.each( data, function( key, value ) {
                    rows = rows + '<tr>';
                    rows = rows + '<td>'+value.name+'</td>';
                    rows = rows + '<td>'+value.price+'</td>';
                    rows = rows + '<td>'+value.description+'</td>';
                    // rows = rows + '<td data-id="'+value.id+'" class="text-center">';
                    // rows = rows + '<a class="btn btn-sm btn-info text-light" id="editRow" data-id="'+value.id+'" data-toggle="modal" data-target="#editModal">Edit</a> ';
                    // rows = rows + '<a class="btn btn-sm btn-danger text-light"  id="deleteRow" data-id="'+value.id+'" >Delete</a> ';
                    // rows = rows + '<a class="btn btn-sm btn-success text-light"  id="viewRow" data-id="'+value.id+'" >View</a> ';
                    // rows = rows + '</td>';
                    rows = rows + '</tr>';
                });
                $("#tbody").html(rows);
            }
            // trás resultados ao ir digitando
            $( "#filter" ).keyup(function() {

                    try {
                        const response = axios.post("{{route('plans.search')}}",{
                            filter: $('#filter').val()
                        }).then(function (response) {
                            // if(response.data.length === 0) {
                            //     console.log('sem resultado')
                            // }
                            table_data_row(response.data)
                            console.log(response.data)
                            })
                    } catch (error) {
                        //erro sempre cai aqui
                    }

            })
        })

            {{--function getAllData(){--}}
            {{--    axios.get("{{ route('plans.search') }}")--}}
            {{--        .then(function(res){--}}
            {{--            console.log(res.data);--}}
            {{--        })--}}
            {{--}--}}
            {{--getAllData();--}}


    </script>
@stop
