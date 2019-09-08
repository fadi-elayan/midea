@extends('layouts.app', ['page' => __('Notifications'), 'pageSlug' => 'notifications'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notification states</h4>
                </div>
                <div class="card-body">
                    @foreach($notifications as $notification)
                        @if($notification->type == 'App\Notifications\LikeNotification')
                        <div class="alert alert-link">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                            <h4 class="float-right">{{\Carbon\Carbon::now()->diffForHumans($notification->created_at)}}</h4>
                            <span>

                            <a href="/show/post/id/{{json_decode($notification->data)->post_id}}">
                            <div class="image-container">
                              <img src="/image/{{App\User::find((json_decode($notification->data)->user_id))->image->path}}" class="image">
                                 <b>{{App\User::find((json_decode($notification->data)->user_id))->name}} like this post</b>
                            </div>
                            </a>
                        </div>
                        @endif

                                @if($notification->type == 'App\Notifications\CommandsNotification')
                                    <div class="alert alert-link">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                            <span>
                            <a href="/show/post/id{{json_decode($notification->data)->post_id}}">
                            <div class="image-container">
                              <img src="/image/{{App\User::find(\App\Post::find(json_decode($notification->data)->post_id)->user_id)->image->path}}" class="image">
                                 <b>{{App\User::find(\App\Post::find(json_decode($notification->data)->post_id)->user_id)->name}} command this post</b>
                            </div>
                            </a>
                                </div>
                        @endif


                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="pagination">
                        {{$notifications->render()}}
                    </div>
                </div>
            </div>
@endsection
