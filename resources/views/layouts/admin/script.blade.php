<!-- jQuery -->
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script> --}}
<!-- jQuery UI 1.11.4 -->
{{-- <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  // $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
{{-- <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
<!-- SweetAlert2 -->
{{-- <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script> --}}
<!-- Toastr -->
{{-- <script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script> --}}
<!-- overlayScrollbars -->
{{-- <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
{{-- AdminLTE App --}}
{{-- <script src="{{ asset('template/dist/js/adminlte.js') }}"></script> --}}
<!-- DataTables  & Plugins -->
{{-- <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
{{-- <script src="{{ asset('template/dist/js/demo.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->

{{-- <script src="{{ asset('js/bootstrap.js') }}"></script> --}}
@stack('script')