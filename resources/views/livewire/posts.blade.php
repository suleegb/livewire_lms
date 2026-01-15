<div>
    <h1>LMS</h1>
   <form wire:submit.prevent="save">
    <input type="text" wire:model="title" placeholder="Title" class="px-2 py-2 font-medium w-full mt-3 mb-3 bg-gray-300">
    <textarea wire:model="description" placeholder="Containt" class="px-2 py-2 font-medium w-full mt-3 mb-3 bg-gray-300"></textarea>
    <input type="file" wire:model="image" placeholder="Image" class="px-2 py-2 font-medium w-full mt-3 mb-3 bg-gray-300">
   
    @if ($image)
    <img src="{{ $image->temporaryUrl() }}" />
    @endif
    <button class="rounded-full px-2 py-2 bg-blue-600 text-white">{{($isEdit) ? 'update' : 'Add post'}}</button> 
@error('image') <span class="error">{{ $message }}</span> @enderror
<div wire:loading> 
        Image Loading...
    </div>  
@if($isEdit)
<button wire:click="resetFields" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full">Cancel</button>
@endif
</form>
 @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
<table class="table-auto w-full mt-5">
    <thead>
       
        <tr>
            <th class="font-medium px-2 py-2">Title</th>
            <th class="font-medium px-2 py-2">Description</th>
            <th class="font-medium px-2 py-2">Image</th>
            <th class="font-medium px-2 py-2">Created At</th>
            <th class="font-medium px-2 py-2">Updated At</th>
            <th class="font-medium px-2 py-2">Action</th>
        </tr>
       
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td class="font-medium px-2 py-2">{{$post->title}}</td>
            <td class="font-medium px-2 py-2">{{$post->description}}</td>
            <td class="font-medium px-2 py-2"><img src="{{ asset('storage/photos/' . $post->image) }}" alt="Image" class="w-28 h-24 rounded-full object-cover"></td>
            <td class="font-medium px-2 py-2">{{$post->created_at}}</td>
            <td class="font-medium px-2 py-2">{{$post->updated_at}}</td>
            <td><button wire:click="edit({{$post->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Edit</button></td>
            <td><button wire:click="delete({{ $post->id }})" class="bg-red-400  hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full" onclick="confirm('Are You Sure To Delete This Reccord') || event.stopImmediatePropagation()">Delete</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
