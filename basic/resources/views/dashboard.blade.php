<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi.. <b>{{Auth::user()->name}}</b>
            <p>{{count($user)}}</p>
        </h2>
    </x-slot>

    <div class="py-12">
        <div >
        <table class="container">
        <thead>
            <tr>
            <th scope="col">SL No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created at</th>
            </tr>
        </thead>
        <tbody>
                
            
            @foreach ($user as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
        </table>
        </div>
    </div>
</x-app-layout>
