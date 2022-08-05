@push('extended-css')
    <link rel="stylesheet" href="{{ asset('css/tick.css') }}">
@endpush
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
        {{-- <div class="badge badge-success float-right">
            Next Attendance update in : <span id="attendanceUpdate"></span>
            <i class="fas fa-sync fa-spin ml-2"></i>
        </div> --}}
        @if ($modal == true)
            <div class="col-auto float-right ml-auto" style="margin-top:30px">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#{{ $modalId }}">
                    <i class="fa fa-plus"></i> Add {{ $modalType }}</a>
            </div>
        @endif
        @if ($showClock == 'true')
            <div class="row col-12">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="tick" data-did-init="handleTickInit">
                        <div data-repeat="true" data-layout="horizontal fit"
                            data-transform="preset(d, h, m, s) -> delay">
                            <div class="tick-group">
                                <div data-key="value" data-repeat="true" data-transform="pad(00) -> split -> delay">
                                    <span data-view="flip"></span>
                                </div>
                                <span data-key="label" data-view="text" class="tick-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@if ($showClock == 'true')
    <div class="col-md-12 text-center">
        <p class="mr-3" style="display:inline-block;">Till next attendance update</p>
        <i class="fas fa-sync fa-spin"></i>
    </div>
@endif
<!-- /Page Header -->

@push('extended-js')
    <script src="{{ asset('js/extensions/tick/tick.js') }}"></script>
@endpush
