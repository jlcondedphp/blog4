@extends('..layouts.app')

@section('content')
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h1 class="px-4 text-6xl break-words">List Users</h1>
        </div>
    </div>
</section>
<article class="w-full py-8">
    <div class="flex justify-center">
        <div class="max-w-7xl text-justify">@if($errors->any())
            <div class="w-full bg-red-500 p-2 text-center my-2 text-white">
                {{$errors->first()}}
            </div>
            @endif
            @if (session('status'))
                <div class="w-full bg-green-500 p-2 text-center my-2 text-white">
                    {{ session('status') }}
                </div>
            @endif
            <div class="text-right py-2">
               <a class="inline-block px-4 py-1 bg-orange-500 text-white rounded mr-2 hover:bg-orange-800" href="{{ route('users.create') }}" title="Edit">Create new User</a>
            </div>
            <table class="table-auto">
                <thead>
                    <tr>
                        
                        <th class="px-2"></th>
                        <th class="px-2">Name</th>                        
                        <th class="px-2">email</th> 
                        <th class="px-2">Role</th>                   
                        <th class="px-2">Created_at</th>   

                    </tr>
                </thead>
                <tbody>
                    
                @foreach($users as $user)
                    <tr>
                            
                    <td class="px-2">
                            <a class="inline-block px-4 py-1 bg-blue-500 text-white rounded mr-2 hover:bg-blue-800" href="{{ route('users.edit', $user) }}" title="Edit">Edit</a>

                            <a class="inline-block px-4 py-1 bg-red-500 text-white rounded mr-2 hover:bg-red-800 delete-users" href="{{ route('users.destroy', $user) }}" title="Delete" data-id="{{$user->id}}">Delete</a>
                            <form id="users.destroy-form-{{$user->id}}" action="{{ route('users.destroy', $user) }}" method="post" class="hidden">
                                {{ csrf_field() }}
                                @method('DELETE')
                            </form> 
                        </td>

                        <td class="px-2">{{ $user->name }}</td>                  
                        <td class="px-2">{{ $user->email }}</td>
                        <td class="px-2">{{ $user->role }}</td>                                                                
                        <td class="px-2">{{ $user->created_at->format('j F, Y') }}</td> 
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</article>
<script>

    var delete_users_action = document.getElementsByClassName("delete-users");

    var deleteAction = function(e) {
        event.preventDefault();
        var id = this.dataset.id;
        if(confirm('Are you sure?')) {
            document.getElementById('users.destroy-form-' + id).submit();
        }
        return false;
    }

    for (var i = 0; i < delete_users_action.length; i++) {
        delete_users_action[i].addEventListener('click', deleteAction, false);
    }
</script>
@endsection