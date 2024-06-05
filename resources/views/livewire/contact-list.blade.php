<div class="container">
    <div class="row align-items-center mb-2">
        <div class="col">
            <h2 class="page-title">
            Manage Your Contacts
            </h2>
        </div>
        <div class="col-auto">
            <div class="input-group">
            <input type="search" class="form-control" placeholder="Search..." wire:model.live.throttle.100ms="search">
            <button type="button" wire:ignore.self wire:click="$dispatch('setState',{editing:false})" data-bs-toggle="modal" data-bs-target="#add-edit-modal" class="btn btn-primary btn-sm">Add New</button>
            </div>
        </div>
    </div>
    <div class="card bg-white ">
        <div class="card-body table-responsive p-1">
            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Added At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->company_name}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{$contact->phone_no}}</td>
                        <td>{{\Carbon\Carbon::parse($contact->created_at)->format("M d, Y")}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="javascript:;" wire:click="$dispatch('setState',{editing:@js($contact->id)})" class="me-1" data-bs-toggle="modal" data-bs-target="#add-edit-modal">Edit</a>
                                |
                                <a href="javascript:;" wire:confirm="Are you sure you want to delete this?" wire:click="Delete(@js($contact->id))" class="text-danger ms-1">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="100" class="text-center">No Contact Added Yet...</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if(!blank($contacts))
            <div class="text-center mx-3">
                    {{$contacts->links()}}
            </div>
            @endif
        </div>
    </div>
</div>