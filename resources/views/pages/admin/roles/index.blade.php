@extends('layouts.admin.app')
@section('pageName', 'List Role')
@section('action', 'admin.role.index')
    
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group mb-1">
                <a class="btn btn-default" href="{{ route('admin.roles.create') }}">
                    TẠO MỚI
                </a>
                <a class="btn btn-default" href="{{ route('admin.roles.create') }}">
                    NHẬP EXCEL
                </a>
                <a class="btn btn-default" href="{{ route('admin.roles.create') }}">
                    XUẤT EXCEL
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
                    <div class="table-responsive-sm">
                        <table class="table table-bordered table-striped" id="role_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th>Mặc định</th>
                                    <th>Số người dùng</th>
                                    <th>Các quyền</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop
