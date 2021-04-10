@extends('subview.modal',['id'=>$id])
@if (isset($create))
    @section('title-modal')
        Crear sección
        @overwrite
@else
    @section('title-modal')
        Editar la sección "{{ !isset($create) && isset($section) && $section ? $section->name : '' }}"
        @overwrite
@endif

    @section('content-modal')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control" value="{{ !isset($create) && isset($section) && $section ? $section->name : '' }}" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Nombre en inglés</label>
                <input type="text" class="form-control" value="{{ !isset($create) && isset($section) && $section ? $section->name_english : '' }}"
                    placeholder="Nombre">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Descripción</label>
            <textarea class="form-control" rows="4"
                placeholder="Ingrese descripción">{{ !isset($create) && isset($section) && $section ? $section->description : '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress2">Descripción en ingles</label>
            <textarea class="form-control" rows="4"
                placeholder="Ingrese descripción en inglés">{{ !isset($create) && isset($section) && $section ? $section->description_english : '' }}</textarea>
        </div>
        @overwrite

    @section('button-modal')
        <button class="btn btn-success" onclick="">Guardar</button>
        @overwrite
