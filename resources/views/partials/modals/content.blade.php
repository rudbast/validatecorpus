<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
                <i class="fa fa-times"></i>
            </span>
        </button>
        <h4 class="modal-title" id="modal-label">{{ $modalTitle }}</h4>
    </div><!-- /.modal-header -->

    <div class="modal-body">
        @yield('modal-content')
    </div><!-- /.modal-body -->

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button id="button-submit" type="button" class="btn btn-@yield('submit-type')">@yield('submit-label')</button>
    </div>
</div><!-- /.modal-content -->
