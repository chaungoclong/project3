@props(['type', 'method' => 'POST'])
{{-- {{ dd($type) }} --}}
@php 
$methods = ['GET', 'POST', 'DELETE', 'PUT', 'PATCH'];
$type = (isset($type)) ? trim(strtolower($type)) : '';
$method = strtoupper($method);
@endphp

<form {{ $attributes }} 
	{{-- method atrribute --}}
	@if (in_array($method, $methods) && $method !== 'GET')
		method="POST"
	@else
		method="GET"
	@endif

	{{-- mutipart --}}
	@if($type === 'file') 
		enctype="multipart/form-data" 
	@endif>

	{{-- csrf --}}
	@if (in_array($method, $methods) && $method !== 'GET')
		@csrf
	@endif

	{{-- override method --}}
	@if (in_array($method, $methods) && $method !== 'GET' && $method !== 'POST')
		@method($method)
	@endif

	{{ $slot }}
</form>