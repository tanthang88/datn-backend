@props(['errorText'])
<div class="row">
    <div class="col-12">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errorText }}
        </div>
        @endif
    </div>
</div>
