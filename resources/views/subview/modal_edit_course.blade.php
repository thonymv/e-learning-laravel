@extends('subview.modal',['id'=>$id])
@if (isset($create))
    @section('title-modal')
        Crear curso
        @overwrite
    @else
    @section('title-modal')
        Editar el curso "{{ !isset($create) && isset($course) && $course ? $course->name : '' }}"
        @overwrite
    @endif

    @section('content-modal')
        <div class="form-group">
            <div class="row justify-content-center">
                <div class="col-6 col-md-4 my-2">
                    <img id="imagePreview{{ !isset($create) && isset($course) && $course ? $course->id : '' }}"
                        src="{{ !isset($create) && isset($course) && $course ? asset('/img/' . $course->image) : asset('/img/picture.png') }}"
                        class="img-thumbnail rounded-circle img-edit">

                </div>
                <button class="btn btn-success rounded-circle btn-edit" type="button"
                    onclick="escogerFoto('imagen{{ !isset($create) && isset($course) && $course ? $course->id : '' }}')">
                    <i class="fas fa-pen"></i>
                </button>
            </div>
            <input type="file"
                onchange="imagenPrevia(this,'imagePreview{{ !isset($create) && isset($course) && $course ? $course->id : '' }}')"
                name="imagen" class="input-file"
                id="imagen{{ !isset($create) && isset($course) && $course ? $course->id : '' }}">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control"
                    value="{{ !isset($create) && isset($course) && $course ? $course->name : '' }}" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Nombre en inglés</label>
                <input type="text" class="form-control"
                    value="{{ !isset($create) && isset($course) && $course ? $course->name_english : '' }}"
                    placeholder="Nombre">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Descripción</label>
            <textarea class="form-control" rows="4"
                placeholder="Ingrese descripción">{{ !isset($create) && isset($course) && $course ? $course->description : '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Descripción en ingles</label>
            <textarea class="form-control" rows="4"
                placeholder="Ingrese descripción en inglés">{{ !isset($create) && isset($course) && $course ? $course->description_english : '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Precio</label>
            <input type="number" class="form-control"
                value="{{ !isset($create) && isset($course) && $course ? $course->price : '' }}"
                placeholder="Apartment, studio, or floor">
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
