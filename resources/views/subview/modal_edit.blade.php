<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la sección "{{ $section->name }}"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nombre</label>
                            <input type="text" class="form-control" value={{ $section->name }} placeholder="Nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Nombre en inglés</label>
                            <input type="text" class="form-control" value={{ $section->name_english }}
                                placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Descripción</label>
                        <input type="text" class="form-control" value={{ $section->description }}
                            placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Descripción en ingles</label>
                        <input type="text" class="form-control" value={{ $section->description_english }}
                            placeholder="Apartment, studio, or floor">
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" onclick="">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
