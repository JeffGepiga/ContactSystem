<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;
class ContactList extends Component
{
    use WithPagination;
    protected $listeners = [
        'refresh-table' => '$refresh'
    ];
    public function updatingSearch(){
        $this->resetPage();
    }
    public $search;
    public function Delete($contact_id){
        $contact = Contact::find($contact_id);
        if (!$contact) {
            return $this->Js('alert("Contact not found or already deleted")');
        }
        if ($contact->added_by != auth()->user()->id) {
            return $this->Js('alert("You cannot delete other user contact!")');
        }
        if ($contact->delete()) {
            return $this->Js('alert("Successfully Deleted")');
        }
    }
    public function render()
    {
        return view('livewire.contact-list',[
            'contacts' => Contact::where('added_by',auth()->user()->id)
            ->when($this->search,function($q){
                return $q->where(function($q){
                    $this->search = trim($this->search);
                    $search = "%{$this->search}%";
                    return $q->where('name', 'like',$search)
                    ->orWhere('company_name', 'like',$search)
                    ->orWhere('email', 'like',$search)
                    ->orWhere('phone_no', 'like',$search);
                });
            })
            ->orderBy('created_at','desc')
            ->paginate(10)
        ]);
    }
}
