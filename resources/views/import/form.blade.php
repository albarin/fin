@extends('layouts.logged')

@section('title')
    Import transactions
@endsection

@section('main')
    <form action="/upload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="file" name="document">

        <button type="submit">Upload</button>
    </form>
@endsection