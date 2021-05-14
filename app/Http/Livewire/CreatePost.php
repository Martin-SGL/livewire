<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;
    public $title, $content, $image, $identificador;

    protected $rules = [
        'title'=>'required',
        'content'=>'required',
        'image'=>'required|image|max:2048',
    ];

    public function mount(){
        $this->identificador = rand();
    }

    //validación en tiempo real quitar el defer del wiremodel
    /*public function updated($propertyName){
        $this->validateOnly($propertyName);
    }*/

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        $this->validate();

        $image = $this->image->store('posts');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);

        $this->reset(['open','title','content','image']);
        $this->emitTo('show-posts','render');
        $this->identificador = rand();
        $this->emit('alert','El se creó satisfactoriamente');
       
    }
}
