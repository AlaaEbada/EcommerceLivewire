<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>

    <ul class="nav">

        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2 position-relative notifications-icon" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fs-3" style="font-size: 25px;"></span>
                <span id="notificationsIconCounter" class="badge bg-danger rounded-pill text-white position-absolute top-0 start-100 translate-middle p-1 fs-7">
                    {{-- {{Auth::guard('admin')->user()->notifications()->unread()->count()}} --}}
                </span>
            </a>


        </li>

        {{-- Notification Modal --}}
        <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog"
            aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="notificationsModal">
                        {{-- <div class="list-group list-group-flush my-n3">
                            @if (Auth::guard('admin')->user()->notifications()->count() > 0)

                            @foreach (Auth::guard('admin')->user()->notifications()->take(4)->get() as $notification)

                            <div class="list-group-item {{ $notification->read_at == null ? 'bg-light' : 'bg-transparent' }}">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="fe fe-box fe-24"></span>
                                    </div>
                                    <div class="col">
                                        <small><strong> New User Registered</strong></small>
                                        <div class="my-0 text-muted small">{{$notification->data['message']}}</div>
                                        <small class="badge badge-pill badge-light text-muted">{{$notification->created_at->diffForHumans()}}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @else

                            <div class="my-0 text-muted small"> No Notifications Yet</div>

                            @endif

                        </div> <!-- / .list-group --> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="clearNotifications" class="btn btn-secondary btn-block" data-dismiss="modal">Clear
                            All</button>
                    </div>
                </div>
            </div>
        </div>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('assets') }}/images/avatar.png" alt="Profile image"
                        class="avatar-img rounded-circle">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                <form action="{{ route('admin.logout') }}" method="POST" class="dropdown-item">
                    @csrf
                    <button type="submit" class=" w-full m-x-0 border-0 bg-transparent p-0 text-danger">
                        <span key="t-logout">{{ __('Logout') }}</span>
                    </button>
                </form>

            </div>
        </li>

    </ul>
</nav>
