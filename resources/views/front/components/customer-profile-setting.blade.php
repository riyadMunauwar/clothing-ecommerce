<div>
    @if($errors->any())
        <div>
            @foreach($errors->all() as $error)
                <div class="alert alert-warning">
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif
    <div>
        <label>Display Name</label>
        <input wire:model.debounce="user.name" type="text" class="form-control" required>
        <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>

        <label>Email address</label>
        <input wire:model.debounce="user.email" type="email" class="form-control" required>

        <label>Current password (leave blank to leave unchanged)</label>
        <input wire:model.debounce="currentPassword" type="password" class="form-control">

        <label>New password (leave blank to leave unchanged)</label>
        <input wire:model.debounce="newPassword" type="password" class="form-control">

        <label>Confirm new password</label>
        <input wire:model.debounce="confirmPassword" type="password" class="form-control mb-2">

        <button wire:click.debounce="saveChanges" type="button" class="btn btn-outline-primary-2">
            <span>SAVE CHANGES</span>
            <i class="icon-long-arrow-right"></i>
        </button>
    </div>
</div>
