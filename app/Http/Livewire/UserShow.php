<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class UserShow extends Component
{
    use WithPagination;

    public $search, $role_id_filter, $role_id, $name, $username, $email, $password;
    public $userId;

    protected $listeners = [
        'deleteConfirmed' => 'deleteUser'
    ];

    // Todo ==>  CREATE AND READ  <==
    protected function rules()
    {
        return [
            'role_id' => 'required',
            'name' => 'required|string|min:6|alpha',
            'username' => 'required|min:6|lowercase|alpha_num|unique:users,username',
            'email' => ['required','email','unique:users,email'],
            'password' => 'required|min:6',
        ];
    }


    public function render()
    {
        return view('livewire.user-show', [
            'roles' => Role::all(),
            'users' => $this->getUsers()
        ]);
    }

    public function getUsers()
    {
        $query = User::with('role')
            ->orderByDesc('id');

        if ($this->role_id_filter > 0) {
            $query->where('role_id', $this->role_id_filter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->get();
        return $users;

    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addUser()
    {
        // dd("hola");
        $validatedData = $this->validate();
        User::create($validatedData);
        $this->getUsers();
        $this->resetInput();

        $this->dispatchBrowserEvent('create-user-alert');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInput()
    {
        $this->role_id = "";
        $this->name = "";
        $this->username = "";
        $this->email = "";
        $this->password = "";
    }



    // Todo DELETE
    public function deleteConfirmation($userId)
    {
        // dd($userId);
        $this->userId = $userId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteUser()
    {
        User::find($this->userId)->delete();
        $this->getUsers();

        $this->dispatchBrowserEvent('user-deleted');
    }

}
