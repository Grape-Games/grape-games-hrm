<div class="row">
    <div class="col-md-12">
        <div class="activity">
            <div class="activity-box">
                <ul class="activity-list">
                    @forelse ($notifications as $notification)
                        <li>
                            <div class="activity-user">
                                <a href="#" title="" data-toggle="tooltip" class="avatar">
                                    <img src="{{ $notification->data['avatar'] }}" alt="">
                                </a>
                            </div>
                            <div class="activity-content">
                                <div class="timeline-content" style="color:black">
                                    {{ $notification->data['details'] }}
                                    <span
                                        class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li>
                            <div class="activity-content">
                                <div class="timeline-content">
                                    <h3 class="text-center">No activities history.</h3>
                                </div>
                            </div>
                        </li>
                    @endforelse

                </ul>
            </div>
        </div>
    </div>
</div>
