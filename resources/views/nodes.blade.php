@extends('layouts.app')
@section('select', '/courses')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Nodos de la lección "{{ $lesson->name }}"</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="{{ url('/courses') }}">Cursos</a></li>
            <li class="breadcrumb-item ">{{ $course->name }}</li>
            <li class="breadcrumb-item ">
                <a href="{{ url("/courses/$course->id/modules") }}">Módulos</a>
            </li>
            <li class="breadcrumb-item ">{{ $module->name }}</li>
            <li class="breadcrumb-item ">
                <a href="{{ url("/courses/$course->id/modules/$module->id/lessons") }}">Lecciones</a>
            </li>
            <li class="breadcrumb-item ">{{ $lesson->name }}</li>
            <li class="breadcrumb-item active">
                <a href="{{ url("/courses/$course->id/modules/$module->id/lessons/$lesson->id/nodes") }}">
                    Nodos
                </a>
            </li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($nodes) }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Nodos totales</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $nodesActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Nodos activos</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($nodes) - $nodesActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Nodos inactivos</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $nodesEmpty }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Nodos vacíos</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row p-0 m-0 align-items-center">
                    <i class="fas fa-table mr-1"></i>
                    Mostrando {{ $page['from']?$page['from']:0 }} a {{ $page['to']?$page['to']:0 }} de {{ $page['total'] }} Nodos
                    <div class="ml-auto">
                        <button title="Registrar &quot;Contenido&quot;" data-target="#modalRegister" data-toggle="modal" class="btn btn-success btn-circle p-0">
                            <div class="d-flex justify-content-center align-items-center text-center"
                                style="width: 35px;height:35px;">
                                <i class="fas fa-plus"></i>
                            </div>
                        </button>
                        <button title="Registrar &quot;Verdadero o Falso&quot;" data-target="#modalRegisterVr" data-toggle="modal" class="btn btn-primary btn-circle p-0 ml-2">
                            <div class="d-flex justify-content-center align-items-center text-center"
                                style="width: 35px;height:35px;">
                                <i class="fas fa-plus"></i>
                            </div>
                        </button>
                        @include('subview.modal_edit_node_vr',[
                        "id"=>"modalRegisterVr",
                        "create"=>true,
                        "url"=>"/courses/$course->id/modules/$module->id/lessons/$lesson->id/nodes"
                        ])
                        <button title="Registrar &quot;Selección&quot;" data-target="#modalRegisterS" data-toggle="modal" class="btn btn-info btn-circle p-0 ml-2">
                            <div class="d-flex justify-content-center align-items-center text-center"
                                style="width: 35px;height:35px;">
                                <i class="fas fa-plus"></i>
                            </div>
                        </button>
                        @include('subview.modal_edit_node_s',[
                        "id"=>"modalRegisterS",
                        "create"=>true,
                        "url"=>"/courses/$course->id/modules/$module->id/lessons/$lesson->id/nodes"
                        ])
                        <button title="Registrar &quot;Reorganizar&quot;" data-target="#modalRegisterR" data-toggle="modal" class="btn btn-warning btn-circle p-0 ml-2">
                            <div class="d-flex justify-content-center align-items-center text-center"
                                style="width: 35px;height:35px;">
                                <i class="fas fa-plus"></i>
                            </div>
                        </button>
                        @include('subview.modal_edit_node_r',[
                        "id"=>"modalRegisterR",
                        "create"=>true,
                        "url"=>"/courses/$course->id/modules/$module->id/lessons/$lesson->id/nodes"
                        ])
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
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Opciones</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tfoot class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre en ingles</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Opciones</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($nodes as $node)
                                <tr>
                                    <td>
                                        {{ $node->name }}
                                    </td>
                                    <td>
                                        {{ $node->name_english }}
                                    </td>
                                    <td>{{ $node->created_at }}</td>
                                    <td>{{ $node->updated_at }}</td>
                                    <td class="text-center">
                                        <button data-target="#modalListCourses{{ $node->id }}" data-toggle="modal"
                                            class="btn btn-info" style="white-space: nowrap;">
                                            <strong>{{ count($node->options) }}</strong>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalView{{ $node->id }}" data-toggle="modal"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalEdit{{ $node->id }}" data-toggle="modal"
                                            class="btn btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalDelete{{ $node->id }}" data-toggle="modal"
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