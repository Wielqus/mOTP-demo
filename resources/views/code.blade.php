{{ Form::open(array('url' => '/code', 'method' => 'POST')) }}

    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
        @if($errors->any())
        <p>{{$errors->first()}}</p>
        @endif
        
        <label for="code" class="col-md-4 control-label">code</label>
        <div class="col-md-6">
            <input id="code" class="form-control" name="code" value="{{ old('code') }}" required>
    
        @if ($errors->has('code'))
            <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
            </span>
        @endif
        </div>
    </div>

    <button type="submit">Activate</button>
{{ Form::close() }}
