@extends('layout')
@section('title', 'Alunos')
    @push('link')
        <link rel="stylesheet" href="{{ asset('assets/css/students.css') }}">
    @endpush
@section('content')
    <nav class="breadcrumb-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Alunos</li>
        </ol>
        <ol class="float-end">
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" id="search-id" placeholder="Digite o ID" aria-label="Digite o ID" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                </div>
            </li>
        </ol>
    </nav>
    <div class="content">
        <table class="table table-light table-borderless table-striped table-hover">
            <thead class="table-dark">
                <th>Id</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Status</th>
                <th>Courses</th>
                <th>Data de criação</th>
                <th>Data da atualização</th>
                <th>Ação</th>
            </thead>
            <tbody class="empty">
                @foreach($students as $student)
                    <tr>
                        <td>{{$student->id}}</td>
                        <td><img src="{{asset(str_replace("public", "storage",$student->img_path))}}" alt="img"></td>
                        <td class="blur" id="name-{{$student->id}}" contenteditable="true">{{$student->name}}</td>
                        <td class="blur" id="status-{{$student->id}}" contenteditable="true">{{$student->status}}</td>
                        <td class="blur" id="courses-{{$student->id}}" contenteditable="true">{{$student->courses}}</td>
                        <td>{{$student->created_at}}</td>
                        <td>{{$student->updated_at}}</td>
                        <td>
                            <a href="#" class="delete" id="id-{{$student->id}}">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $students->links() !!}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form action="/admin/students/storage" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar novo Aluno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" name="name" type="text" placeholder="Nome" /><br/>
                    <input class="form-control" name="status" type="text" placeholder="Status" /><br/>
                    <input class="form-control" id="cep" name="cep" type="number" placeholder="Cep" /><br/>
                    <input class="form-control" id="cursos" name="cursos" type="text" placeholder="Cursos" /><br/>
                    <input class="form-control" id="bairro" name="bairro" type="text" disabled/><br/>
                    <input class="form-control" id="cidade" name="cidade" type="text" disabled/><br/>
                    <input class="form-control" id="estado" name="estado" type="text" disabled/><br/>
                    <input class="form-control" id="logradouro" name="logradouro" type="text" disabled/><br/>
                    <input class="form-control" id="numero" name="numero" type="number"/><br/>
                    <input name="img_path" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <input  class="btn btn-primary new-student" type="submit" value="Salvar">
                </div>
            </div>
        </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
        $('#cep').change(function(){
            cep = $('#cep').val();
            
            $.ajax({
                url: 'https://serviceweb.aix.com.br/aixapi/api/cep/'+cep,
                type: 'GET',
                data: {
                    value: cep,
                },
                dataType: 'JSON',
        
                success: function(data){
                    $('#bairro').val(data.bairro)
                    $('#cidade').val(data.cidade)
                    $('#estado').val(data.estado)
                    $('#logradouro').val(data.logradouro)
                    console.log(data);
                }
            });
            return false;

        })

        $('button').click(function(){
            let id = $('#search-id').val()

            $.ajax({
                url: '/admin/students/show/'+id,
                type: 'GET',
                data: {
                    value: id,
                },
                dataType: 'JSON',
        
                success: function(data){
                    $('.empty').empty()
                    let photo = data.img_path;
                    console.log(photo.replace('public', 'storage'))
                    $('.empty').append('<tr><td>'+data.id+'</td><td><img src="/'+photo.replace('public', 'storage')+'" alt="Photo"/></td><td>'+data.status+'</td><td>'+data.name+'</td><td>'+data.courses+'</td><td>'+data.created_at+'</td><td>'+data.updated_at+'</td><td>Em Breve</td></tr>')
                    console.log(data)
                }
            });
            return false;

        })
        $('.delete').click(function(){
            let split_id = $(this).attr('id').split('-');
            let fild_id = split_id[1];

            $.ajax({
                url: '/admin/students/delete',
                type: 'GET',
                data: {
                    id: fild_id
                },
                dataType: 'JSON',
        
                success: function(data){
                    console.log(data);
                    window.location.href = "/admin/students/show";
                }
            });
            return false;

        })
        $('.blur').blur(function(){

            let split_id = $(this).attr('id').split('-');
            let fild_name = split_id[0];
            let fild_id = split_id[1];
            let value = $(this).text(); 

            $.ajax({
                url: '/admin/students/update',
                type: 'GET',
                data: {
                    field: fild_name,
                    value: value,
                    id: fild_id
                },
                dataType: 'JSON',

                success: function(data){
                    console.log(data);
                }
            });
            return false;

        })

    </script>
@endsection

