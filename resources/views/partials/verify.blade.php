@extends('partials.modals.content', [
    'modalTitle' => 'Konfirmasi Benar',
])

@section('modal-content')
    @include('partials.form', [
        'action'   => $action,
        'method'   => 'post',
        'gram'     => $gram,
        'disabled' => true
    ])
@endsection

@section('submit-type', 'success')
@section('submit-label', 'Benar')
