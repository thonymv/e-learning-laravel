<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        @if (isset($id_form))
            <form id="{{ $id_form }}" action="{{ url(isset($action)?$action:'') }}" method="POST" enctype="multipart/form-data">
                @csrf
        @endif
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @yield('title-modal')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @yield('content-modal')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="{{ isset($cancel)?$cancel:'' }}" data-dismiss="modal">Cancelar</button>
                    @yield('button-modal')
                </div>
            </div>
        @if (isset($id_form))
            </form>
        @endif
    </div>
</div>
