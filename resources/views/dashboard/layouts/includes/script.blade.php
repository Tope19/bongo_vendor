<!-- core:js -->
<script src="{{ $admin_source }}/vendors/core/core.js"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ $admin_source }}/vendors/chartjs/Chart.min.js"></script>
<script src="{{ $admin_source }}/vendors/jquery.flot/jquery.flot.js"></script>
<script src="{{ $admin_source }}/vendors/jquery.flot/jquery.flot.resize.js"></script>
<script src="{{ $admin_source }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{ $admin_source }}/vendors/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('dashboard/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('dashboard/js/data-table.js') }}"></script>
<script src="{{ asset('dashboard/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ $admin_source }}/vendors/feather-icons/feather.min.js"></script>
<script src="{{ $admin_source }}/js/template.js"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{ $admin_source }}/js/dashboard-light.js"></script>
{{-- <script src="{{ $admin_source }}/js/datepicker.js"></script> --}}

{{-- @if (Request::url() == url('/admin/dashboard/blogs/create')) --}}
<script src="{{ $admin_source }}/vendors/tinymce/tinymce.min.js"></script>
<script src="{{ $admin_source }}/js/tinymce.js"></script>
{{-- @endif --}}


<!-- End custom js for this page -->

<!-- core:js -->
{{-- <script src="{{ $admin_source }}/vendors/core/core.js"></script> --}}
<!-- endinject -->

<!-- Plugin js for this page -->
{{-- <script src="{{ $admin_source }}/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{ $admin_source }}/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script> --}}
<!-- End plugin js for this page -->

<!-- inject:js -->
{{-- <script src="{{ $admin_source }}/vendors/feather-icons/feather.min.js"></script>
	<script src="{{ $admin_source }}/js/template.js"></script> --}}
<!-- endinject -->

<!-- Custom js for this page -->
{{-- <script src="{{ $admin_source }}/js/data-table.js"></script> --}}

{{-- @toastr_js --}}
