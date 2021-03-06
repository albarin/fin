{{ csrf_field() }}

<div class="field">
    <label for="name">Name</label>
    <p class="control has-icons-right">
        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" id="name" name="name" value="{{ isset($budget) ? $budget->name : old('color') }}">

        @if ($errors->has('name'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <label for="amount">Amount</label>
    <p class="control has-icons-left has-icons-right">
        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" id="amount" name="amount" value="{{ isset($budget) ? $budget->amount : old('color') }}">
        <span class="icon is-small is-left">
            <i class="fa fa-eur"></i>
        </span>

        @if ($errors->has('amount'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('amount') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <label for="category_id">Category</label>
    <p class="control">
        <span class="select {{ $errors->has('category_id') ? 'is-danger' : '' }}">
            <select class="control" name="category_id" id="category_id">
                <option value="">- Select category -</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($budget) && $category->id === $budget->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @if (!$category->children->isEmpty())
                        @foreach ($category->children as $child)
                            <option value="{{ $child->id }}" {{ isset($budget) && $budget->category_id === $child->id ? 'selected' : '' }}>-- {{ $child->name }}</option>
                        @endforeach
                    @endif
                @endforeach
            </select>
        </span>

        @if ($errors->has('category_id'))
            <p class="help is-danger">{{ $errors->first('category_id') }}</p>
        @endif
    </p>
</div>

<p class="control">
    <button type="submit" class="button is-primary">Save</button>
    <a class="button is-primary is-inverted" href="{{ route('budgets.index') }}">Cancel</a>
</p>
