@extends('layouts.logged')

@section('title')
    Tags
@endsection

@section('main')
    @if (count($tags) > 0)
        <ul class="tags">
            @foreach ($tags as $tag)
                <li class="tags-{{ $tag->id }}">{{ $tag->name }}</li>

                <a href="{{ route('tags.edit', $tag) }}">Edit</a>

                <form action="{{ route('tags.destroy', $tag) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button>Delete</button>
                </form>
            @endforeach
        </ul>
    @endif

    <div>
        <a href="{{ route('tags.create') }}">Add tag</a>
    </div>
@endsection