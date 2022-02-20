@extends('layouts.admin.app')
@section('pageName', 'List Role')
@section('action', 'admin.role.index')
    
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <a class="btn btn-default" href="{{ route('admin.roles.create') }}">
                    Add
                </a>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="btn-group" id="bulk_action">
                        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" 
                            type="button">
                            Bulk Action
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="delete_multiple_role" style="cursor: pointer;">
                                <i class="far fa-trash-alt mr-2">
                                </i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="role_table">
                        <thead>
                            <tr>
                                <th>
                                </th>
                                <th>
                                    #
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Default
                                </th>
                                <th>
                                    Users
                                </th>
                                <th>
                                    Permissions
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>
                                </th>
                                <th>
                                    <th>
                                    </th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop
