<!-- Notifications -->
<li class="nav-item dropdown mr-2 ml-2">
    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
        <i class="fas fa-bell bx-tada"></i>
        <span class="badge badge-pill">{{ $notifications->where('read_at', null)->count() }}</span>
    </a>
    <div class="dropdown-menu notifications">
        <div class="topnav-dropdown-header">
            <span class="notification-title">Notifications</span>
            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
        </div>
        <div class="noti-content">
            <ul class="notification-list">
                @forelse ($notifications as $notification)
                    <li class="notification-message" @if ($notification->read_at == null) style="background-color: lightgoldenrodyellow;" @endif>
                        <a href="{{ $notification->data['redirect'] }}">
                            <div class="media">
                                <span class="avatar">
                                    <img alt="" src="{{ asset($notification->data['avatar']) }}">
                                </span>
                                <div class="media-body">
                                    <p class="noti-title" style="margin-bottom: 0px">
                                        {{ $notification->data['heading'] }}
                                        @if ($notification->read_at == null)
                                            <span class="badge badge-success bx-flashing">
                                                Unread </span>
                                        @endif
                                    </p>
                                    <p class="noti-details">
                                        {{ $notification->data['details'] }}
                                    </p>
                                    <p class="noti-time"><span class="notification-time">
                                            {{ $notification->created_at }}</span></p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <hr style="margin-top:0px">
                @empty
                    <p class="text-center mt-4"><strong>No Notifications Found</strong></p>
                @endforelse
            </ul>
        </div>
        <div class="topnav-dropdown-footer">
            <a href="{{ route('dashboard.activites') }}">View all Notifications</a>
        </div>
    </div>
</li>
<!-- /Notifications -->
