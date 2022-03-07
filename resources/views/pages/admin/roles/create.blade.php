@extends('layouts.admin.app')
@section('pageName', 'Create Role')
@section('action', 'admin.role.create')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.roles.card_form_create')
        </div>
    </div>
@stop


