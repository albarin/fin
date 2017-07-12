@extends('layouts.logged')

@section('title')
    Categories
    <a class="button is-pulled-right is-primary is-inverted" href="{{ route('categories.create') }}">Add category</a>
@endsection

@section('main')
    @include('layouts.errors')

    @if (count($categories) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td><span style="background-color: {{ $category->color }}; color: white;" class="tag">{{ $category->name }}</span></td>
                        <td>
                            <a class="button is-pulled-left is-small is-info" href="{{ route('categories.edit', $category) }}">Edit</a>

                            <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('categories.destroy', $category) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="button is-small is-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @foreach($category->children as $child)
                        <tr>
                            <td>
                                <span style="margin-left: 1.5em; background-color: {{ $child->color }}; color: white;" class="tag">{{ $child->name }}</span>
                            </td>
                            <td>
                                <a class="button is-pulled-left is-small is-info" href="{{ route('categories.edit', $child) }}">Edit</a>

                                <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('categories.destroy', $child) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button class="button is-small is-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <div class="notification">
            No categories defined
        </div>
    @endif
@endsection