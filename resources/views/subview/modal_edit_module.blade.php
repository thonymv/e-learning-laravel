@extends('subview.modal',['id'=>$id])
@if (isset($create))
    @section('title-modal')
        Crear módulo
        @overwrite
    @else
    @section('title-modal')
        Editar el módulo "{{ !isset($create) && isset($module) && $module ? $module->name : '' }}"
        @overwrite
    @endif

    @section('content-modal')
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-6 col-md-4 my-2">
                    <div class="thumbnail-image-edit">
                        <img id="imagePreview{{ !isset($create) && isset($module) && $module ? $module->id : '' }}"
                            src="{{ !isset($create) && isset($module) && $module ? asset('/img/' . $module->image) : asset('/img/picture.svg') }}"
                            class="img-edit">
                    </div>
                </div>
                <button class="btn btn-success rounded-circle btn-edit" type="button"
                    onclick="escogerFoto('imagen{{ !isset($create) && isset($module) && $module ? $module->id : '' }}')">
                    <i class="fas fa-pen"></i>
                </button>
            </div>
            <input type="file" onchange="imagenPrevia(this,'imagePreview{{ !isset($create) && isset($module) && $module ? $module->id : '' }}')"
                name="imagen" class="input-file" id="imagen{{ !isset($create) && isset($module) && $module ? $module->id : '' }}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control" value="{{ !isset($create) && isset($module) && $module ? $module->name : '' }}"
                    placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Nombre en inglés</label>
                <input type="text" class="form-control" value="{{ !isset($create) && isset($module) && $module ? $module->name_english : '' }}"
                    placeholder="Nombre">
            </div>
        </div>
        @overwrite

    @section('button-modal')
        <button class="btn btn-success" onclick="">Guardar</button>
        @overwrite

        <script>
            if (typeof imagenPrevia === "undefined") {

                function imagenPrevia(input, idImg) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader()
                        reader.onload = function(e) {
                            imgHtml = document.getElementById(idImg);
                            imgHtml.src = e.target.result

                        }
                        reader.readAsDataURL(input.files[0])
                    }
                }

                function escogerFoto(id) {
                    document.getElementById(id).click()
                }
            }

        </script>
