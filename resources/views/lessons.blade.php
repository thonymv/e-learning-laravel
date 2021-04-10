@extends('layouts.app')
@section('select', '/courses')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Lecciones del módulo "{{ $module->name }}"</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ url('/courses') }}">Cursos</a></li>
            <li class="breadcrumb-item active">{{ $course->name }}</li>
            <li class="breadcrumb-item active"><a href="{{ url('/courses/'.$course->id.'/modules') }}">Módulos</a></li>
            <li class="breadcrumb-item active">{{ $module->name }}</li>
            <li class="breadcrumb-item active">Lecciones</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($lessons) }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Lecciones totales</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $lessonsActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Lecciones activas</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($lessons) - $lessonsActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Lecciones inactivas</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $lessonsEmpty }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Lecciones vacías</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row p-0 m-0 align-items-center">
                    <i class="fas fa-table mr-1"></i>
                    Mostrando {{ $page['from'] }} a {{ $page['to'] }} de {{ $page['total'] }} lecciones
                    <div class="ml-auto">
                        <button data-target="#modalRegister" data-toggle="modal" class="btn btn-primary btn-circle p-0">
                            <div class="d-flex justify-content-center align-items-center text-center"
                                style="width: 35px;height:35px;">
                                <i class="fas fa-plus"></i>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre en ingles</th>
                                <th>Estatus</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Nodos</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tfoot class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre en ingles</th>
                                <th>Estatus</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Nodos</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td>
                                        {{ $lesson->name }}
                                    </td>
                                    <td>
                                        {{ $lesson->name_english }}
                                    </td>
                                    <td class="text-center">
                                        @if ($lesson->status)
                                            <button data-target="#modalStatus{{ $lesson->id }}" data-toggle="modal"
                                                class="btn btn-success btn-circle p-0">
                                                <div class="d-flex justify-content-center align-items-center text-center"
                                                    style="width: 35px;height:35px;">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                            </button>
                                        @else
                                            <button data-target="#modalStatus{{ $lesson->id }}" data-toggle="modal"
                                                class="btn btn-danger btn-circle p-0">
                                                <div class="d-flex justify-content-center align-items-center text-center"
                                                    style="width: 35px;height:35px;">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $lesson->created_at }}</td>
                                    <td>{{ $lesson->updated_at }}</td>
                                    <td class="text-center">
                                        <button data-target="#modalListCourses{{ $lesson->id }}" data-toggle="modal"
                                            class="btn btn-info" style="white-space: nowrap;">
                                            <strong>{{ count($lesson->nodes) }}</strong>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalView{{ $lesson->id }}" data-toggle="modal"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalEdit{{ $lesson->id }}" data-toggle="modal"
                                            class="btn btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalDelete{{ $lesson->id }}" data-toggle="modal"
                                            class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
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
