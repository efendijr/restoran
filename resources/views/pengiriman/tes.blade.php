<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Photo</label>

    <div class="col-md-8">
        <input type="file" class="form-control" name="photo" value="{{ old('photo', @$client->address)}}">

        @if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Photo</label>

    <div class="col-md-8">
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="{{ old('photo', @$client->photo)}}" alt="Image">
          </div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
          <div>
            <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="photo"></span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
        </div>
         @if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif

    </div>
</div>