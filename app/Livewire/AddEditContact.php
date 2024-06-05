<?php

namespace App\Livewire;

use App\Models\Contact;
use DB;
use Livewire\Component;

class AddEditContact extends Component
{
    public $editing = null, $data = [];
    protected $listeners =[
        'setState' => "setState"
    ];
    protected function rules(){
        return [
            'data.name' => 'required',
            'data.company_name' => 'required',
            'data.phone_no' => 'required',
            'data.email' => ['required','email',function($attribute, $value, $fail){
                $check_exists = DB::table('contacts')->where('added_by',auth()->user()->id)
                    ->where(DB::raw('LOWER(email)'), strtolower($value))
                    ->when($this->editing,fn ($q) => $q->where('id','!=', $this->editing))
                    ->exists();
                if ($check_exists){
                    $fail("The email already exists");
                }
            }]
        ];
    }
    protected $validationAttributes = [
        'data.name' => 'Name',
        'data.company_name' => "Company Name",
        'data.email' => "Email",
        'data.phone_no' => "Phone No"
    ];
    public function Save(){
        $validated = $this->validate();
        if ($this->editing) {
            $contact = Contact::find($this->editing);
            if (!$contact) {
                return $this->Js('alert("Contact Not found or already deleted")');
            }
            if ($contact->update($validated['data'])) {
                $this->dispatch('refresh-table');
                return $this->Js('alert("Successfully Updated")');
            }
        }else{
            $validated['data']['added_by'] = auth()->user()->id;
            $contact = Contact::create($validated['data']);
            if ($contact) {
                $this->dispatch('refresh-table');
                $this->reset('data');
                return $this->Js('alert("Successfully Added")');
            }
        }
    }
    public function setState($editing){
        if ($editing) {
            $contact = Contact::find($editing);
            if (blank($contact)) {
                return $this->Js('alert("Contact Not found")');
            }
            if (!blank($contact) and $contact->added_by != auth()->user()->id) {
                return $this->Js('alert("You cannot view other contacts")');
            }
            $this->data = $contact->toArray();
        }
        $this->editing = $editing;
    }
    public function render()
    {
        return view('livewire.add-edit-contact');
    }
}
