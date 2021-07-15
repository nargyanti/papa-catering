<div class="my-3">
@if ($message = Session::get('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Failed!</strong><span> {{ $message }}</span>
    </div>
@elseif ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Success!</strong><span> {{ $message }}</span>
    </div>
@endif
</div>
