@extends('layouts.app')
@section('select', '/courses')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Módulos del curso "{{ $course->name }}"</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ url('/courses') }}">Cursos</a></li>
            <li class="breadcrumb-item active">{{ $course->name }}</li>
            <li class="breadcrumb-item active">Módulos</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($modules) }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Módulos totales</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $modulesActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Módulos activos</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ count($modules) - $modulesActive }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Módulos inactivos</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">
                        <p class="h5 m-0">{{ $modulesEmpty }}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="small text-white m-0">Módulos vacíos</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <div class="row p-0 m-0 align-items-center">
                    <i class="fas fa-table mr-1"></i>
                    Mostrando {{ $page['from'] }} a {{ $page['to'] }} de {{ $page['total'] }} módulos
                    <div class="ml-auto">
                        <button data-target="#modalRegister" data-toggle="modal" class="btn btn-primary btn-circle p-0">
                            <div class="d-flex justify-content-center align-items-center text-center"
                                style="width: 35px;height:35px;">
                                <i class="fas fa-plus"></i>
                            </div>
                        </button>
                        @include('subview.modal_edit_module',[
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
                                <th>Lecciones</th>
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
                                <th>Lecciones</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td class="justify-content-center align-items-center text-center ">
                                        <div class="thumbnail-image-edit">
                                            <img src="{{ asset('/img/'.$module->image) }}" class="img-edit">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $module->name }}
                                    </td>
                                    <td>
                                        {{ $module->name_english }}
                                    </td>
                                    <td class="text-center">
                                        @if ($module->status)
                                            <button data-target="#modalStatus{{ $module->id }}" data-toggle="modal"
                                                class="btn btn-success btn-circle p-0">
                                                <div class="d-flex justify-content-center align-items-center text-center"
                                                    style="width: 35px;height:35px;">
                                                    <i class="fas fa-check-circle"></i>
                                                </div>
                                            </button>
                                        @else
                                            <button data-target="#modalStatus{{ $module->id }}" data-toggle="modal"
                                                class="btn btn-danger btn-circle p-0">
                                                <div class="d-flex justify-content-center align-items-center text-center"
                                                    style="width: 35px;height:35px;">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $module->created_at }}</td>
                                    <td>{{ $module->updated_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('/courses/'.$course->id.'/modules/'.$module->id.'/lessons')}}"
                                            class="btn btn-info" style="white-space: nowrap;">
                                            <strong>{{ count($module->lessons) }}</strong>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalView{{ $module->id }}" data-toggle="modal"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalEdit{{ $module->id }}" data-toggle="modal"
                                            class="btn btn-warning">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalDelete{{ $module->id }}" data-toggle="modal"
                                            class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('subview.modal_status',[
                                "id"=>"modalStatus$module->id",
                                "status"=>$module->status,
                                "label"=>"el módulo",
                                "name"=>$module->name,
                                "url"=>"/courses/$course->id/modules"
                                ])
                                @include('subview.modal_delete',[
                                "id"=>"modalDelete$module->id",
                                "label"=>"el módulo",
                                "name"=>$module->name,
                                "url"=>"/courses/$course->id/modules"
                                ])
                                @include('subview.modal_view_modules',[
                                "id"=>"modalView$module->id",
                                "module"=>$module,
                                "url"=>"/courses/$course->id/modules"
                                ])
                                @include('subview.modal_edit_module',[
                                "id"=>"modalEdit$module->id",
                                "module"=>$module,
                                "url"=>"/courses/$course->id/modules"
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
