{{ csrf_field() }}

<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-4">
        <input class="form-control" type="text" id="name" name="name" value="{{ isset($tag) ? $tag->name : ''}}">
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</div>


