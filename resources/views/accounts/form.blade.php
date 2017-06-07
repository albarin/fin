{{ csrf_field() }}

<div class="field">
    <label for="name">Name</label>
    <p class="control has-icons-right">
        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" id="name" name="name"
               value="{{ isset($account) ? $account->name : old('name') }}">

        @if ($errors->has('name'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
    </p>
</div>

<p class="control">
    <button type="submit" class="button is-primary">Save</button>
    <a class="button is-primary is-inverted" href="{{ route('accounts.index') }}">Cancel</a>
</p>
