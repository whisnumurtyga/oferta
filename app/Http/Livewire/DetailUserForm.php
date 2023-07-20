<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Livewire;

class DetailUserForm extends Component
{
    public $role_id;
    public $name;
    public $username;
    public $email;
    public $password;
    public $roles;
    public $idUser;

    public $isOpen = false;


    protected $listeners = [
        'showUserDetails',
        'toggleModal'
    ];

    public function toggleModal($id)
    {
        $this->idUser = $id;
        $this->isOpen = !$this->isOpen;
        $this->showUserDetails($id);
    }


    public function render()
    {
        $this->roles = $this->getAllRoles();
        return view('livewire.detail-user-form');
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
    public function showUserDetails($id)
    {
        $userData = User::where('id', $id)->first();
        $this->roles = $this->getAllRoles();
        $this->role_id = $userData->role_id;
        $this->name = $userData->name;
        $this->username = $userData->username;
        $this->email = $userData->email;
        // dd("masuk show user detrail");
    }


}

?>
