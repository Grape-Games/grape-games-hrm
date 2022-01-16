<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <?php $segments = ''; ?>
                @foreach (Request::segments() as $segment)
                    <?php $segments .= '/' . $segment; ?>
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                        <a class="text-capitalize {{ $loop->last ? '' : 'text-muted' }}"
                            href="{{ $segments }}">{{ $segment }}</a>
                    </li>
                @endforeach
            </ul>
            <h3 class="page-title card-title breadcrumb-card-head text-capitalize">
                {{ collect(request()->segments())->last() }}</h3>
        </div>
        @if ($modal == true)
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#{{ $modalId }}"><i
                        class="fa fa-plus"></i> Add {{ $modalType }}</a>
            </div>
        @endif
    </div>
</div>
<!-- /Page Header -->
