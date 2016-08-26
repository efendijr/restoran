
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Nama</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="name" value="{{ old('name', @$kecamatan->kecamatanName) }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Tarif</label>

    <div class="col-md-8">
        <input type="number" min="0" class="form-control" name="tarif" value="{{ old('tarif', @$kecamatan->kecamatanTarif) }}">

        @if ($errors->has('tarif'))
            <span class="help-block">
                <strong>{{ $errors->first('tarif') }}</strong>
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