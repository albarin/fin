@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!

                    <form action="/upload" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="file" name="document">

                        <button type="submit">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
