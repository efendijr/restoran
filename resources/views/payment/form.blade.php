
<div class="form-group{{ $errors->has('makanan_id') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Id Makanan</label>

    <div class="col-md-8">
        <input type="number" class="form-control" name="makanan_id" value="{{ old('makanan_id', @$payment->makanan_id) }}">

        @if ($errors->has('makanan_id'))
            <span class="help-block">
                <strong>{{ $errors->first('makanan_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('memberName') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Id Member</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="memberName" value="{{ old('memberName', @$payment->memberName) }}">

        @if ($errors->has('memberName'))
            <span class="help-block">
                <strong>{{ $errors->first('memberName') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('nominal') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Nominal</label>

    <div class="col-md-8">
        <input type="number" class="form-control" name="nominal" value="{{ old('nominal', @$payment->nominal) }}">

        @if ($errors->has('nominal'))
            <span class="help-block">
                <strong>{{ $errors->first('nominal') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-2">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>Save
        </button>
    </div>
</div>