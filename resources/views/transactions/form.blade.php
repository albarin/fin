{{ csrf_field() }}

<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" id="name" name="name" value="{{ isset($transaction) ? $transaction->name : ''}}">
    </div>
</div>

<div class="form-group">
    <label for="color" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" id="description" name="description" value="{{ isset($transaction) ? $transaction->description : ''}}">
    </div>
</div>

<div class="form-group">
    <label for="amount" class="col-sm-2 control-label">Amount</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" id="amount" name="amount" value="{{ isset($transaction) ? $transaction->amount : ''}}">
    </div>
</div>

<div class="form-group">
    <label for="amount_id" class="col-sm-2 control-label">Date</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" id="date" name="date" value="{{ isset($transaction) ? $transaction->date : ''}}">
    </div>
</div>

<div class="form-group">
    <label for="account_id" class="col-sm-2 control-label">Account</label>
    <div class="col-sm-4">
        <select class="form-control" name="account_id" id="account_id">
            <option value="">- Select account -</option>
            @foreach ($accounts as $id => $name)
                <option value="{{ $id }}" {{ isset($transaction) && $id === $transaction->account_id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label for="category_id" class="col-sm-2 control-label">Category</label>
    <div class="col-sm-4">
        <select class="form-control" name="category_id" id="category_id">
            <option value="">- Select category -</option>
            @foreach ($categories as $id => $name)
                <option value="{{ $id }}" {{ isset($transaction) && $id === $transaction->category_id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</div>


