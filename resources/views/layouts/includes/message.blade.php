@if (Session::has('error'))
<script>
    $(document).ready(function() {
        toastr.error('{{ Session::get('error') }}');
    });
</script>
@elseif(Session::has('success'))
<script>
    $(document).ready(function() {
        toastr.success('{{ Session::get('success') }}');
    });
</script>
@elseif(Session::has('warning'))
<script>
    $(document).ready(function() {
        toastr.warning('{{ Session::get('warning') }}');
    });
</script>
@endif
