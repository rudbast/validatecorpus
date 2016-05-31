@extends('layouts.master')

@section('title', 'Index')

@section('styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@endsection

@section('header')
    @include('layouts.header')

    @include('partials.modals.container')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table id="gram-data" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Kata</th>
                        <th>Frekuensi</th>
                        <th>Terverifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" charset="utf-8">
        $('a.ngram-class').click(function (event) {
            event.preventDefault();
            // Update table's url.
            gramDatatable.ajax.url(this.href).load();
            // Update active link.
            $('.ngram-class').parent('li.active').removeClass('active');
            $(this).parent('li').addClass('active');
        });

        var gramDatatable = $('#gram-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ action('UnigramsController@index') }}',
            columns: [
                { data: 'id', name: 'id', width: '5%' },
                { data: 'word', name: 'word', width: '50%' },
                { data: 'frequency', name: 'frequency', width: '10%', class: 'text-center' },
                { data: 'verified', name: 'verified', width: '5%', class: 'text-center' },
                { data: 'action', name: 'action', orderable: false, searchable: false, width: '30%', class: 'text-center' }
            ],
        });

        gramDatatable.on('draw.dt', function () {
            setupModal();
        });

        /**
         * Setup prequisites to enable modal with AJAX.
         */
        function setupModal() {
            $.ajaxSetup({ 'cache': false });

            $('a[data-modal]').on('click', function (event) {
                $('#modal-container').load(this.href, function () {
                    $('#my-modal').modal('show');
                    bindForm(this);
                });

                return false;
            });
        }

        /**
         * Bind form to modal, handling form submit.
         */
        function bindForm(dialog) {
            var elementForm = $('form', dialog);
            var elementButtonSubmit = $('#button-submit');

            elementButtonSubmit.click(function (event) {
                elementForm.submit();
            });

            elementForm.submit(function (event) {
                event.preventDefault();

                console.log('LUL');

                $.ajax({
                    url: this.action,
                    type: this.method,
                    data: $(this).serialize(),
                })
                .done(function (response) {
                    console.log(response);
                    $('#my-modal').modal('hide');
                    gramDatatable.ajax.reload(null, false);
                });
            });
        }
    </script>
@endsection
