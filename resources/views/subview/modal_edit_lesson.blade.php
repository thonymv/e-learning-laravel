@extends('subview.modal',['id'=>$id])
@if (isset($create))
    @section('title-modal')
        Crear lección
        @overwrite
    @else
    @section('title-modal')
        Editar la lección "{{ !isset($create) && isset($lesson) && $lesson ? $lesson->name : '' }}"
        @overwrite
    @endif

    @section('content-modal')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre</label>
                <input type="text" class="form-control" value="{{ !isset($create) && isset($lesson) && $lesson ? $lesson->name : '' }}"
                    placeholder="Nombre">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Nombre en inglés</label>
                <input type="text" class="form-control" value="{{ !isset($create) && isset($lesson) && $lesson ? $lesson->name_english : '' }}"
                    placeholder="Nombre">
            </div>
        </div>
        @overwrite

    @section('button-modal')
        <button class="btn btn-success" onclick="">Guardar</button>
        @overwrite
