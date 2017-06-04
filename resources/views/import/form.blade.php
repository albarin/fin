@extends('layouts.logged')

@section('title')
    Import transactions
@endsection

@section('main')
    <form action="/upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <p class="field">
            <input type="file" name="document">
        </p>

        <p class="control">
            <button type="submit" class="button is-primary">Save</button>
        </p>
    </form>
@endsection