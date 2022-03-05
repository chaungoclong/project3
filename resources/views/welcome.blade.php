@extends('layouts.admin.app')

@section('content')
<div class="row col-12">
    <div class="card card-body">
        <video controls="" width="400" class="lozad">
            <source src="{{ asset('uploads/video.mp4') }}" type="video/mp4">
                <source src="mov_bbb.ogg" type="video/ogg">
                    Your browser does not support HTML video.
                </source>
            </source>
        </video>
    </div>
</div>
@stop
@push('script')
<script src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js" type="text/javascript">
</script>
<script type="text/javascript">
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
	observer.observe();
</script>
@endpush
