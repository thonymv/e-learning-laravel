@extends('subview.modal',['id'=>$id])
@section('title-modal')
    Eliminar {{ $label }} "{{ $name }}"
    @overwrite

@section('content-modal')
    <form name="security_{{ $id }}">
        <div class="form-group">
            <label for="exampleInputEmail1">Si desea eliminar {{ $label }}, escriba la palabra de seguridad
                "eliminar"</label>
            <input onkeypress="disableEnter(event)" type="text" class="form-control" name="word"
                aria-describedby="emailHelp" placeholder="escriba la palabra de seguridad">
            <small id="emailHelp" class="form-text text-muted">La palabra de seguridad debe estar en minúsculas, sin
                caracteres especiales ni espacios.</small>
        </div>
    </form>
    @overwrite

@section('button-modal')
    <a type="button" onclick="security(event,'{{ $id }}')" class="btn btn-danger"
        href="{{ url($url) }}">Eliminar</a>
    @overwrite


    <script type="text/javascript">
        if (typeof security === "undefined") {
            function security(event, id) {
                let form = document["security_" + id]
                if (form.word.value !== "eliminar") {
                    event.preventDefault();
                    alert("Palabra de seguridad incorrecta")
                }
            }
        }

        if (typeof disableEnter === "undefined") {
            function disableEnter(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            }
        }

    </script>
