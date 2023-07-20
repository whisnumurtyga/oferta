@extends('layouts.app')

@section('title', 'Oferta - Users')

@section('content')

<h1 class="text-primary">This is the Users Page</h1>
    <div class="mt-5 col-lg-12 py-5" >
        @livewire('user-show')
    </div>
@stop
