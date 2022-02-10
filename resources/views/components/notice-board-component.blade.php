<div class="row">
    <div class="col-md-12">
        <div class="activity">
            <div class="activity-box">
                <ul class="activity-list">
                    @forelse ($notices as $notice)
                        <li>
                            <div class="activity-user">
                                <a href="#" title="" data-toggle="tooltip" class="avatar">
                                    <img src="{{ asset('assets/img/notice.png') }}" alt="">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content" style="color:black">
                                    {{ $notice->details }}
                                    <span class="time">{{ $notice->created_at->diffForHumans() }}</span>
                                    @php
                                        if ($notice->priority == 'high') {
                                            $class = 'bx-flashing badge-danger';
                                        } elseif ($notice->priority == 'medium') {
                                            $class = 'badge-warning';
                                        } else {
                                            $class = 'badge-success';
                                        }
                                    @endphp
                                    <span class="badge {{ $class }}">{{ $notice->priority }}</span>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <h3 class="text-center">No notices found.</h3>
                                </div>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
