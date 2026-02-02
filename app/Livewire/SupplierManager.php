<?php

namespace App\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierManager extends Component
{
    use WithPagination;

    public $name, $email, $phone, $address, $supplier_id;
    public $isEditMode = false;


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $this->supplier_id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ];
    }


    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->supplier_id = null;
        $this->isEditMode = false;
    }


    public function store()
    {
        $this->validate();

        Supplier::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Supplier Created Successfully.');
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplier_id = $id;
        $this->name = $supplier->name;
        $this->email = $supplier->email;
        $this->phone = $supplier->phone;
        $this->address = $supplier->address;
        $this->isEditMode = true;
    }


    public function update()
    {
        $this->validate();

        $supplier = Supplier::findOrFail($this->supplier_id);
        $supplier->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        session()->flash('message', 'Supplier Updated Successfully.');
        $this->resetInputFields();
    }


    public function delete($id)
    {
        Supplier::find($id)->delete();
        session()->flash('message', 'Supplier Deleted Successfully.');
    }

    public function cancel()
    {
        $this->resetInputFields();
    }

    public function render()
    {
        return view('livewire.supplier-manager', [
            'suppliers' => Supplier::latest()->paginate(10),
        ]);
    }
}
