<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                @if ($status)
                    <h5 class="modal-title">Desactivar la sección "{{$name}}"</h5>
                @else
                    <h5 class="modal-title">Activar la sección "{{$name}}"</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($status)
                    <p>
                        ¿Seguro que desea desactivar la sección "{{$name}}"?
                    </p>
                @else
                    <p>
                        ¿Seguro que desea activar la sección "{{$name}}"?
                    </p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                @if ($status)
                <a type="button" class="btn btn-danger" href="{{url($url)}}">Desactivar</a>
                @else
                <a type="button" class="btn btn-success" href="{{url($url)}}">Activar</a>
                @endif
            </div>
        </div>
    </div>
</div>