@extends('subview.modal',['id'=>$id])
@if (isset($create))
    @section('title-modal')
        Crear nodo tipo "Selección"
        @overwrite
    @else
    @section('title-modal')
        Editar el nodo "{{ !isset($create) && isset($node) && $node ? $node->name : '' }}" tipo "Selección"
        @overwrite
    @endif

    @section('content-modal')
        <div class="form-group">
            <label for="inputAddress">Pregunta</label>
            <textarea class="form-control" rows="2"
                placeholder="Ingrese pregunta">{{ !isset($create) && isset($node) && $node ? $node->content : '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress">Pregunta en ingles</label>
            <textarea class="form-control" rows="2"
                placeholder="Ingrese pregunta">{{ !isset($create) && isset($node) && $node ? $node->content_english : '' }}</textarea>
        </div>
        @overwrite

    @section('button-modal')
        <button class="btn btn-success" onclick="">Guardar</button>
        @overwrite
