<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Mail\Message;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Formulario extends Component
{

    public $categories, $tags;

    /*  public $category_id = '';
   // #[Rule("required",message:"El campo titulo es necesario")]
    public $title;
    public $content;

    public $tags = []; */

    public $posts;
//validacion Global
    #[Rule(
        [
            'postCreate.title' => 'required',
            'postCreate.content' => 'required',
            'postCreate.category_id' => 'required|exists:categories,id',
            'postCreate.tags' => 'required|array'
        ],


        [
            'postCreate.title' => 'Titulo',
            'postCreate.content' => 'Contenido',
            'postCreate.category_id' => 'Categorias',
            'postCreate.tags' => 'Etiquetas',
        ]
    )]

    public $postCreate = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => []
    ];

    public $postEdit = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => []
    ];

    public $postEditId = '';

    public $open = false;

    public function mount()
    {

        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }

    public function save()
    {

        $this->validate(

        );


        $post = Post::create([
            'category_id' => $this->postCreate['category_id'],
            'title' => $this->postCreate['title'],
            'content' => $this->postCreate['content']
        ]);

        $post->tags()->attach($this->postCreate['tags']);
        $this->reset(['postCreate']);
        $this->posts = Post::all();

        $this->dispatch("post-created","Nuevo articulo creado");
    }


    public function edit($postId)
    {
        $this->resetValidation();
        $this->open = true;
        $this->postEditId = $postId;

        $post = Post::find($postId);

        $this->postEdit["category_id"] = $post->category_id;
        $this->postEdit["title"] = $post->title;
        $this->postEdit["content"] = $post->content;
        $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
    }


    public function update()
    {
        //validacion personalizada
        $this->validate(
            [
                'postEdit.title' => 'required ',
                'postEdit.content' => 'required',
                'postEdit.category_id' => 'required|exists:categories,id',
                'postEdit.tags' => 'required|array'
            ],

            [
                'postEdit.title.required' => 'El campo titulo es requerido ',
            ],

            ['postEdit.title' => 'Titulo',]
        );

        $post = Post::find($this->postEditId);

        $post->update([
            'category_id' => $this->postEdit["category_id"],
            'title' => $this->postEdit["title"],
            'content' => $this->postEdit["content"]

        ]);
        $post->tags()->sync($this->postEdit["tags"]);
        $this->reset(["postEditId", "postEdit", "open"]);
        $this->posts = Post::all();
        $this->dispatch("post-created","Articulo actualizado");
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        $this->posts = Post::all();
        $this->dispatch("post-created","Articulo Eliminado");
    }
    public function render()
    {
        return view('livewire.formulario');
    }
}
