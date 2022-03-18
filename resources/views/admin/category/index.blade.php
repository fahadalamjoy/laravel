<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Category
                    </div>
                
        <table class="container">
        <thead>
            <tr>
            <th scope="col">SL No</th>
            <th scope="col">Category Name</th>
            <th scope="col">User Name</th>
            <th scope="col">Created at</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
                
            @foreach ($category as $cate)
                
            
            <tr>
                <th scope="row">{{$cate->id}}</th>
                <td>{{$cate->category_name}}</td>
                <td>{{$cate->user->name}}</td>
                <td>{{$cate->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{url('category/edit/'.$cate->id)}}" class="btn btn-info">Edit</a>
                    <a href="{{url('category/softdelete/'.$cate->id)}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
        {{ $category->links() }}
        </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{session('success')}}
                </div>
                @endif
                <div class="card-header">Add Category</div>
                <div class="card-body">
        <form action="{{route('store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" >
                @error('category_name')
                    <span class="text-danger"> {{$message}} </span>
                @enderror
            <button type="submit" class="btn">Add Category</button>
        </form>
        </div>
            </div>
        </div>
        
        </div>
        
        </div>

        {{-- //Trash Category --}}

        <div class="container">
            <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Trash Category
                    </div>
                
        <table class="container">
        <thead>
            <tr>
            <th scope="col">SL No</th>
            <th scope="col">Category Name</th>
            <th scope="col">User Name</th>
            <th scope="col">Created at</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
                @if (session('soft'))
                <div class="alert alert-primary" role="alert">
                    {{session('soft')}}
                </div>
                @endif
            @foreach ($trashCat as $cate)
                
            
            <tr>
                <th scope="row">{{$cate->id}}</th>
                <td>{{$cate->category_name}}</td>
                <td>{{$cate->user->name}}</td>
                <td>{{$cate->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{url('category/restore/'.$cate->id)}}" class="btn btn-info">Restore</a>
                    <a href="{{url('category/pdelete/'.$cate->id)}}" class="btn btn-danger">P Delete</a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
        {{ $trashCat->links() }}
        </table>
            </div>
        </div>
        <div class="col-md-4">
            
        
        </div>
        
        </div>
    </div>
</x-app-layout>
