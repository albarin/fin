{{ csrf_field() }}

<div class="field">
    <label for="name">Name</label>
    <p class="control has-icons-right">
        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" id="name" name="name" value="{{ isset($transaction) ? $transaction->name : old('name') }}">

        @if ($errors->has('name'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <label for="description">Description</label>
    <p class="control has-icons-right">
        <input class="input {{ $errors->has('description') ? 'is-danger' : '' }}" type="text" id="description" name="description" value="{{ isset($transaction) ? $transaction->description : old('description') }}">

        @if ($errors->has('description'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('description') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <label for="amount">Amount</label>
    <p class="control has-icons-left has-icons-right">
        <input class="input {{ $errors->has('amount') ? 'is-danger' : '' }}" type="text" id="amount" name="amount" value="{{ isset($transaction) ? $transaction->formatted_amount : old('amount') }}">
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
    <label for="amount_id">Date</label>
    <p class="control has-icons-left has-icons-right">
        <input class="input {{ $errors->has('date') ? 'is-danger' : '' }}" type="text" id="date" name="date" value="{{ isset($transaction) ? $transaction->date : old('date') }}">
        <span class="icon is-small is-left">
            <i class="fa fa-calendar"></i>
        </span>
        @if ($errors->has('date'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('date') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <label for="account_id">Account</label>
    <p class="control">
        <span class="select {{ $errors->has('account_id') ? 'is-danger' : '' }}">
            <select class="control" name="account_id" id="account_id">
                <option value="">- Select account -</option>
                @foreach ($accounts as $id => $name)
                    <option value="{{ $id }}" {{ isset($selectedAccountId) && $selectedAccountId == $id || (isset($transaction) && $id === $transaction->account_id) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </span>

        @if ($errors->has('account_id'))
            <p class="help is-danger">{{ $errors->first('account_id') }}</p>
        @endif
    </p>
</div>

{{--@if (!isset($transaction))--}}
    {{--<div class="field">--}}
        {{--<label for="destination_id">Transfer to</label>--}}
        {{--<p class="control">--}}
            {{--<span class="select {{ $errors->has('_id') ? 'is-danger' : '' }}">--}}
                {{--<select class="control" name="destination_id" id="destination_id">--}}
                    {{--<option value="">- Select account -</option>--}}
                    {{--@foreach ($accounts as $id => $name)--}}
                        {{--<option value="{{ $id }}">{{ $name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</span>--}}

            {{--@if ($errors->has('destination_id'))--}}
                {{--<p class="help is-danger">{{ $errors->first('destination_id') }}</p>--}}
            {{--@endif--}}
        {{--</p>--}}
    {{--</div>--}}
{{--@endif--}}

<div class="field" style="margin-left: 20px;">
    <div class="control">
        <label class="checkbox">
            <input type="checkbox" name="ignore" value="1" {{ isset($transaction) && $transaction->ignore ? 'checked' : '' }}>
            Ignore on balance
        </label>
    </div>
</div>

<div class="field">
    <label for="category_id">Category</label>
    <p class="control">
        <span class="select {{ $errors->has('category_id') ? 'is-danger' : '' }}">
            <select class="control" name="category_id" id="category_id">
                <option value="">- Select category -</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($transaction) && $category->id === $transaction->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @foreach ($category->children as $child)
                        <option value="{{ $child->id }}" {{ isset($transaction) && $child->id === $transaction->category_id ? 'selected' : '' }}> -- {{ $child->name }}</option>
                    @endforeach
                @endforeach
            </select>
        </span>

        @if ($errors->has('category_id'))
            <p class="help is-danger">{{ $errors->first('category_id') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <label for="tag_ids">Tag</label>
    <p class="control">
        <span class="select is-multiple {{ $errors->has('tag_ids') ? 'is-danger' : '' }}">
            <select class="control" name="tag_ids[]" id="tag_ids" multiple size="5">
                <option value="">- Select tag -</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ isset($transaction) && in_array($tag->id, $transaction->tags()->pluck('tag_id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </span>

    @if ($errors->has('tag_id'))
        <p class="help is-danger">{{ $errors->first('tag_id') }}</p>
    @endif
    </p>
</div>

<p class="control">
    <button type="submit" class="button is-primary">Save</button>
</p>

<script>
    $(document).ready(function () {
        $('input[name=date]').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            },
        });
    });
</script>