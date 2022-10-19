@if (Session::has('error'))
    <div class="alert alert-danger" style="width:100%">
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success" style="width:100%">
        {{ Session::get('success') }}
    </div>
@endif
