@extends('subview.modal',['id'=>$id])
@section('title-modal')
    Ver el módulo "{{ $module->name }}"
    @overwrite

@section('content-modal')
    <div class="d-flex justify-content-center align-items-center mb-3">
        <div class="col-6 col-md-4">
            <div class="thumbnail-image-edit">
                <img src="{{ asset('/img/'.$module->image) }}" class="img-edit">
            </div>
        </div>
    </div>
    <div class="card" style="">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nombre: </strong>{{ $module->name }}</li>
            <li class="list-group-item"><strong>Nombre en inglés: </strong>{{ $module->name_english }}</li>
            <li class="list-group-item">
                <strong>Módulos: </strong>
                <div class="row p-0 m-0 mt-3 col-12">
                    @foreach ($module->lessons as $lesson)
                        <div class="col-4 col-md-3">
                            <div class="col-12 px-0 text-center">
                                <p class="text-item-course">
                                    {{ $lesson->name }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-4 col-md-3">
                        <div class="col-5 col-md-6 p-0 pb-1 mx-auto justify-content-center align-items-center text-center">
                            <a class="btn btn-success btn-circle p-0" href="{{ url($url)}}">
                                <div class="d-flex justify-content-center align-items-center text-center"
                                    style="width: 30px;height:30px;">
                                    <i class="fas fa-pen"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 px-0 text-center">
                            <p class="text-item-course text-center">
                                <strong>Editar lista</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    @overwrite
@section('button-modal')@overwrite