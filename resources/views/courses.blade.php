@extends('layouts.app')
@section('select','/courses')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Cursos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Cursos</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($courses) }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Cursos totales</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $coursesActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Cursos activos</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($courses) - $coursesActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Cursos inactivos</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $coursesEmpty }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Cursos vacíos</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row p-0 m-0 align-items-center">
                    <i class="fas fa-table mr-1"></i>
                    Mostrando {{ $page['from'] }} a {{ $page['to'] }} de {{ $page['total'] }} cursos
                    <div class="ml-auto">
                        <button data-target="#modalRegister" data-toggle="modal" class="btn btn-primary btn-circle p-0">
                            <div class="d-flex justify-content-center align-items-center text-center"
                                style="width: 35px;height:35px;">
                                <i class="fas fa-plus"></i>
                            </div>
                        </button>
                        @include('subview.modal_edit_course',[
                        "id"=>"modalRegister",
                        "create"=>true,
                        "url"=>"/"
                        ])
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Nombre en ingles</th>
                                <th>Estatus</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Precio</th>
                                <th>Módulos</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tfoot class="thead-light">
                            <tr>
                                <th>Foto</th>
                                <th>Nombre</th>
                                <th>Nombre en ingles</th>
                                <th>Estatus</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Precio</th>
                                <th>Módulos</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td class="justify-content-center align-items-center text-center ">
                                        <img src="{{ asset('/img/'.$course->image) }}" class="img-thumbnail rounded-circle m-0"
                                            style="width: 40px;height:40px;">
                                    </td>
                                    <td>
                                        {{ $course->name }}
                                    </td>
                                    <td>
                                        {{ $course->name_english }}
                                    </td>
                                    <td class="text-center">
                                        @if ($course->status)
                                            <button data-target="#modalStatus{{ $course->id }}" data-toggle="modal"
                                                class="btn btn-success btn-circle p-0">
                                                <div class="d-flex justify-content-center align-items-center text-center"
                                                    style="width: 35px;height:35px;">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                            </button>
                                        @else
                                            <button data-target="#modalStatus{{ $course->id }}" data-toggle="modal"
                                                class="btn btn-danger btn-circle p-0">
                                                <div class="d-flex justify-content-center align-items-center text-center"
                                                    style="width: 35px;height:35px;">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $course->created_at }}</td>
                                    <td>{{ $course->updated_at }}</td>
                                    <td>{{ $course->price }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/courses/'.$course->id.'/modules')}}" class="btn btn-info">
                                            <strong>{{ count($course->modules) }}</strong>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalView{{ $course->id }}" data-toggle="modal"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalEdit{{ $course->id }}" data-toggle="modal"
                                            class="btn btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalDelete{{ $course->id }}" data-toggle="modal"
                                            class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('subview.modal_status',[
                                "id"=>"modalStatus$course->id",
                                "status"=>$course->status,
                                "label"=>"el curso",
                                "name"=>$course->name,
                                "url"=>"/courses"
                                ])
                                @include('subview.modal_edit_course',[
                                "id"=>"modalEdit$course->id",
                                "course"=>$course,
                                "url"=>"/courses"
                                ])
                                @include('subview.modal_view_courses',[
                                "id"=>"modalView$course->id",
                                "course"=>$course,
                                "url"=>"/courses"
                                ])
                                @include('subview.modal_delete',[
                                "id"=>"modalDelete$course->id",
                                "label"=>"el curso",
                                "name"=>$course->name,
                                "url"=>"/courses"
                                ])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer table-responsive">
                <div class="row p-0 m-0 align-items-center">
                    <nav class="ml-auto">
                        <ul class="pagination mb-0">
                            <li class="page-item"><a class="page-link" href="{{ $page['prev_page_url'] }}">
                                    <i class="fas fa-angle-left"></i>
                                </a></li>
                            @for ($i = 1; $i <= $page['last_page']; $i++)
                                <li class="page-item {{ $page['current_page'] == $i ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ $page['path'] . '?page=' . $i }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item"><a class="page-link" href="{{ $page['next_page_url'] }}">
                                    <i class="fas fa-angle-right"></i>
                                </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
