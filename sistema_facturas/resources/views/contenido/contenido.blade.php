@extends('principal')
@section('contenido')

    @if(Auth::check())
        @if(Auth::user()->idrol == 1)
            <template v-if="menu==0">
                <dashboard></dashboard>
            </template>
            <template v-if="menu==1">
                <facturas></facturas>
            </template>
            <template v-if="menu==2">
                <reportes></reportes>
            </template>
            <template v-if="menu==3">
                <user></user>
            </template>
            <template v-if="menu==4">
                <sociedades></sociedades>
            </template>
            <template v-if="menu==5">
                <galeria></galeria>
            </template>
            <template v-if="menu==6">
                <documentos></documentos>
            </template>
        @endif
    @endif
@endsection