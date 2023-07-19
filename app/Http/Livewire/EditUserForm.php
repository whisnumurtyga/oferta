<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Livewire;

class EditUserForm extends Component
{
    public $role_id;
    public $name;
    public $username;
    public $email;
    public $password;
    public $roles;
    public function render()
    {
        $this->roles = $this->getAllRoles();
        return view('livewire.edit-user-form');
    }

    public function getAllRoles()
    {
        return Role::all();
    }

    public function createUser()
    {
        User::create([
            'role_id' => $this->role_id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password
        ]);

        $this->emit('userCreated'); // Emit event untuk memberitahu bahwa pengguna baru telah dibuat
        $this->emit('hideAddUserModal');
        $this->dispatchBrowserEvent('create-user-alert');

        $this->resetModal();
    }


    public function resetModal()
    {
        $this->role_id = "";
        $this->name = "";
        $this->username = "";
        $this->email = "";
        $this->password = "";
    }
}

?>
