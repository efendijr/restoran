
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Name</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="name" value="{{ old('name', @$member->nameMember) }}" >

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
        <input type="email" class="form-control" name="email" value="{{ old('email', @$member->emailMember) }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Username</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="username" value="{{ old('username', @$member->usernameMember) }}">

        @if ($errors->has('username'))
            <span class="help-block">
                <strong>{{ $errors->first('username') }}</strong>
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

<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Address</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="address" value="{{ old('address', @$member->addressMember) }}">

        @if ($errors->has('address'))
            <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">Phone</label>

    <div class="col-md-8">
        <input type="text" class="form-control" name="phone" value="{{ old('phone', @$member->phoneMember) }}">

        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
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