@extends('layouts.app')

@section('title', 'Nuovo progetto')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Nuovo progetto</h1>
    </header>
    <hr>
    @include('includes.projects.form')


@endsection

@section('scripts')

@endsection
