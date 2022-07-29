@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Cargos - <b>{{$user->name}}</b></h1>
        @include('admin.includes.alerts')
    </div>
    <div class="col-6 col-md-2"><a href="{{ route('users.cargos.available', $user->id) }}" class="btn btn-dark">Adicionar - Cargo</a></div>
</div>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.cargos',[$user->id]) }}">Cargos Vinculados</a></li>
</ol>

@stop

@section('content')

<div class="card-body">
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
    </table>

</div>
@stop

@section('css')

@stop

@section('js')
<script>
    $(function(){
        let url = window.location.origin
        function table_data_row(data) {
            var	rows = '';
            var i = 0;
            $.each( data, function( key, value ) {

                rows = rows + '<tr>';
                rows = rows + '<td>'+value.name+'</td>';
                rows = rows + '<td>'+value.description+'</td>';
                rows = rows + '<td data-id="'+value.id+'">';
                rows = rows + '<a class="btn btn-sm btn-danger text-light"  id="deleteRow" data-id="'+value.id+'" >Desvincular</a> ';
                rows = rows + '</td>';
                rows = rows + '</tr>';
            });
            $("#tbody").html(rows);
        }

        function getAllCargos()
        {
            axios.post("{{ route('cargo-test',$user->id) }}")
                .then(function(res){
                    table_data_row(res.data)
                     //console.log(res.data);
                })
        }
        getAllCargos()
        // desvincular cargos do usuário
        $('body').on('click','#deleteRow',function (e) {
            e.preventDefault();
            let id = $(this).data('id')
            let userId = {{$user->id}}
            // let del = url + '/category/' + id
            // console.log(del)
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Você tem certeza?',
                text: "Cargo será desvinculado!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, desvincular!',
                cancelButtonText: 'Não, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get(`${url}/admin/users/${userId}/cargos/${id}/detach`).then(function(r){
                        getAllCargos();
                        swalWithBootstrapButtons.fire(
                            'Desvinculado!',
                            ':)',
                            'success'
                        )
                    });
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'cargo continua vinculado :)',
                        'error'
                    )
                }
            })
        });

    })
</script>
@stop
