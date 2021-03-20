<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la sección "{{ $section->name }}"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card" style="">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Nombre: </strong>{{ $section->name }}</li>
                            <li class="list-group-item"><strong>Nombre en inglés:
                                </strong>{{ $section->name_english }}</li>
                            <li class="list-group-item"><strong>Descripción: </strong>{{ $section->description }}</li>
                            <li class="list-group-item">
                                <strong>Descripción en ingles: </strong>{{ $section->description_english }}
                            </li>
                            <li class="list-group-item">
                                <strong>Cursos: </strong>
                                <div class="row p-0 m-0 mt-3 col-12">
                                    @foreach ($section->courses as $course)
                                        <div class="col-4 col-md-3">
                                            <div
                                                class="col-5 col-md-6 p-0 mx-auto justify-content-center align-items-center text-center">
                                                <img src="img/{{ $course->image }}" alt="..."
                                                    class="img-thumbnail rounded-circle">
                                            </div>
                                            <div class="col-12 px-0 text-center">
                                                <p class="text-item-course">
                                                    {{ $course->name }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-4 col-md-3">
                                        <div
                                            class="col-5 col-md-6 p-0 pb-1 mx-auto justify-content-center align-items-center text-center">
                                            <button class="btn btn-success btn-circle" onclick="">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </div>
                                        <div class="col-12 px-0 text-center">
                                            <p class="text-item-course text-center">
                                                <strong>Editar lista</strong><br>
                                                <strong>de cursos</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
