<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class Posts extends Component
{
    use WithFileUploads;
    #[Validate('image|max:1024')]


    public $title, $description, $image, $old_image, $post_id;
    public $isEdit;



    public function save()
    {
        $validate =  $this->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|max:1024|nullable'

        ]);
        if ($this->isEdit) {
            if ($this->image) {
                $filename = time() . '-' . $this->image->getClientOriginalName();
                $this->image->storeAs('photos', $filename, 'public');
                $validate['image'] = $filename;
            } else {

                $validate['image'] = $this->old_image;
            }

            Post::findOrFail($this->post_id)->update($validate);
        } else {
            $filename = time() . '-' . $this->image->getClientOriginalName();
            $this->image->storeAs('photos', $filename, 'public');
            $validate['image'] = $filename;
            Post::create($validate);
        }
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->title = '';
        $this->description = '';
        $this->isEdit = false;
        $this->image = '';
    }

    public function render()
    {
        $posts = Post::all();
        return view('livewire.posts', compact('posts'));
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->old_image = $post->image;

        if ($this->image) {
            Storage::disk('public')->delete($this->image);
        }

        $this->isEdit = true;
    }


    public function delete($id)
    {
        $imagedelte = Post::findOrFail($id);
        $image_path = public_path('storage/photos/' . $imagedelte->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        // FIX: Remove the semicolon after the if statement
        /* if (Storage::disk('public')->exists($imagedelte->image)) {
            Storage::disk('public')->delete($imagedelte->image);
        } */

        $imagedelte->delete();
        session()->flash('message', 'Image and Record Deleted Successfully');
    }
}
