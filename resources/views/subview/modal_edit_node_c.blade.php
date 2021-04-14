@extends('subview.modal',[
    'id'=>$id,
    'id_form'=>"form_$id",
    'action'=>$url
])
@if (isset($create))
    @section('title-modal')
        Crear nodo tipo "Contenido"
        @overwrite
    @else
    @section('title-modal')
        Editar el nodo "{{ !isset($create) && isset($node) && $node ? $node->name : '' }}"
        @overwrite
    @endif

    @section('content-modal')
    <input type="hidden" name="lesson_id" value="{{ isset($lesson->id)?$lesson->id:$node->lesson_id }}">
    <input type="hidden" name="type_id" value="1">
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-6 col-md-4 my-2">
                    <div class="thumbnail-image-edit">
                        <img id="imagePreview{{ !isset($create) && isset($node) && $node ? $node->id : '' }}"
                            src="{{ !isset($create) && isset($node) && $node ? asset("/img/$node->image") : asset('/img/picture.svg') }}"
                            class="img-edit">
                    </div>
                </div>
                <button class="btn btn-success rounded-circle btn-edit" type="button"
                    onclick="escogerFoto('imagen{{ !isset($create) && isset($node) && $node ? $node->id : '' }}')">
                    <i class="fas fa-pen"></i>
                </button>
            </div>
            <input required type="file" onchange="imagenPrevia(this,'imagePreview{{ !isset($create) && isset($node) && $node ? $node->id : '' }}')"
                name="image" class="input-file" id="imagen{{ !isset($create) && isset($node) && $node ? $node->id : '' }}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Título</label>
                <input required name="title" type="text" class="form-control" value="{{ !isset($create) && isset($node) && $node ? $node->title : '' }}"
                    placeholder="Ingrese el título">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Título en inglés</label>
                <input required name="title_english" type="text" class="form-control" value="{{ !isset($create) && isset($node) && $node ? $node->title_english : '' }}"
                    placeholder="Ingrese el título">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Contenido</label>
            <textarea required class="form-control" rows="4" name="content"
                placeholder="Ingrese el contenido">{{ !isset($create) && isset($node) && $node ? $node->content : '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress">Contenido en ingles</label>
            <textarea required class="form-control" rows="4" name="content_english"
                placeholder="Ingrese el contenido">{{ !isset($create) && isset($node) && $node ? $node->content_english : '' }}</textarea>
        </div>
        @overwrite

    @section('button-modal')
        <input class="btn btn-success" type="submit" value="Guardar">
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
