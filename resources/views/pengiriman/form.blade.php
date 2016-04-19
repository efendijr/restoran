
<div class="form-group{{ $errors->has('payment_id') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Payment Id</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="payment_id" value="{{ old('payment_id', @$pengiriman->payment_id) }}">

        @if ($errors->has('payment_id'))
            <span class="help-block">
                <strong>{{ $errors->first('payment_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('member_id') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Id Member</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="member_id" value="{{ old('member_id', @$pengiriman->member_id) }}">

        @if ($errors->has('member_id'))
            <span class="help-block">
                <strong>{{ $errors->first('member_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Alamat</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="alamat" value="{{ old('alamat', @$pengiriman->alamat) }}">

        @if ($errors->has('alamat'))
            <span class="help-block">
                <strong>{{ $errors->first('alamat') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Status</label>

    <div class="col-md-8">
        
        <select class="selectpicker form-control" name="status">

            <option value="{{ old('status', @$pengiriman->status) }}">{{ old('status', @$pengiriman->status) }}</option>
            
                @foreach($gettags as $tegs)
                <option value="{{ $tegs->tags }}">{{ $tegs->tags }}</option>
                @endforeach
                
      </select>

        @if ($errors->has('status'))
            <span class="help-block">
                <strong>{{ $errors->first('status') }}</strong>
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