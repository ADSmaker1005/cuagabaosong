<div class="header-bg">
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">

                <!-- Logo container-->
                <div class="logo">
                    <!-- Text Logo -->
                    <a href="{{ route('admin.dashboard') }}" class="logo">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                    <!-- Image Logo -->
                    <!-- <a href="index.html" class="logo">
                        <img src="assets/images/logo-sm.png" alt="" height="22" class="logo-small">
                        <img src="assets/images/logo.png" alt="" height="24" class="logo-large">
                    </a> -->

                </div>
                <!-- End Logo container-->


                <div class="menu-extras topbar-custom">

                    <ul class="list-inline float-right mb-0">

                        <!-- notification-->
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                                <i class="ti-bell noti-icon"></i>
                                <span class="badge badge-info badge-pill noti-icon-badge">3</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5>Notification (3)</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                    <p class="notify-details"><b>Your order is placed</b><small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                    <p class="notify-details"><b>New Message received</b><small class="text-muted">You have 87 unread messages</small></p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
                                    <p class="notify-details"><b>Your item is shipped</b><small class="text-muted">It is a long established fact that a reader will</small></p>
                                </a>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    View All
                                </a>

                            </div>
                        </li>
                        <!-- User-->
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <table>
                                <tr>
                                    <td>
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-circle">
                                    </td>
                                    <td>
                                        <span class="ml-1">{{ Auth::user()->name }}<i class="mdi mdi-chevron-down"></i> </span>
                                    </td>
                                </tr>
                            </table>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <x-jet-responsive-nav-link class="dropdown-item" href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    <i class="dripicons-user text-muted"></i>{{ Auth::user()->email }}
                                </x-jet-responsive-nav-link>
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-responsive-nav-link class="dropdown-item" href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                        <i class="dripicons-wallet text-muted"></i>{{ __('API Tokens') }}
                                    </x-jet-responsive-nav-link>
                                @endif
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div>{{ __('Manage Team') }}</div>
                                    <x-jet-responsive-nav-link class="dropdown-item" href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                        <span class="badge badge-success pull-right m-t-5">5</span><i class="dripicons-gear text-muted"></i>{{ __('Team Settings') }}
                                    </x-jet-responsive-nav-link>

                                    <x-jet-responsive-nav-link class="dropdown-item" href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                        <i class="dripicons-lock text-muted"></i>{{ __('Create New Team') }}
                                    </x-jet-responsive-nav-link>
                                    <div>{{ __('Switch Teams') }}</div>
                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team class="dropdown-item" :team="$team" component="jet-responsive-nav-link" />
                                    @endforeach
                                @endif
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-responsive-nav-link class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                        <i class="dripicons-exit text-muted"></i>{{ __('Logout') }}
                                    </x-jet-responsive-nav-link>
                                </form>
                            </div>
                        </li>
                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                    </ul>
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->
    </header>
    <!-- End Navig
</div>
