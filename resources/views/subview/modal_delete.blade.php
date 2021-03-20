<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar la sección "{{$name}}"</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="security_{{$id}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Si desea eliminar la sección, escriba la palabra de seguridad "eliminar"</label>
                        <input onkeypress="disableEnter(event)" type="text" class="form-control" name="word" aria-describedby="emailHelp" placeholder="escriba la palabra de seguridad">
                        <small id="emailHelp" class="form-text text-muted">La palabra de seguridad debe estar en minúsculas, sin caracteres especiales ni espacios.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a type="button" onclick="security(event,'{{$id}}')" class="btn btn-danger" href="{{url($url)}}">Eliminar</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof security === "undefined") { 
        function security(event,id) {
            let form = document["security_"+id]
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