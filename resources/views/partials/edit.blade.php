@extends('partials.modals.content', [
    'modalTitle' => 'Konfirmasi Ubah',
])

@section('modal-content')
    @include('partials.form', [
        'action'   => $action,
        'method'   => 'patch',
        'gram'     => $gram,
        'disabled' => false
    ])
@endsection

@section('submit-type', 'primary')
@section('submit-label', 'Ubah')
