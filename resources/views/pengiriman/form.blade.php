
<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Status</label>

    <div class="col-md-8">
        
        <select class="selectpicker form-control" name="status">

            <option value="{{ old('statusDelivery', @$pengiriman->statusDelivery) }}">{{ old('statusDelivery', @$pengiriman->statusDelivery) }}</option>
            
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