@extends('subview.modal',['id'=>$id])
@section('title-modal')
    Ver el curso "{{ $course->name }}"
    @overwrite

@section('content-modal')
    <div class="d-flex justify-content-center align-items-center mb-3">
        <div class="col-6 col-md-4">
            <img src="{{ asset('/img/'.$course->image) }}" class="img-thumbnail rounded-circle">
        </div>
    </div>
    <div class="card" style="">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nombre: </strong>{{ $course->name }}</li>
            <li class="list-group-item"><strong>Nombre en inglés: </strong>{{ $course->name_english }}</li>
            <li class="list-group-item"><strong>Precio: </strong>{{ $course->price }}</li>
            <li class="list-group-item"><strong>Descripción: </strong>{{ $course->description }}</li>
            <li class="list-group-item">
                <strong>Descripción en ingles: </strong>{{ $course->description_english }}
            </li>
            <li class="list-group-item">
                <strong>Módulos: </strong>
                <div class="row p-0 m-0 mt-3 col-12">
                    @foreach ($course->modules as $module)
                        <div class="col-4 col-md-3">
                            <div class="col-5 col-md-6 p-0 mx-auto justify-content-center align-items-center text-center">
                                <img src="img/{{ $module->image }}" alt="..." class="img-thumbnail rounded-circle">
                            </div>
                            <div class="col-12 px-0 text-center">
                                <p class="text-item-course">
                                    {{ $module->name }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-4 col-md-3">
                        <div class="col-5 col-md-6 p-0 pb-1 mx-auto justify-content-center align-items-center text-center">
                            <a class="btn btn-success btn-circle p-0" href="{{ url('/courses/'.$course->id.'/modules')}}">
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
