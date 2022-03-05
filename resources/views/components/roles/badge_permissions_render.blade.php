<div class="d-flex flex-wrap">
	@if ($permissions !== null && $permissions->count() !== 0)
		@foreach ($permissions as $permission)
			<span class="badge badge-info m-1">
				{{ $permission->name }}
			</span>
		@endforeach
	@else
		<p>Không có quyền nào</p>
	@endif
</div>