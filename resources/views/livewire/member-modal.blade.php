<div>
    {{-- TODO ==> INSERT MODAL <=== --}}
    <div wire:ignore.self class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            {{-- @if ($errors->any())
                {{ dd($errors) }}
            @endif --}}
            {{-- @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addMemberModalLabel">Add Member</h1>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addMember" novalidate>
                        <div class="mb-1">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" wire:model="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div>
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="name" wire:model="nim">
                            @if ($errors->has('nim'))
                                <span class="text-danger">{{ $errors->first('nim') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="major" class="form-label">Major</label>
                            <select id="major" name="major" class="form-select custom-select" wire:model="major">
                                <option value="0" selected>Select Major</option>
                                <option value="Informatika">Informatika</option>
                                <option value="Data Science">Data Science</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                            </select>
                            @if ($errors->has('major') && ($major == 0))
                                <span class="text-danger">{{ $errors->first('major') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="faculty" class="form-label">Faculty</label>
                            <select id="faculty" name="faculty" class="form-select custom-select" wire:model="faculty">
                                <option value="0" selected>Select Faculty</option>
                                <option value="FTIB">FTIB</option>
                                <option value="FTEIC">FTEIC</option>
                            </select>
                            @if ($errors->has('faculty') && ($faculty == 0))
                                <span class="text-danger">{{ $errors->first('faculty') }}</span>
                            @endif
                        </div>
                        <div class="mb-1">
                            <label for="year" class="form-label">Year</label>
                            <select id="year" name="year" class="form-select custom-select" wire:model="year">
                                <option value="0" selected>Select Year</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                            @if ($errors->has('year') && ($year == 0))
                                <span class="text-danger">{{ $errors->first('year') }}</span>
                            @endif
                        </div>


                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" wire:click="AddModalClosed">Close</button>
                            <button type="submit" class="btn btn-primary">Add Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Todo DELETE MODAL --}}
    <div>
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete?
                    </div>
                    <div class="modal-footer">
                        <button wire:click="deleteMember" type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- TODO ==> EDIT MODAL <=== --}}
































</div>
