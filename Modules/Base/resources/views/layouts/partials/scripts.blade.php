<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delete-btn').click(function () {
        let res = confirm("{{ trans('admin.delete_item_confirm') }}");
        if (!res) return false;
        let url = $(this).data('href');
        let form = $('#delete-form');
        form.attr('action', url).submit()
    });


</script>
