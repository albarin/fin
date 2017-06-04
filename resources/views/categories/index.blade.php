@extends('layouts.logged')

@section('title')
    Categories
    <a class="button is-pulled-right is-primary is-inverted" href="{{ route('categories.create') }}">Add category</a>
@endsection

@section('main')
    @if (session('error'))
        <div class="notification is-warning">
            {{ session('error') }}
        </div>
    @endif

    @if (count($categories) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Color</th>
                <th>Parent category</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td><strong>{{ $category->name }}</strong></td>
                        <td>#   {{ $category->color }}</td>
                        <td>
                            {{ $category->category ? $category->category->name : '-'}}
                        </td>
                        <td>
                            <a class="button is-pulled-left is-small is-info" href="{{ route('categories.edit', $category) }}">Edit</a>

                            <form style="margin-left: 10px;" class="is-pulled-left" action="{{ route('categories.destroy', $category) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button class="button is-small is-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection