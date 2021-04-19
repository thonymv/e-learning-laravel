@extends('subview.modal',[
    'id'=>$id,
    'id_form'=>"form_$id",
    'action'=>$url,
    'cancel'=>isset($create)?"resetForm('form_$id')":""
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
            <label for="inputPassword4">Nombre de referencia</label>
            <input name="name" type="text" class="form-control" value="{{ !isset($create) && isset($node) && $node ? $node->name : '' }}"
                placeholder="Escriba el nombre de referencia">
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home{{ $id }}" role="tab" aria-controls="home" aria-selected="true">
                    Contenido
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile{{ $id }}" role="tab" aria-controls="profile" aria-selected="false">
                    Contenido en ingles
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent{{ $id }}">
            <div class="tab-pane fade show active" id="home{{ $id }}" role="tabpanel" aria-labelledby="home-tab">
                <textarea name="content" required class="ckeditor" rows="4" id="editor{{ $id }}"
                    placeholder="Ingrese el contenido">{{ !isset($create) && isset($node) && $node ? $node->content : '' }}</textarea>
            </div>
            <div class="tab-pane fade" id="profile{{ $id }}" role="tabpanel" aria-labelledby="profile-tab">
                <textarea required class="ckeditor" rows="4" name="content_english" id="editor{{ $id }}_english"
                    placeholder="Ingrese el contenido">{{ !isset($create) && isset($node) && $node ? $node->content_english : '' }}</textarea>
            </div>
        </div>
        @overwrite
    @section('button-modal')
        <input class="btn btn-success" type="submit" value="Guardar">
        @overwrite
