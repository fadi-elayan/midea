@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">

        <div class="col-md-8">
            @include('alerts.success')
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Edit Profile') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ _('Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ _('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Password') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @include('alerts.success', ['key' => 'password_status'])
                        @method('put')
                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Change password') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ _('Information') }}</h5>
                </div>
                <form method="post" action="/user/information" autocomplete="off" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @include('alerts.success', ['information' => 'password_status'])

                        <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
                            <label>{{ __('City') }}</label>
                            <input type="text" name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder="{{ __('city') }}" value="{{\Illuminate\Support\Facades\Auth::user()->information->city}}">
                            @include('alerts.feedback', ['field' => 'city'])
                        </div>

                        <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                            <label>{{ __('Country') }}</label>
                            <input type="text" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ __('country') }}" value="{{\Illuminate\Support\Facades\Auth::user()->information->country}}" required>
                            @include('alerts.feedback', ['field' => 'country'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Barth Date') }}</label>
                            <input type="date" name="Barth_date" class="form-control"  value="" required>
                            @include('alerts.feedback', ['field' => 'Barth_date'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('image') }}</label>
                            <input type="file" name="file" class="form-control"  value="" required>
                            @include('alerts.feedback', ['field' => 'file'])
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ _('Change') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="/image/{{\Illuminate\Support\Facades\Auth::user()->image->path}}" alt="">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>

                        </div>
                    </p>
                    <!--<div class="card-description">

                    </div>-->
                </div>
               <!-- <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>-->
                </div>
            </div>
        <div class="col-md-8">

            @foreach($posts as $post)
            <div class="card">
                <div class="card-header">
                    <a href="{{route('post.delete',$post->id)}}"><i class="tim-icons icon-simple-remove float-right"></i></a>
                    <h5 class="title">{{ _('Post') }}</h5>
                </div>
                <div class="card-body">
                    <h3>{{$post->post}}</h3>
                    <div class="row">
                    @foreach(\App\Post::find($post->id)->image as $image)
                        <div class="col-xl-6 col-sm-6 col-lg-6">
                        <a> <img class="image image-responsive" src="/image/{{$image->path}}" alt=""></a>
                        </div>
                        @endforeach
                    </div>
                </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xl-12-6 col-sm-6 col-lg-6">
                                 <a href="#" onclick="fun({{$i}} , {{$post->id}} , {{sizeof(\App\Post::find($post->id)->like)}})"><i class="tim-icons icon-heart-2" style="{{(\App\Like::isMyLike($post->id ,\Illuminate\Support\Facades\Auth::user()->id)) == 0?'color:#e14eca;':''}}" id="like{{$i}}">{{sizeof(\App\Post::find($post->id)->like)}}</i></a>
                            </div>
                            <div class="col-xl-12-6 col-sm-6 col-lg-6">
                                <a href="#"><i class="tim-icons icon-paper" id="com{{$i}}">{{sizeof(\App\Post::find($post->id)->command)}}</i></a>
                            </div>
                        </div>
                        <h5 class="title float-right">{{Carbon\Carbon::now()->diffForHumans($post->created_at)}}</h5>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Commands</h4>
                                </div>
                                <div class="card-body" id="bod{{$i}}">
                                    @foreach(\App\Post::find($post->id)->command as $command)
                                    <div class="alert alert-info alert-with-icon" data-notify="container">
                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                            @if(\Illuminate\Support\Facades\Auth::user()->id == $command->user_id)
                                                <a href="#" onclick="funDeleteCommand({{$command->id}} , {{$post->id}} ,{{$i}})"><i class="tim-icons icon-simple-remove"></i></a>
                                            @endif
                                        </button>

                                            <div class="col-xl-5 col-sm-5 col-lg-5 image-container">
                                               <img class="img-row avatar" src="http://midea.dev/black/img/anime3.png">
                                            </div>
                                            <div class="col-xl-7 col-sm-7 col-lg-7">
                                              <span data-notify="message">{{$command->command}}</span>
                                              </div>
                                    </div>
                                        @endforeach

                                </div>
                                <div class="card-footer">
                                    <div class="card-body">
                                        <div class="form-group{{ $errors->has('command') ? ' has-danger' : '' }}">
                                            <textarea type="text" name="command" id="commands{{$i}}" class="form-control{{ $errors->has('command') ? ' is-invalid' : '' }}" placeholder="{{ _('command') }}" value="{{ old('command') }}"></textarea>
                                            @include('alerts.feedback', ['field' => 'name'])
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button  class="btn btn-fill btn-primary" onclick="funCommand({{$i++}} , {{$post->id}})">{{ _('Upload') }}</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        </div>
<script>

    function funDeleteCommand(id , post_id , index) {
        $.ajax({
            url:"/user/post/command/delete/"+id,
            type: 'GET',
            data:{post_id:post_id},
            success:function (data) {
                $('#com' + index).html(data['size']);
                $("#com" + index).attr('style', 'color:#e14eca');
            }
        });
    }
    function funCommand(index , id) {
        var command = $('#commands'+index).val();
          var id1 = id;
          $.ajax({
              url: "/user/post/command/"+id,
              type: 'GET',
              data:{command:command , id:id1},
              success:function (data) {
                  var s = ' <div class="alert alert-info alert-with-icon" data-notify="container">\n' +
                      '                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">\n' +
                      '                                                <a href="#" onclick="funDeleteCommand('+data['id']+','+data['post_id']+','+index+')"><i class="tim-icons icon-simple-remove"></i></a>\n' +
                      '                                        </button>\n' +
                      '\n' +
                      '                                            <div class="col-xl-5 col-sm-5 col-lg-5 image-container">\n' +
                      '                                               <img class="img-row avatar" src="http://midea.dev/black/img/anime3.png">\n' +
                      '                                            </div>\n' +
                      '                                            <div class="col-xl-7 col-sm-7 col-lg-7">\n' +
                      '                                              <span data-notify="message">'+data['command']+'</span>\n' +
                      '                                              </div>\n' +
                      '                                    </div>'
                  document.getElementById('bod'+index).innerHTML +=s;
                  $('#com' + index).html(data['size']);
                  $("#com" + index).attr('style', 'color:#e14eca');
                  console.log(data);
          }
        });

    }
    function fun(index , id , size) {
        $.ajax({
            url: "/user/post/like/"+id,
            type: 'GET',
            data:{id:id},
            processData:false,
            contentType:false,
            success: function (data) {
               if(size < data['size']) {
                   $('#like' + index).html(data['size']);
                   $("#like" + index).attr('style', 'color:#e14eca');
               }else{
                   $('#like' + index).html(data['size']);
                   $("#like" + index).attr('style', 'color:#ba54f5');
               }
            }
        });
    }
</script>

@endsection
