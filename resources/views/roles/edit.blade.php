@extends('..layouts.app')

@section('content')
<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h1 class="px-4 text-6xl break-words">Edit role</h1>
        </div>
    </div>
</section>
<article class="w-full py-8">
    <div class="flex justify-center">
        <div class="max-w-7xl text-justify">
            <form action="{{ route('roles.update', $role) }}" method="post">
                @csrf
                @method('PUT')
                <input class="w-full border rounded focus:outline-none focus:shadow-outline p-2 mb-4" type="text" name="name" value="{{ $role->name }}" placeholder="Write the title of the role">
                <textarea class="w-full h-72 resize-none border rounded focus:outline-none focus:shadow-outline p-2 mb-4" name="body" placeholder="Write your role here" required>{{ $role->body }}</textarea>
               
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