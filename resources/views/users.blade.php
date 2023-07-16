@extends('layouts.app')

@section('title', 'Oferta - Users')

@section('content')

<h1 class="text-primary">This is the Users Page</h1>
        {{-- <livewire:add-user-form :roles="$roles" /> --}}
        @livewire("add-user-form")


    <div class="mt-5 col-lg-8 py-5" >
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add User
        </button>


        @livewire('user-table')
    </div>
@stop
