@extends('..layouts.app')

@section('content')
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h1 class="px-4 text-6xl break-words">List roles</h1>
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
                <a class="inline-block px-4 py-1 bg-orange-500 text-white rounded mr-2 hover:bg-orange-800" href="{{ route('roles.create') }}" title="Create">Create new roles</a> 
            </div>
            <table class="table-auto">
                <thead>
                    <tr>
                        <th class="px-2"></th>
                        <th class="px-2">Name</th>
                        <th class="px-2">Description</th>
                        <th class="px-2">Create</th>                        
                    </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)                
                    <tr>
                            
                    <td class="px-2">
                            <a class="inline-block px-4 py-1 bg-blue-500 text-white rounded mr-2 hover:bg-blue-800" href="{{ route('roles.edit', $role) }}" title="Edit">Edit</a>

                            <a class="inline-block px-4 py-1 bg-red-500 text-white rounded mr-2 hover:bg-red-800 delete-roles" href="{{ route('roles.destroy', $role) }}" title="Delete" data-id="{{$role->id}}">Delete</a>
                            <form id="roles.destroy-form-{{$role->id}}" action="{{ route('roles.destroy', $role) }}" method="post" class="hidden">
                                {{ csrf_field() }}
                                @method('DELETE')  
                            </form> 
                        </td>

                        <td class="px-2">{{ $role->name }}</td>                       
                        <td class="px-2">{{ $role->description }}</td>
                        <td class="px-2">{{ $role->created_at->format('j F, Y') }}</td>                       
                         
                    
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</article>
<script>

    var delete_roles_action = document.getElementsByClassName("delete-roles");

    var deleteAction = function(e) {        
        event.preventDefault();
        var id = this.dataset.id;
        if(confirm('Are you sure?')) {
            document.getElementById('roles.destroy-form-' + id).submit();
        }
        return false;
    }

    for (var i = 0; i < delete_roles_action.length; i++) {
        delete_roles_action[i].addEventListener('click', deleteAction, false);
    }
</script>
@endsection