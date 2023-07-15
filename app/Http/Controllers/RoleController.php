<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getAll()
    {
        $roles = Role::all();
        return view('users', compact('roles'));
    }
}
