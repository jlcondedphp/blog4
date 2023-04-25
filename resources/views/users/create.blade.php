@extends('..layouts.app')

@section('content')
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h1 class="px-4 text-6xl break-words">Create User</h1>
        </div>
    </div>
</section>
<article class="w-full py-8">
    <div class="flex justify-center">
        <div class="max-w-7xl text-justify">
             
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <label for="name" class="w-full">Name</label>
                <input class="w-full border rounded focus:outline-none focus:shadow-outline p-2 mb-4" type="text" name="name" value="{{ old('title') }}" placeholder="Write name of user">
                <label for="email" class="w-full">Email</label>
                <input class="w-full border rounded focus:outline-none focus:shadow-outline p-2 mb-4" type="text" name="email" value="{{ old('title') }}" placeholder="Write mail of user">
                <label for="password" class="w-full">Password</label>
                <input class="w-full border rounded focus:outline-none focus:shadow-outline p-2 mb-4" type="text" name="password" value="" placeholder="Write password">
                <label for="role" class="w-full">Assign Role</label><br>

                @foreach($roles as $key=>$role)
                    <label><input type="checkbox" name="roles[]" id="{{$role->id}}" value="{{$role->id}}">{{$role->name}}</label><br>                       
                @endforeach
                
              
                <input type="submit" value="SEND" class="px-4 py-2 bg-orange-300 cursor-pointer hover:bg-orange-500 font-bold w-full border rounded border-orange-300 hover:border-orange-500 text-white">
                @if (session('status'))
                    <div class="w-full bg-green-500 p-2 text-center my-2 text-white">
                        {{ session('status') }}
                    </div>
                @endif
                @if($errors->any())
                <div class="w-full bg-red-500 p-2 text-center my-2 text-white">
                    {{$errors->first()}}
                </div>
                @endif
            </form>
        </div>
    </div>
</article>
@endsection