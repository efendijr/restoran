
<div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
    <!-- <label class="col-md-2 control-label">Token</label>

    <div class="col-md-8">
        <input type="password" required minlength=15 class="form-control" name="token" value="{{ old('token', @$buydeposite->token) }}">

        @if ($errors->has('token'))
            <span class="help-block">
                <strong>{{ $errors->first('token') }}</strong>
            </span>
        @endif
    </div>
</div> -->

<div class="form-group{{ $errors->has('nominal') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Nominal</label>

    <div class="col-md-8">
        <input type="number" min="100" class="form-control" name="nominal" value="{{ old('nominal', @$buydeposite->nominal) }}">

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