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
        </ol>
    </nav>
    <table class="table table-light table-borderless table-striped table-hover">
        <thead class="table-dark">
            <th>Id</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Imagem</th>
            <th>Courses</th>
            <th>Data de criação</th>
            <th>Data da atualização</th>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->status}}</td>
                    <td>{{$student->img_path}}</td>
                    <td>{{$student->courses}}</td>
                    <td>{{$student->created_at}}</td>
                    <td>{{$student->updated_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $students->links() !!}

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
                    <input name="name" type="text" placeholder="Nome" /><br/>
                    <input name="status" type="text" placeholder="Status" /><br/>
                    <input id="cep" name="cep" type="number" placeholder="Cep" /><br/>
                    <input id="cursos" name="cursos" type="text" placeholder="Cursos" /><br/>
                    <input id="bairro" name="bairro" type="text" disabled/><br/>
                    <input id="cidade" name="cidade" type="text" disabled/><br/>
                    <input id="estado" name="estado" type="text" disabled/><br/>
                    <input id="logradouro" name="logradouro" type="text" disabled/><br/>
                    <input id="numero" name="numero" type="number"/><br/>
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
    </script>
@endsection

