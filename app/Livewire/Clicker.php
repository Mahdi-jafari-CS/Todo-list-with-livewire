<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Clicker extends Component
{
    use WithPagination;
    #[Rule(['required', 'string'])]
    public $name ='';
    #[Rule(['required', 'email' , 'unique:users,email'])]
    public $email ='';
    #[Rule (['required', 'min:6'])]
    public $password ='';

    public function createNewUser(){

        $validated = $this->validate();
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'], )
        ]);

        $this->reset(['name' , 'email' , 'password']);

    session()->flash('message' , 'User Created Successfully');
    }




    public function render()
    {

        $user = User::paginate(5);
        return view('livewire.clicker' , ['users' => $user]);
    }

}
