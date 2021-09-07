{{dd('teste')}}
@extends('layout')
@section('title', 'Perfil')

@section('content')
    {{session('me')->name}}
@endsection
