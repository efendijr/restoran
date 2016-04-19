
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Name</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="name" value="{{ old('name', @$makanan->nameMakanan) }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Description</label>

    <div class="col-md-8">
        <textarea type="text" class="form-control" name="description">{{ old('description', @$makanan->descriptionMakanan)}}</textarea>

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Price</label>

    <div class="col-md-8">
        <input type="number" min="0" class="form-control" name="price" value="{{ old('price', @$makanan->priceMakanan) }}">

        @if ($errors->has('price'))
            <span class="help-block">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('diskon') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Diskon</label>

    <div class="col-md-8">
        <input type="number" min="10" max="90" class="form-control" name="diskon" value="{{ old('diskon', @$makanan->diskonMakanan) }}">

        @if ($errors->has('diskon'))
            <span class="help-block">
                <strong>{{ $errors->first('diskon') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Image <br>(max: 200kb)</label>

    <div class="col-md-8">
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
          <object data="{{ old('image', @$makanan->imageMakanan) }}" type="image/jpg">
            <img src="{{ old('image', @$makanan->imageMakanan) }}" alt="Image" value="{{ old('image', @$makanan->image) }}">
          </object>
          </div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
          <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
        </div>

         @if ($errors->has('image'))
            <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
            </span>
        @endif

    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-2">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>Submit
        </button>
    </div>
</div>