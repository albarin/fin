{{ csrf_field() }}

<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" id="name" name="name" value="{{ isset($category) ? $category->name : ''}}">
    </div>
</div>

<div class="form-group">
    <label for="color" class="col-sm-2 control-label">Color</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" id="color" name="color" value="{{ isset($category) ? $category->color : ''}}">
    </div>
</div>

<div class="form-group">
    <label for="category_id" class="col-sm-2 control-label">Parent category</label>
    <div class="col-sm-4">
        <select class="form-control" name="category_id" id="category_id">
            <option value="">- Select category -</option>
            @foreach ($categories as $id => $name)
                <option value="{{ $id }}" {{ isset($category) && $id === $category->category_id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</div>


