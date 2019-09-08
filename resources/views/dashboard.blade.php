@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
    <div class="row">
        <div class="col-12">
            @include('alerts.success')
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Post</h5>
                            <h2 class="card-title">Create Post</h2>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('post.create')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('post') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <textarea type="text" name="post" id="input-name" class="form-control form-control-alternative{{ $errors->has('post') ? ' is-invalid' : '' }}" placeholder="{{ __('Post') }}" value="{{ old('post') }}"  autofocus></textarea>
                                @include('alerts.feedback', ['field' => 'post'])
                            </div>

                            <div class="form-group">
                                <label class="form-control-label" for="input-password-confirmation">{{ __('File') }}</label>
                                <input type="file" name="files[]"  class="form-control"  multiple = 'multiple'>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-12">
     @foreach($posts as $post)
            <div class="card">
                <div class="card-header">
                    <a href="/user/search/id/{{$post->user_id}}">
                    <img src="/image/{{App\User::find($post->user_id)->image->path}}" class="avatar">
                    <i class="title">{{App\User::find($post->user_id)->name}}</i>
                    </a>
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
        <div class="pagination">
            {{$posts->render()}}
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

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
    </script>
@endpush
