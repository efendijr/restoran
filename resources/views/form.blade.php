
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Title</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="title" value="{{ old('title', @$tesslug->title) }}">

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Description</label>

    <div class="col-md-8">
        <textarea type="text" class="form-control" name="description">{{ old('description', @$tesslug->description)}}</textarea>

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-2">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-user"></i>Submit
        </button>
    </div>
</div>