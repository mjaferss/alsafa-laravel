@props([
    'title',
    'value',
    'icon',
    'color',
    'route' => null
])

<div class="col-12 col-sm-6 col-xl-3">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div class="d-flex align-items-center">
                    <div class="fs-4 me-2"><i class="fas fa-{{ $icon }} text-{{ $color }}"></i></div>
                    <h6 class="card-title mb-0">{{ $title }}</h6>
                </div>
                @if($route)
                <div class="dropdown">
                    <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ $route }}">{{ __('common.view_all') }}</a></li>
                    </ul>
                </div>
                @endif
            </div>
            <h2 class="mb-0">{{ $value }}</h2>
        </div>
    </div>
</div>
