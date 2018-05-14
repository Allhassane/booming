@if(session('success'))
    <div class="myAlert alert alert-success">
        <i class="fa fa-check-circle-o"></i> {{ session('success') }}
    </div>
@elseif(session('warning'))
    <div class="myAlert alert alert-warning">
        <i class="fa fa-exclamation-triangle"></i> {{ session('warning') }}
    </div>
@elseif(session('danger'))
    <div class="myAlert alert alert-danger">
        <i class="fa fa-close"></i> {{ session('danger') }}
    </div>
@elseif(session('info'))
    <div class="myAlert alert alert-info">
        <i class="fa fa-info"></i> {{ session('info') }}
    </div>
@endif