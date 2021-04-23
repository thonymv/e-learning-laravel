@extends('subview.modal',[
'id'=>$id,
'id_form'=>"form_$id",
'action'=>$url,
'cancel'=>isset($create)?"resetForm('form_$id')":""
])
@if (isset($create))
    @section('title-modal')
        Crear nodo tipo "Contenido"
        @overwrite
    @else
    @section('title-modal')
        Editar el nodo "{{ !isset($create) && isset($node) && $node ? $node->name : '' }}"
        @overwrite
    @endif

    @section('content-modal')
        <input type="hidden" name="lesson_id" value="{{ isset($lesson->id) ? $lesson->id : $node->lesson_id }}">
        <input type="hidden" name="type_id" value="1">
        <div class="form-group">
            <label for="inputPassword4">Nombre de referencia</label>
            <input name="name" type="text" class="form-control" required
                value="{{ !isset($create) && isset($node) && $node ? $node->name : '' }}"
                placeholder="Escriba el nombre de referencia">
        </div>
        <ul class="nav nav-tabs" id="myTab-{{ $id }}" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="es-tab-{{ $id }}" data-toggle="tab" href="#es-{{ $id }}"
                    role="tab" aria-controls="es" aria-selected="true">
                    Contenido
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="en-tab-{{ $id }}" data-toggle="tab" href="#en-{{ $id }}" role="tab"
                    aria-controls="en" aria-selected="false">
                    Contenido en ingles
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent{{ $id }}">
            <div class="tab-pane fade show active" id="es-{{ $id }}" role="tabpanel" aria-labelledby="es-tab-{{ $id }}">
                <textarea name="content" required class="ckeditor" rows="4" id="editor{{ $id }}"
                    placeholder="Ingrese el contenido">{{ !isset($create) && isset($node) && $node ? $node->content : '' }}</textarea>
            </div>
            <div class="tab-pane fade" id="en-{{ $id }}" role="tabpanel" aria-labelledby="en-tab-{{ $id }}">
                <textarea required class="ckeditor" rows="4" name="content_english" id="editor_english{{ $id }}"
                    placeholder="Ingrese el contenido">{{ !isset($create) && isset($node) && $node ? $node->content_english : '' }}</textarea>
            </div>
        </div>
        <script>
            window.addEventListener('load', function() {
                $('#<?= "$id" ?>').on("shown.bs.modal", function(e) {

                    if (CKEDITOR.instances['<?= "editor$id" ?>']) {
                        CKEDITOR.instances['<?= "editor$id" ?>'].destroy(true);
                    }
                    if (CKEDITOR.instances['<?= "editor_english$id" ?>']) {
                        CKEDITOR.instances['<?= "editor_english$id" ?>'].destroy(true);
                    }
                    let tab_es = $('#<?= "es-$id" ?>')//content tab spanish bootstrap
                    let tab_btn_es = $('#<?= "myTab-$id" ?> a[href="#<?= "es-$id" ?>"]')//button tab spanish bootstrap
                    let tab_en = $('#<?= "en-$id" ?>')//content tab english bootstrap
                    let tab_btn_en = $('#<?= "myTab-$id" ?> a[href="#<?= "en-$id" ?>"]')//button tab english bootstrap

                    let editor = CKEDITOR.replace('<?= "editor$id" ?>', {//replace new instance editor ckeditor spanish with notification
                        extraPlugins: 'notification'
                    })
                    let editor2 = CKEDITOR.replace('<?= "editor_english$id" ?>', {//replace new instance editor ckeditor english with notification
                        extraPlugins: 'notification'
                    })
                    
                    let required = false

                    editor.on('required', function(evt) {//event required editor ckeditor spanish
                        if (classExist("cke_notification_warning") > 0) {
                            $('div.cke_notification_warning').remove()
                        }
                        if (!findClass(tab_es, "active")) {
                            tab_btn_es.tab('show')
                            editor2.showNotification('Este campo es requerido.', 'warning');
                        }else{
                            editor.showNotification('Este campo es requerido.', 'warning');
                        }
                        evt.cancel();
                    });

                    editor2.on('required', function(evt) {//event required editor ckeditor english
                        if ((CKEDITOR.instances['<?= "editor$id" ?>'].getData()+"").length > 0) {
                            if (classExist("cke_notification_warning") > 0) {
                                $('div.cke_notification_warning').remove()
                            }
                            if (!findClass(tab_en, "active")) {
                                tab_btn_en.tab('show')
                                editor.showNotification('Este campo es requerido.', 'warning');
                            }else{
                                editor2.showNotification('Este campo es requerido.', 'warning');
                            }
                        }
                        evt.cancel();
                    });
                });
            });

        </script>
        @overwrite
    @section('button-modal')
        <input class="btn btn-success" type="submit" value="Guardar">
        @overwrite
