@if (session()->has('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-icon">
                    <i class="fas fa-check"></i>
                </span>
                <span class="alert-text">
                    <strong>
                        {{ session()->get('success') }}!
                    </strong>
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon">
                    <i class="fas fa-time"></i>
                </span>
                <span class="alert-text">
                    <strong>
                        {{ session()->get('error') }}!
                    </strong>
                </span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif