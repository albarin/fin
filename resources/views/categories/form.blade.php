{{ csrf_field() }}

<div class="field">
    <label for="name">Name</label>
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
    <label for="color">Color</label>
    <p class="control has-icons-right">
        <input class="input jscolor {hash:true} {{ $errors->has('color') ? 'is-danger' : '' }}" type="text" id="color" name="color" value="{{ isset($category) ? $category->color : ''}}">

        @if ($errors->has('color'))
            <span class="icon is-small is-right">
                <i class="fa fa-warning"></i>
            </span>
            <p class="help is-danger">{{ $errors->first('color') }}</p>
         @endif
    </p>
</div>

<div class="field">
    <label for="category_id">Parent category</label>
    <p class="control has-icons-right">
        <span class="select {{ $errors->has('category_id') ? 'is-danger' : '' }}">
            <select class="control" name="category_id" id="category_id">
                <option value="">- Select category -</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ isset($category) && $category->category_id === $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
    <a class="button is-primary is-inverted" href="{{ route('categories.index') }}">Cancel</a>
</p>
