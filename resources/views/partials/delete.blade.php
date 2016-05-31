@extends('partials.modals.content', [
    'modalTitle' => 'Konfirmasi Hapus',
])

@section('modal-content')
    @include('partials.form', [
        'action'   => $action,
        'method'   => 'delete',
        'gram'     => $gram,
        'disabled' => true
    ])
@endsection

@section('submit-type', 'danger')
@section('submit-label', 'Hapus')
