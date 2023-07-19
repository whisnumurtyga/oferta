<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $role_id;
    public $userIdDelete;
    public $search;

    protected $listeners = [
        'userCreated' => 'getAllUsers',
        'deleteConfirmed' => 'deleteUser',
    ];

    public function mount()
    {
        $this->getAllUsers();
    }

    public function render()
    {
        return view('livewire.user-table', [
            'users' => $this->getAllUsers(),
            'roles' => Role::all()
        ]);
    }

    public function getAllUsers()
    {
        if($this->role_id <= 1) {
            return User::with('role')->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
                ->orderByDesc('id')
                ->paginate(10);
        } else {
            return User::with('role')
                ->where('role_id', $this->role_id)
                ->orderByDesc('id')
                ->paginate(10);
        }
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




}
