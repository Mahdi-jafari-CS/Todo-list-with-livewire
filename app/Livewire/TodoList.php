<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3' , message: 'Please fill the name field')]
    public $name;
    public $search;
    public function create(){
        //validate
        $validated = $this->validateOnly('name');
        //create the todo
        Todo::create($validated);
        //clear
        $this->reset('name');

        //flash massege
        session()->flash('message', 'Todo Created Successfully');

    }

    public function delete(Todo $todo){
        $todo->delete();

    }
    public function toggle(Todo $todo){
        // $todo->update([
        //     'completed' => !$todo->completed
        // ]);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function render()
    {
        return view('livewire.todo-list' ,[ 'todos' => Todo::latest()
        ->where('name', 'like', '%'.$this->search.'%')
        ->paginate(4)]);
    }
}
