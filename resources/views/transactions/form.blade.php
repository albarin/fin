{{ csrf_field() }}

<div class="field">
    <label for="name" class="label">Name</label>
    <p class="control has-icons-right">
        <input class="input" type="text" id="name" name="name" value="{{ isset($transaction) ? $transaction->name : ''}}">
    </p>
</div>

<div class="field">
    <label for="color" class="label">Description</label>
    <p class="control has-icons-right">
        <input class="input" type="text" id="description" name="description" value="{{ isset($transaction) ? $transaction->description : ''}}">
    </p>
</div>

<div class="field">
    <label for="amount" class="label">Amount</label>
    <p class="control has-icons-left">
        <input class="input" type="text" id="amount" name="amount" value="{{ isset($transaction) ? $transaction->amount : ''}}">
        <span class="icon is-small is-left">
            <i class="fa fa-eur"></i>
        </span>
    </p>
</div>

<div class="field">
    <label for="amount_id" class="label">Date</label>
    <p class="control has-icons-right">
        <input class="input" type="text" id="date" name="date" value="{{ isset($transaction) ? $transaction->date : ''}}">
    </p>
</div>

<div class="field">
    <label for="account_id" class="label">Account</label>
    <p class="control has-icons-right">
        <span class="select">
            <select class="form-control" name="account_id" id="account_id">
                <option value="">- Select account -</option>
                @foreach ($accounts as $id => $name)
                    <option value="{{ $id }}" {{ isset($transaction) && $id === $transaction->account_id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </span>
    </p>
</div>

<div class="field">
    <label for="category_id" class="label">Category</label>
    <p class="control has-icons-right">
        <span class="select">
            <select class="form-control" name="category_id" id="category_id">
                <option value="">- Select category -</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" {{ isset($transaction) && $id === $transaction->category_id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </span>
    </p>
</div>

<p class="control">
    <button type="submit" class="button is-primary">Save</button>
</p>
