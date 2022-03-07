@extends('layouts.admin.app')
@section('pageName', 'Edit Role')
@section('action', 'admin.role.edit')

@section('content')
     <div class="row">
        <div class="col-12">
            @include('components.roles.card_form_edit')
        </div>
    </div>
@stop

