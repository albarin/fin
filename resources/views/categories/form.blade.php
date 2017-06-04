{{ csrf_field() }}

<div class="field">
    <label for="name" class="label">Name</label>
    <p class="control has-icons-right">
        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" id="name" name="name" value="{{ isset($category) ? $category->name : ''}}">

        @if ($errors->has('name'))
            <span class="icon is-small is-right">
                    <i class="fa fa-warning"></i>
                </span>
            <p class="help is-danger">{{ $errors->first('name') }}</p>
        @endif
    </p>
</div>

<div class="field">
    <label for="color" class="label">Color</label>
    <p class="control has-icons-right">
        <input class="input {{ $errors->has('color') ? 'is-danger' : '' }}" type="text" id="color" name="color" value="{{ isset($category) ? $category->color : ''}}">

        @if ($errors->has('color'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('color') }}</p>
         @endif
    </p>
</div>

<div class="field">
    <label for="category_id" class="label">Parent category</label>
    <p class="control has-icons-right">
        <span class="select">
            <select class="input" name="category_id" id="category_id">
                <option value="">- Select category -</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" {{ isset($category) && $id === $category->category_id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </span>
    </p>
</div>

<p class="control">
    <button type="submit" class="button is-primary">Save</button>
</p>
