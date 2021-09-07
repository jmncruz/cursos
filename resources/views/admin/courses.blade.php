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
                            <a href="#" class="delete" id="id-{{$course->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary new-course">Salvar</button>
            </div>
        </div>
        </div>
    </div>
    @push('script')
        <script src="{{ asset('assets/js/courses.js') }}"  ></script>
    @endpush
@endsection

