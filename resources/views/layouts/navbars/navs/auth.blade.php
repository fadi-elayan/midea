<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#">{{ $page ?? __('Dashboard') }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="search-bar input-group">
                    <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                        <span class="d-lg-none d-md-block">{{ __('Search') }}</span>
                    </button>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="{{count(\App\User::getNotificationlikeAndCommint(\Illuminate\Support\Facades\Auth::user()->id)) !=0 ?'notification':''}} d-none d-lg-block d-xl-block"></div>
                        <i class="tim-icons icon-sound-wave"></i>
                        <p class="d-lg-none"> {{ __('Notifications') }} </p>
                    </a>
                    @if(count(\App\User::getNotificationlikeAndCommint(\Illuminate\Support\Facades\Auth::user()->id)) != 0)
                    <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                        @foreach(\App\User::getNotificationlikeAndCommint(\Illuminate\Support\Facades\Auth::user()->id) as $notify)
                            @if($notify->type == 'App\Notifications\LikeNotification')
                                <li class="nav-link">

                                    <img src="/image/{{App\User::find(json_decode($notify->data)->user_id)->image->path}}" class="image avatar">
                                    <a href="/show/post/id/{{json_decode($notify->data)->post_id}}" class="nav-item dropdown-item">{{App\User::find(json_decode($notify->data)->user_id)->name  }} like this post</a>
                                </li>
                            @endif
                                @if($notify->type == 'App\Notifications\CommandsNotification')
                                    <li class="nav-link">
                                        <img src="/image/{{App\User::find(json_decode($notify->data)->user_id)->image->path}}" class="image avatar">
                                        <a href="/show/post/id/{{json_decode($notify->data)->post_id}}" class="nav-item dropdown-item">{{App\User::find(json_decode($notify->data)->user_id)->name }} commend this post</a>
                                    </li>
                                @endif
                        @endforeach
                            <li class="nav-link">
                                <a href="/show/notification" class="nav-item dropdown-item active">Show more notification</a>
                            </li>
                    </ul>
                        @endif
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="photo">
                            <img src="/image/{{\App\User::find(\Illuminate\Support\Facades\Auth::user()->id)->image->path}}" class="avatar" alt="{{ __('Profile Photo') }}">
                        </div>
                        <b class="caret d-none d-lg-block d-xl-block"></b>
                        <p class="d-lg-none">{{ __('Log out') }}</p>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                            <a href="{{ route('profile.edit') }}" class="nav-item dropdown-item">{{ __('Profile') }}</a>
                        </li>
                        <li class="nav-link">
                            <a href="#" class="nav-item dropdown-item">{{ __('Settings') }}</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="nav-link">
                            <a href="{{ route('logout') }}" class="nav-item dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="separator d-lg-none"></li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('SEARCH') }}">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
                <a href="#" id="search">
                <button type="button" class="close" style="margin-right:9px">
                   <i class="tim-icons icon-zoom-split"></i>
                </button>
                </a>
            </div>
        </div>
    </div>
</div>

