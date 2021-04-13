@extends('subview.modal',['id'=>$id])
@section('title-modal')
    Ver el lección "{{ $lesson->name }}"
    @overwrite

@section('content-modal')
    <div class="card" style="">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Nombre: </strong>{{ $lesson->name }}</li>
            <li class="list-group-item"><strong>Nombre en inglés: </strong>{{ $lesson->name_english }}</li>
            <li class="list-group-item">
                <strong>Nodos: </strong>
                <div class="row p-0 m-0 mt-3 col-12">
                    @foreach ($lesson->nodes as $node)
                        <div class="col-4 col-md-3">
                            <div class="col-12 px-0 text-center">
                                <p class="text-item-course">
                                    {{ $node->name }}
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
