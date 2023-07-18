<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    public $users;
    public $userIdToDelete;
    public $showModal = false;

    protected $listeners = ['userCreated' => 'getAllUsers'];

    public function mount()
    {
        $this->getAllUsers();
    }

    public function render()
    {
        return view('livewire.user-table');
    }

    public function getAllUsers()
    {
        $this->users = User::with('role')->get();
    }



    public function deleteUser()
    {
        dd($this->userIdToDelete);
        User::find($this->userIdToDelete)->delete();
        $this->getAllUsers();
    }

    public function openModal($userId)
    {
        $this->showModal = true;
        $this->userIdToDelete = $userId;
    }


    public function refreshUserTable()
    {
        $this->getAllUsers();
    }



}
