@extends('subview.modal',[
'id'=>$id,
'id_form'=>"form_$id",
'action'=>$url,
'cancel'=>isset($create)?"resetForm('form_$id')":""
])
@if (isset($create))
    @section('title-modal')
        Crear nodo tipo "Verdadero o Falso"
        @overwrite
    @else
    @section('title-modal')
        Editar el nodo "{{ !isset($create) && isset($node) && $node ? $node->name : '' }}" tipo "Verdadero o Falso"
        @overwrite
    @endif

    @section('content-modal')
        <input type="hidden" name="lesson_id" value="{{ isset($lesson->id) ? $lesson->id : $node->lesson_id }}">
        <input type="hidden" name="type_id" value="2">
        <div class="form-group">
            <label for="inputPassword4">Nombre de referencia</label>
            <input name="name" type="text" class="form-control" required
                value="{{ !isset($create) && isset($node) && $node ? $node->name : '' }}"
                placeholder="Escriba el nombre de referencia">
        </div>
        <div class="form-group">
            <label for="inputAddress">Pregunta</label>
            <textarea class="form-control" rows="2" required name="content"
                placeholder="Ingrese pregunta" >{{ !isset($create) && isset($node) && $node ? $node->content : '' }}</textarea>
        </div>
        <div class="form-group">
            <label for="inputAddress">Pregunta en ingles</label>
            <textarea class="form-control" rows="2" required name="content_english"
                placeholder="Ingrese pregunta">{{ !isset($create) && isset($node) && $node ? $node->content_english : '' }}</textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="success">
            <label class="form-check-label" for="exampleCheck1">Marcar si es verdadero</label>
        </div>
        @overwrite

    @section('button-modal')
        <input class="btn btn-success" type="submit" value="Guardar">
        @overwrite
