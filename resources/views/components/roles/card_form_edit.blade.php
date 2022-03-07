<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Edit Role
        </h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <x-form action="{{ route('admin.roles.update', $role) }}" method="PUT">
        <div class="card-body">
            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="title">
                            Title
                        </label>
                        <input class="form-control 
                            @error('title') {{ 'is-invalid' }} @enderror" 
                            id="title" name="title" placeholder="Enter title" type="text" 
                            value="{{ old('title', $role->title) }}">
                        <x-input-error for="title"/>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">
                            Name
                        </label>
                        <input class="form-control" id="name" type="text" disabled
                            value="{{ old('name', $role->name) }}">
                    </div>
                </div>
            </div>
            <div class="form-row mb-3">
                <div class="col">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input class="custom-control-input" id="is_default" name="is_default"    type="checkbox" @checked($role->is_default)>
                            <label class="custom-control-label" for="is_default">
                                Default
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <p>
                        <strong>
                            PERMISSIONS
                        </strong>
                    </p>
                    <div class="dropdown-divider">
                    </div>
                </div>
                @foreach ($permissions as $group => $groupPermissions)
                <div class="col-md-4">
                    <div class="card js-card-permission">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" 
                                    data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                            </div>

                            <strong class="text-uppercase">
                                {{ $group }}
                            </strong>

                            <div class="custom-control custom-checkbox mt-1">
                                <input class="custom-control-input 
                                   js-check-all-permission" 
                                    id="check_all_permission_{{ $group }}" 
                                    type="checkbox"
                                    @checked(
                                        arrayInArray(
                                            $groupPermissions->pluck('name')->toArray(),
                                            $permissionCheckeds
                                        )
                                    )>
                                <label class="custom-control-label" 
                                    for="check_all_permission_{{ $group }}">
                                </label>
                            </div>
                           
                        </div>

                        <div class="card-body">
                            @foreach ($groupPermissions as $permission)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input js-check-one-permission" 
                                    id="check_permission_{{ $permission->id }}" 
                                    name="permissions[]" type="checkbox" 
                                    value="{{ $permission->name }}" 
                                    @checked(
                                        in_array(
                                            $permission->name,
                                            old('permissions', [])
                                        ) 
                                        || in_array(
                                            $permission->name,
                                            $permissionCheckeds
                                        )
                                    )>
                                    <label class="custom-control-label" 
                                        for="check_permission_{{ $permission->id }}">
                                        {{ $permission->title }}
                                        (
                                        <span class="text-info">
                                            {{ $permission->name }}
                                        </span>
                                        )
                                    </label>
                                </input>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button class="btn btn-primary" type="submit">
                Save
            </button>
        </div>
    </x-form>
</div>