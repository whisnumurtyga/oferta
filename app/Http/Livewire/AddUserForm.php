<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class AddUserForm extends Component
{
    public $role_id;
    public $name;
    public $username;
    public $email;
    public $password;
    public $roles;

    public function render()
    {
        $this->getAllRoles();
        return view('livewire.add-user-form');
    }


    public function getAllRoles()
    {
        $this->roles = Role::all();
    }

    public function createUser()
    {
        // dd("Masuk fungsi");
        User::create([
            'role_id' => $this->role_id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password
        ]);


        $this->emit('hideAddUserModal');
    }
}
