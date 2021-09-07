@extends('layout')
@section('title', 'Setups')
    @push('link')
        <link rel="stylesheet" href="{{ asset('assets/css/setups.css') }}">
    @endpush
@section('content')
    <div class="content">
        <div class="main">
            <div class="um">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                </div>
            </div>
            <div class="dois">adasdas</div>
            <div class="um">asdas</div>
            <div class="dois">adasdas</div>
        </div>
    </div>
@endsection