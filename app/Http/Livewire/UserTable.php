<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    public $users;
    public $roles;

    public function render()
    {
        $this->getAllUsers();
        // $this->getAllRoles();
        return view('livewire.user-table');
    }

    // public function getAllRoles()
    // {
    //     $this->roles = User::with('role')->get();
    // }

    public function getAllUsers()
    {
        $this->users = User::with('role')->get();
    }


}
