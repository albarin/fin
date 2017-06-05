@extends('layouts.logged')

@section('title')
    Import transactions
@endsection

@section('main')
    <div class="columns">
        <div class="column is-half">
            <form action="/upload" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <p class="field">
                    <label for="document" class="label">File</label>
                    <input type="file" name="document">
                    @if ($errors->has('document'))
                        <p class="help is-danger">{{ $errors->first('document') }}</p>
                    @endif
                </p>


                <div class="field">
                    <label for="account_id" class="label">Account</label>
                    <p class="control">
                        <span class="select {{ $errors->has('account_id') ? 'is-danger' : '' }}">
                            <select class="control" name="account_id" id="account_id">
                                <option value="">- Select account -</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </span>

                        @if ($errors->has('account_id'))
                            <p class="help is-danger">{{ $errors->first('account_id') }}</p>
                        @endif
                    </p>
                </div>

                <p class="control">
                    <button type="submit" class="button is-primary">Save</button>
                </p>
            </form>
        </div>
    </div>
@endsection