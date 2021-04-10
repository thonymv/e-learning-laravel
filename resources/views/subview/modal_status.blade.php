@extends('subview.modal',['id'=>$id])

@if ($status)
    @section('title-modal')
        Desactivar {{ $label }} "{{ $name }}"
        @overwrite
    @else
    @section('title-modal')
        Activar {{ $label }} "{{ $name }}"
        @overwrite
    @endif

    @section('content-modal')
        @if ($status)
            <p>
                ¿Seguro que desea desactivar {{ $label }} "{{ $name }}"?
            </p>
        @else
            <p>
                ¿Seguro que desea activar {{ $label }} "{{ $name }}"?
            </p>
        @endif
        @overwrite

    @section('button-modal')
        @if ($status)
            <a type="button" class="btn btn-danger" href="{{ url($url) }}">Desactivar</a>
        @else
            <a type="button" class="btn btn-success" href="{{ url($url) }}">Activar</a>
        @endif
        @overwrite
