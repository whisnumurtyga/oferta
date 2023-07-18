<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $userIdDelete;
    public $search;
    public $paginationTheme = 'bootstrap';

    protected $listeners = [
        'userCreated' => 'getAllUsers',
        'deleteUser',
        'deleteConfirmed' => 'deleteUser'
    ];

    public function mount()
    {
        $this->getAllUsers();
    }

    public function render()
    {
        return view('livewire.user-table', [
            'users' => $this->getAllUsers()
        ]);
    }

    public function getAllUsers()
    {
        return User::with('role')->when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })->paginate(10);
    }

    public function deleteConfirmation($userId)
    {
        $this->userIdDelete = $userId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteUser()
    {
        User::find($this->userIdDelete)->delete();
        $this->getAllUsers();

        $this->dispatchBrowserEvent('user-deleted');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
