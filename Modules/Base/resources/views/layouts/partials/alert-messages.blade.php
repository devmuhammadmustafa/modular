@if(session()->has('message'))

    <div class="alert {{session('type')=='error' ? 'alert-danger' : 'alert-primary' }}  alert-dismissible fade show" role="alert">
        <i class="fa fa-exclamation-circle me-2"></i>{{session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
