<div class="modal fade" wire:ignore.self id="add-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" data-bs-config={backdrop:true}>
    <form wire:submit="Save">
    <div class="modal-content">
      <div class="modal-header" >
        <h1 class="modal-title fs-5" x-text="$wire.editing?'Editing Contact':'Adding New Contact'"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-2">
          <label for="name" class="form-label">Name:</label>
          <input type="text" class="form-control @error('data.name') is-invalid @enderror" wire:model="data.name" id="name">
          @error('data.name') <div class="invalid-feedback">{{$message}}</div>@enderror
        </div>
        <div class="form-group mb-2">
          <label for="name" class="form-label">Company Name:</label>
          <input type="text" class="form-control @error('data.company_name') is-invalid @enderror" wire:model="data.company_name" id="company_name">
          @error('data.company_name') <div class="invalid-feedback">{{$message}}</div>@enderror
        </div>
        <div class="form-group mb-2">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control @error('data.email') is-invalid @enderror" wire:model="data.email" id="email">
          @error('data.email') <div class="invalid-feedback">{{$message}}</div>@enderror
        </div>
        <div class="form-group mb-2">
          <label for="phone_no" class="form-label">Phone No:</label>
          <input type="text" class="form-control @error('data.phone_no') is-invalid @enderror" wire:model="data.phone_no" id="phone_no">
          @error('data.phone_no') <div class="invalid-feedback">{{$message}}</div>@enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>