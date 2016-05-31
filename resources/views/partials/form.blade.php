{!! Form::open([ 'url' => $action, 'method' => $method ]) !!}
    <div class="form-group">
        {!! Form::label('word', 'Kata') !!}
        {!! Form::text('word', $gram->word, [
            'class' => 'form-control',
            $disabled ? 'disabled' : ''
        ]) !!}
    </div>
{!! Form::close() !!}
