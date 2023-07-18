<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DeleteUser extends Component
{
    public $confirmingUserDeletion = false;


    public function render()
    {
        return view('livewire.delete-user');
    }

    public function confirmDeleteUser($userId)
    {
        $this->confirmingUserDeletion = $userId;
    }

    public function deleteUser($userId)
    {
        User::find($userId)->delete(); // Menghapus pengguna berdasarkan ID
    }

    public function deleteUserConfirmed()
    {
        $this->deleteUser($this->confirmingUserDeletion);
        $this->confirmingUserDeletion = false;
    }

}
