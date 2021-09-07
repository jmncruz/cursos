@extends('layout')
@section('title', 'Seja bem-vindo')

@section('content')
    {{session('me')->name}}
@endsection
