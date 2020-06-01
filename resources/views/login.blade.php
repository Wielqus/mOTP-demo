{{ Form::open(array('url' => '/login', 'method' => 'POST')) }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        @if($errors->any())
        <p>{{$errors->first()}}</p>
        @endif
        
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


    <button type="submit">Login</button>
{{ Form::close() }}
