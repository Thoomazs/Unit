@if (Session::has('flash_notification.message'))
    <div id="flash-messages" class="alert alert-{{ Session::get('flash_notification.level') }} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash_notification.message') }}
    </div>

    <script type="text/javascript">
        $(function() { $("#flash-messages").delay(10000).slideUp(200); })
    </script>
@endif