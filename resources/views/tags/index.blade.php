@extends('layouts.logged')

@section('title')
    Tags
    <a class="button is-pulled-right is-primary is-inverted" href="{{ route('tags.create') }}">
        Add tag
    </a>
@endsection

@section('main')
    @if (session('flash_type'))
        <div class="alert notification is-{{session('flash_type')}}">
            {{ session('flash_message') }}
        </div>
    @endif

    @if ($tags->isNotEmpty())
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td><strong>{{ $tag->name }}</strong></td>
                        <td>
                            <a class="button is-pulled-left is-small is-info" href="{{ route('tags.edit', $tag) }}">Edit</a>

                            <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('tags.destroy', $tag) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="button is-small is-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="notification">
            No tags defined
        </div>
    @endif
@endsection