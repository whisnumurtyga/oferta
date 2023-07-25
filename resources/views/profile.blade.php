@extends('layouts.app')

@section('title', 'Oferta - Profile')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="container mt-4">
            <div class="card">
                @if(session('success'))
                    <div class="alert alert-success msg text-center">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('failed'))
                    <div class="alert alert-danger msg text-center">
                        {{ session('failed') }}
                    </div>
                @endif
                <div class="card-header">
                    <h5>My Profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateProfile', ['id' => Auth::user()->id, 'role_id' => Auth::user()->role->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="role" class="form-control" name="role" id="role" name="role" value="{{ Auth::user()->role->role_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
