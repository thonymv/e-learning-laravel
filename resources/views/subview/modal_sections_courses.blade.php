<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cursos de la sección "{{ $section->name }}"</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card" style="">
                        <div class="card-header">
                            <strong>Cursos: </strong>
                        </div>
                        <div class="card-body p-0 m-0 col-12">
                            <ul class="list-group list-group-flush">
                                @foreach ($courses as $course)
                                    <li class="list-group-item">
                                        <div class="row col-12 align-items-center">
                                            <div
                                                class="col-1 p-0 m-0 justify-content-center align-items-center text-center">
                                                <img src="img/{{ $course->image }}" alt="..."
                                                    class="img-thumbnail rounded-circle m-0">
                                            </div>
                                            <div class="p-0 text-center m-0 ml-1">
                                                <p class="text-item-course m-0">
                                                    {{ $course->name }}
                                                </p>
                                            </div>
                                            <div class="p-0 m-0 ml-auto d-flex justify-content-center align-items-center">
                                                @php
                                                    $check = false;
                                                    foreach($section->courses as $course2){
                                                        if($course->id === $course2->id){
                                                            $check = true;
                                                        }
                                                    }
                                                @endphp
                                                <input type="checkbox" class="form-check-input p-0 m-0" {{$check?"checked":""}}>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
