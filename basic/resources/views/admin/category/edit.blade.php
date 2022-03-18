<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            
        <div class="col-md-8">
            <div class="card">
                @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{session('success')}}
                </div>
                @endif
                <div class="card-header">Edit Category</div>
                <div class="card-body">
        <form action="{{url('category/update/'.$categories->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Update Category Name</label>
                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" value="{{$categories->category_name}}">
                @error('category_name')
                    <span class="text-danger"> {{$message}} </span>
                @enderror
            <button type="submit" class="btn">Update Category</button>
        </form>
        </div>
            </div>
        </div>
        
        </div>
        
        </div>
    </div>
</x-app-layout>
