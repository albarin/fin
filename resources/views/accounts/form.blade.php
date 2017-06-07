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

<div class="field">
    <label for="initial_balance">Initial balance</label>
    <p class="control has-icons-left has-icons-right">
        <input class="input {{ $errors->has('initial_balance') ? 'is-danger' : '' }}" type="text" id="initial_balance" name="initial_balance"
               value="{{ isset($account) ? $account->formatted_balance : old('initial_balance') }}">
        <span class="icon is-small is-left">
            <i class="fa fa-eur"></i>
        </span>

        @if ($errors->has('initial_balance'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('initial_balance') }}</p>
        @endif
    </p>
</div>

<p class="control">
    <button type="submit" class="button is-primary">Save</button>
    <a class="button is-primary is-inverted" href="{{ route('accounts.index') }}">Cancel</a>
</p>
