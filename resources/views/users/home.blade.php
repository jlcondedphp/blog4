@extends('..layouts.app')

@section('content')


<section class="w-full bg-gray-200 py-4 flex-row justify-center text-center">
    <h2 class="py-4 text-3xl">Usuarios</h2>   
</section>
<section class="w-full">
    <div class="flex justify-center">
        <div class="max-w-6xl text-center">
            <h2 class="py-4 text-3xl border-solid border-gray-300 border-b-2">Create User</h2>
            <div class="flex flex-wrap justify-between">
                @foreach($roles as $rol)
                <article style="width:300px" class="text-left p-2">
                    <h3 class="py-4 text-xl">{{$rol->name}}</h3>                   
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection