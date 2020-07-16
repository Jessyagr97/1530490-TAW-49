@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <dashboard-component></dashboard-component>
    </template>
    <template v-if="menu==1">
        <categoria></categoria>
    </template>
    <template v-if="menu==2">
        <user></user>
    </template>
    <template v-if="menu==3">
        <rol></rol>
    </template>
    <template v-if="menu==4">
        <h2>Contenido 4</h2>
    </template>
    <template v-if="menu==5">
        <h2>Contenido 5</h2>
    </template>
@endsection