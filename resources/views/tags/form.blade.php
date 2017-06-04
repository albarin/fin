{{ csrf_field() }}

<div class="field">
    <label for="name" class="label">Name</label>
    <p class="control has-icons-right">
        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" id="name" name="name" value="{{ isset($tag) ? $tag->name : ''}}">

        @if ($errors->has('name'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <button type="submit" class="button is-primary">Save</button>
</div>


