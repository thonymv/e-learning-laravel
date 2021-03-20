@extends('layouts.app')

@section('select')/@endsection

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Secciones</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Secciones</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre en ingles</th>
                                <th>Estatus</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Cursos</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Nombre en ingles</th>
                                <th>Estatus</th>
                                <th>Creado en</th>
                                <th>Modificado en</th>
                                <th>Cursos</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Borrar</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->name_english }}</td>
                                    <td class="text-center">
                                        @if ($section->status)
                                            <button data-target="#modalStatus{{ $section->id }}" data-toggle="modal"
                                                class="btn btn-success btn-circle">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        @else
                                            <button data-target="#modalStatus{{ $section->id }}" data-toggle="modal"
                                                class="btn btn-danger btn-circle">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ $section->created_at }}</td>
                                    <td>{{ $section->updated_at }}</td>
                                    <td>{{ count($section->courses) }}</td>
                                    <td class="text-center">
                                        <button data-target="#modalView{{ $section->id }}" data-toggle="modal"
                                            class="btn btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalEdit{{ $section->id }}" data-toggle="modal"
                                            class="btn btn-success">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#modalDelete{{ $section->id }}" data-toggle="modal"
                                            class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('subview.modal_status',[
                                    "id"=>"modalStatus$section->id",
                                    "status"=>$section->status,
                                    "name"=>$section->name,
                                    "url"=>"/"
                                ])
                                @include('subview.modal_delete',[
                                    "id"=>"modalDelete$section->id",
                                    "name"=>$section->name,
                                    "url"=>"/"
                                ])
                                @include('subview.modal_edit',[
                                    "id"=>"modalEdit$section->id",
                                    "section"=>$section,
                                    "url"=>"/"
                                ])
                                @include('subview.modal_view',[
                                    "id"=>"modalView$section->id",
                                    "section"=>$section,
                                    "url"=>"/"
                                ])
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
