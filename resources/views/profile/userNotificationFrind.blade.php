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
                    <div class="alert alert-link">
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                        <span>
                            <a href="/user/search/id/{{json_decode($notification->data)->frind_id}}">
                            <div class="image-container">
                              <img src="/image/{{\App\User::find(json_decode($notification->data)->frind_id)->image->path}}" class="image">
                                 <b>{{\App\User::find(json_decode($notification->data)->frind_id)->name}}</b>
                            </div>
                            </a>
                                 <b><a href="{{route('user.acceptfrindRequest' ,$notification->id)}}"><button class="btn btn-success">Confirem</button></a></b><b><a href="{{'user.rejectfrindRequest' , $notification->id}}"><button class="btn btn-danger">Delete</button></a></b></span>


                    </div>
                    @endforeach
            </div>
                <div class="card-footer">
                    <div class="pagination">
                        {{$notifications->render()}}
                    </div>
                </div>
        </div>
@endsection
