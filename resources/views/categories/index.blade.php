@extends('layouts.logged')

@section('title')
    Categories
@endsection

@section('main')
    @if (count($categories) > 0)
        <ul class="categories">
            @foreach ($categories as $categorie)
                <li class="categories-{{ $categorie->id }}">{{ $categorie->name }}</li>

                <a href="{{ route('categories.edit', $categorie) }}">Edit</a>

                <form action="{{ route('categories.destroy', $categorie) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button>Delete</button>
                </form>
            @endforeach
        </ul>
    @endif

    <div>
        <a href="{{ route('categories.create') }}">Add category</a>
    </div>
@endsection