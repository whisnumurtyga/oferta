<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Livewire\Component;

class MemberShow extends Component
{
    public $search, $major_filter, $faculty_filter, $year_filter;
    public $name, $nim, $major, $faculty, $year;
    public $new_name, $new_nim, $new_major, $new_faculty, $new_year;
    public $memberId;
    public $memberUpdate;
    public $editModalClicked = False;
    public $addModalClicked = False;

    protected $listeners = [
        'deleteConfirmed' => 'deleteMember'
    ];

    public function render()
    {
        return view('livewire.member-show',[
            'members' => $this->getMembers()
        ]);
    }

    protected function rules()
    {
        if ($this->editModalClicked == True) {
            $rules = [
                'new_name' => 'required|string',
                'new_nim' => 'required|numeric|digits:10',
                'new_major' => 'required|string',
                'new_faculty' => 'required|string',
                'new_year' => 'required|numeric',
            ];
        } else {
            $rules = [
                'name' => 'required|string',
                'nim' => 'required|numeric|digits:10',
                'major' => 'required|string',
                'faculty' => 'required|string',
                'year' => 'required|numeric',
            ];
        }

        return $rules;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    public function getMembers()
    {
        $query = Member::orderByDesc('id');

        if ($this->major_filter != 0) {
            $query->where('major', $this->major_filter);
        }
        if ($this->faculty_filter != 0) {
            $query->where('faculty', $this->faculty_filter);
        }
        if ($this->year_filter != 0) {
            $query->where('year', $this->year_filter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nim', 'like', '%' . $this->search . '%');
            });
        }

        $users = $query->get();

        return $users;
    }

    public function addMember()
    {
        $this->addModalClicked = True;
        $this->editModalClicked = False;
        $validatedData = $this->validate();
        Member::create($validatedData);
        $this->getMembers();
        $this->resetInput();

        $this->dispatchBrowserEvent('create-member-alert');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function addModalClosed()
    {
        $this->addModalClicked = False;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = "";
        $this->nim = "";
        $this->major = "";
        $this->faculty = "";
        $this->year = "";
    }


    // Todo DELETE
    public function deleteConfirmation($memberId)
    {
        // dd($memberId);
        $this->memberId = $memberId;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteMember()
    {
        Member::find($this->memberId)->delete();
        $this->getMembers();

        $this->dispatchBrowserEvent('member-deleted');
    }

    public function editMember(int $memberId)
    {
        $this->addModalClicked = False;
        $this->editModalClicked = True;

        $this->memberUpdate = Member::find($memberId);

        $this->memberId = $memberId;
        $this->new_name = $this->memberUpdate->name;
        $this->new_nim = $this->memberUpdate->nim;
        $this->new_major = $this->memberUpdate->major;
        $this->new_faculty = $this->memberUpdate->faculty;
        $this->new_year = $this->memberUpdate->year;
    }

    public function updateMember()
    {
        $validatedData = $this->validate();

        Member::where('id', $this->memberId)->update([
            'name' => $validatedData['new_name'],
            'nim' => $validatedData['new_nim'],
            'major' => $validatedData['new_major'],
            'faculty' => $validatedData['new_faculty'],
            'year' => $validatedData['new_year'],
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
