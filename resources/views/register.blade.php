{{ Form::open(array('url' => '/register', 'method' => 'POST')) }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        
        <label for="name" class="col-md-4 control-label">name</label>
        <div class="col-md-6">
            <input id="name" class="form-control" name="name" value="{{ old('name') }}" required>
    
        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        
        <label for="email" class="col-md-4 control-label">Email</label>
        <div class="col-md-6">
            <input id="email" class="form-control" name="email" value="{{ old('email') }}" required>
    
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        
        <label for="password" class="col-md-4 control-label">Password</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>
    
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
        
        <label for="phone_number" class="col-md-4 control-label">Phone Number</label>
        <div class="col-md-6">
            <input id="phone_number" type="tel" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required>
    
        @if ($errors->has('phone_number'))
            <span class="help-block">
                <strong>{{ $errors->first('phone_number') }}</strong>
            </span>
        @endif
        </div>
    </div>

    <button type="submit">Register</button>
{{ Form::close() }}
