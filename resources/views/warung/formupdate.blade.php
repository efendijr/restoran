 
 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Name</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="name" value="{{ old('name', @$user->name) }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">E-Mail Address</label>

    <div class="col-md-8">
        <input type="email" class="form-control" name="email" value="{{ old('email', @$user->email) }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Password</label>

    <div class="col-md-8">
        <input type="password" class="form-control" name="password">

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Confirm Password</label>

    <div class="col-md-8">
        <input type="password" class="form-control" name="password_confirmation">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Description</label>

    <div class="col-md-8">
        <textarea type="text" class="form-control" name="description">{{ old('description', @$user->description)}}</textarea>

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Address </label>

    <div class="col-md-8">
        <textarea type="text" class="form-control" name="address">{{ old('address', @$user->address)}}</textarea>

        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Alias</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="alias" value="{{ old('alias', @$user->alias) }}">

        @if ($errors->has('alias'))
            <span class="help-block">
                <strong>{{ $errors->first('alias') }}</strong>
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