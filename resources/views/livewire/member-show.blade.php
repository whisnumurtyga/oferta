

<div>
    <div >
        @include("livewire.member-modal")
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
            Add Member
        </button>
        <div class="">
            {{-- {{ $search }}
            {{ $major_filter }}
            {{ $faculty_filter }}
            {{ $year_filter }} --}}
            <div class="mt-2 py-3">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <input  wire:model="search" type="text" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="major_filter" name="major_filter" class="form-select custom-select" wire:model="major_filter" >
                                <option   option value="0" selected>Select Major</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="faculty_filter" name="faculty_filter" class="form-select custom-select" wire:model="faculty_filter" >
                                <option value="0" selected>Select Faculty</option>
                                <option value="FTIB">FTIB</option>
                                <option value="FTEIC">FTEIC</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="year_filter" name="year_filter" class="form-select custom-select" wire:model="year_filter" >
                                <option value="0" selected>Select Year</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-user">
                    <table class="table table-hover mx-auto mt-2">
                        <thead class="sticky-top">
                            <tr class="text-center" style="background-color: #625757;">
                                <th scope="col" class="text-white">#</th>
                                <th scope="col" class="text-white">Name</th>
                                <th scope="col" class="text-white">NIM</th>
                                <th scope="col" class="text-white">Major</th>
                                <th scope="col" class="text-white">Faculty</th>
                                <th scope="col" class="text-white">Year</th>
                                @if (Auth::user()->role_id <= 2)
                                    <th scope="col" class="text-white">Action</th>
                                @endif
                            </tr>
                        </thead>
                        {{-- {{ dd($users) }} --}}
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->nim }}</td>
                                    <td>{{ $member->major}}</td>
                                    <td>{{ $member->faculty }}</td>
                                    <td>{{ $member->year }}</td>
                                    @if (Auth::user()->role_id <= 2)
                                        <td colspan="3" class="text-white">
                                            <div class="row p-1 d-flex justify-content-center align-items-center">
                                                <div class="col-4">
                                                    <button type="button" class="btn btn-sm  btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editMemberModal" wire:click.prevent="editMember({{ $member->id }})">
                                                        edit
                                                    </button>
                                                </div>
                                                <div class="col-4">
                                                    <a wire:click.prevent="deleteConfirmation({{ $member->id }})" class="btn btn-sm  btn-outline-danger delete-button" style="color:#625757">
                                                        delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
</div>


    {{-- Sweet Alert Delete Script --}}
    <script>
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You woant to delete this member?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#625757',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Sure'
                }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            })
        })

        window.addEventListener('member-deleted', event => {
            Swal.fire({
                title: 'Deleted',
                text: "member has been deleted",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>

    {{-- Sweet Alert Create Script --}}
    <script>
        window.addEventListener('create-member-alert', event => {
            Swal.fire({
                title: 'Added',
                text: "Member has been added successfully!",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>

    {{-- Sweet Alert Update Script --}}
    <script>
        window.addEventListener('user-updated', event => {
            Swal.fire({
                title: 'Updated',
                text: "User has been updated",
                icon: 'success',
                confirmButtonColor: '#625757',
                confirmButtonText: 'Ok'
            })
        })
    </script>


