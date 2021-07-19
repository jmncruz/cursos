@extends('layout')
@section('title', 'Cursos')
    @push('link')
        <link rel="stylesheet" href="{{ asset('assets/css/courses.css') }}">
    @endpush
@section('content')
    <nav class="breadcrumb-nav" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cursos</li>
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
                <form action="/admin/courses/upload" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input name="courses" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <input class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04" />
                    </div>
                </form>
            </li>
        </ol>
    </nav>
    <div class="content">
        <table class="table table-light table-borderless table-striped table-hover">
            <thead class="table-dark">
                <th>Id</th>
                <th>Nome</th>
                <th>Data de criação</th>                        
                <th colspan="2">Ação</th>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr class="">
                        <td class="id">{{$course->id}}</td>
                        <td class="blur" id="name-{{$course->id}}" contenteditable="true">{{$course->name}}</td>
                        <td>{{$course->created_at}}</td>
                        <td></td>
                        <td>
                            <a href="#" class="delete" id="id-{{$course->id}}">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $courses->links() !!} 
    </div>
  
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar novo Curso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label>Novo Curso</label>
                    <input class="input" type="text"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary new-course">Save changes</button>
            </div>
        </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
        $('.delete').click(function(){
            let split_id = $(this).attr('id').split('-');
            let fild_id = split_id[1];

            $( ".delete" ).hide()

            $.ajax({
                url: '/admin/courses/delete',
                type: 'GET',
                data: {
                    id: fild_id
                },
                dataType: 'JSON',
        
                success: function(data){
                    console.log(data);
                    window.location.href = "/admin/courses/show";
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
                url: '/admin/courses/update',
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
        $('.new-course').click(function(){
            value = $('.input').val();
            
            $.ajax({
                url: '/admin/courses/storage',
                type: 'GET',
                data: {
                    value: value,
                },
                dataType: 'JSON',
        
                success: function(data){
                    console.log(data);
                    window.location.href = "/admin/courses/show";
                }
            });
            return false;

        })

    </script>
@endsection

