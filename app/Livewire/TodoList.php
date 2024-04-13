<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3' , message: 'Please fill the name field')]
    public $name;
    public $search;
    public $todoId;
    #[Rule('required|min:3' , message: 'Please fill the name field')]
    public $newName;

    public function create(){
        //validate
        $validated = $this->validateOnly('name');
        //create the todo
        Todo::create($validated);
        //clear
        $this->reset('name');

        //flash massege
        session()->flash('message', 'Todo Created Successfully');
        $this->resetPage();

    }

    public function delete($todoId){
        try{
            // $todo->delete();
            Todo::findOrFail($todoId)->delete();
            session()->flash('message', 'Todo Deleted Successfully');
        }catch(Exception $e){
            session()->flash('error', 'Failed to delete todo');
        }




    }
    public function toggle(Todo $todo){
        // $todo->update([
        //     'completed' => !$todo->completed
        // ]);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
    public function edit($todoId){
        $this->todoId = $todoId;
        $this->newName = Todo::find($todoId)->name;
    }
    public function cancelEdit(){
        $this->reset('todoId' , 'newName');
    }
    public function update(){
        $this->validateOnly('newName');
        Todo::find($this->todoId)->update([
            'name' => $this->newName
        ]);
        $this->cancelEdit();


    }
    public function render()
    {
        return view('livewire.todo-list' ,[ 'todos' => Todo::latest()
        ->where('name', 'like', '%'.$this->search.'%')
        ->paginate(4)]);
    }
}
