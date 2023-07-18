<div>
    @if ($confirmingUserDeletion)
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
                    <button wire:click="deleteUserConfirmed" type="button" class="btn btn-danger">Delete</button>
                    <button wire:click="$set('confirmingUserDeletion', false)" type="button" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
