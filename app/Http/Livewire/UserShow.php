<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class UserShow extends Component
{

    public $search, $role_id_filter, $role_id, $name, $username, $email, $password;
    public $new_role_id, $new_name, $new_username, $new_email, $new_password;
    public $perPage = 30;
    public $currentPage = 1;
    public $userId;
    public $userUpdate;

    public $editModalClicked = False;
    public $addModalClicked = False;

    protected $listeners = [
        'deleteConfirmed' => 'deleteUser'
    ];

    // Todo ==>  CREATE AND READ  <==
    protected function rules()
    {
        // Mengabaikan validasi password pada pembaruan
        if ($this->editModalClicked == True) {
            $rules = [
                'new_role_id' => 'required',
                'new_name' => 'required|string|min:6|alpha',
                'new_username' => 'required|min:6|lowercase|alpha_num',
                'new_email' => ['required', 'email'],
            ];
        } else {
            $rules = [
                'role_id' => 'required',
                'name' => 'required|string|min:6|alpha',
                'username' => 'required|min:6|lowercase|alpha_num|unique:users,username',
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => 'required|min:6',
            ];
        }

        return $rules;
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
        $this->addModalClicked = True;
        $this->editModalClicked = False;
        // dd("hola");
        $validatedData = $this->validate();
        User::create($validatedData);
        $this->getUsers();
        $this->resetInput();

        $this->dispatchBrowserEvent('create-user-alert');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function addModalClosed()
    {
        $this->addModalClicked = False;
        $this->resetInput();
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


    // Todo EDIT

    public function editUser(int $userId)
    {
        $this->addModalClicked = False;
        $this->editModalClicked = True;

        $this->userUpdate = User::find($userId);

        $this->userId = $userId;
        $this->new_role_id = $this->userUpdate->role_id;
        $this->new_name = $this->userUpdate->name;
        $this->new_username = $this->userUpdate->username;
        $this->new_email = $this->userUpdate->email;
    }

    public function updateUser()
    {
        $validatedData = $this->validate();

        User::where('id', $this->userId)->update([
            'role_id' => $validatedData['new_role_id'],
            'name' => $validatedData['new_name'],
            'username' => $validatedData['new_username'],
            'email' => $validatedData['new_email'],
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('user-updated');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editModalClosed()
    {
        $this->editModalClicked = False;
        $this->resetInput();
    }



}
