<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a class="simple-text logo-mini"><i class="tim-icons icon-single-02"></i></a>
            <a href="#" class="simple-text logo-normal">{{ _('User') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('Home') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'notification') class="active " @endif>
                <a href="/show/notification">
                    <i class="tim-icons icon-bell-55" ></i>
                    <p id="notiflike">{{ _('Notification') }} {{count(App\User::find(\Illuminate\Support\Facades\Auth::user()->id)->unreadNotifications)}}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'Friendshiprequests') class="active " @endif>
                <a href="{{route('notify.freind')}}">
                    <i class="tim-icons icon-atom"></i>
                    <p id="notifyFriend">{{ _('Friendship requests') }} {{count(\App\User::getNotification(\Illuminate\Support\Facades\Auth::user()->id))}}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'about') class="active " @endif>
                <a href="{{ route('pages.maps') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ _('About') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="tim-icons icon-alert-circle-exc" ></i>
                    <span class="nav-link-text" >{{ __('My Information') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ _('User Profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('User Management') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
