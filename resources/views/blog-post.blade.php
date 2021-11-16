<x-home-master>
@section('content')

    {{--        <div class="card mb-4">--}}
    <!-- Title -->
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{{$post->body}}</p>
        <hr>

    @if(Auth::check())
        <!-- Comments Form -->
            <div class="card mb-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form method="post" action="{{route('comment.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <label for="body">Body</label>

                            <div class="form-group">
                                <textarea name="body" class="form-control" id="body" cols="30" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>

                    </form>

                    {{--                 {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\PostCommentController@store']) !!}--}}
                    {{--                   <div class="form-group">--}}
                    {{--                        {!! Form::label('body', 'Body:') !!}--}}
                    {{--                        {!! Form::textarea('body', null, ['class' => 'form-control','rows'=>3]) !!}--}}
                    {{--                   </div>--}}

                    {{--                   <div class="form-group">--}}
                    {{--                        {!! Form::submit('Submit Comment', ['class' => 'btn btn-primary']) !!}--}}
                    {{--                   </div>--}}
                    {{--                   {!! Form::close() !!}--}}
                    {{--                </div>--}}
                    {{--                <div class="card-body">--}}
                    {{--                    <form>--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <textarea class="form-control" rows="3"></textarea>--}}
                    {{--                        </div>--}}
                    {{--                        <button type="submit" class="btn btn-primary">Submit</button>--}}
                    {{--                    </form>--}}
                    {{--                </div>--}}
                </div>

                <!-- Single Comment -->
                @if(count($comments) > 0)
                    @foreach($comments as $comment )
                        {{--                    @foreach($comment->replies()->get() as $reply)--}}
                        <div class="media mb-4">
                            <img class="d-flex mr-3 rounded-circle" src="{{$comment->photo}}" height="45" width="55"
                                 alt="">
                            <div class="media-body">
                                <h5 class="mt-0">{{$comment->author}} <small
                                        class="text-gray-500">{{$comment->created_at->diffForHumans()}}</small></h5>

                                {{$comment->body}}
                                {{--                                <button type="submit" class="toggle-reply float-right btn btn-secondary">Reply</button>--}}
                                <div class="reply-container">


                                    <div>

                                        @if(count($comment->replies) > 0)
                                            <button type="submit" id="toggle-reply"
                                                    class="toggle-reply float-right btn btn-secondary">
                                                Replies</button>



                                            @foreach($comment-> replies as $reply)
                                                @if($reply->is_active == 1 )


                                                    <div class="comment-reply-container" >

                                                    <div class="media mt-4">
                                                        <img class="d-flex mr-3 rounded-circle"
                                                             src="{{$reply->photo}}"
                                                             height="45" width="55" alt="">
                                                        <div class="media-body">
                                                            <h5 class="mt-0">{{$reply->author}} <small
                                                                    class="text-gray-500">{{$reply->created_at->diffForHumans()}}</small>
                                                            </h5>
                                                            {{$reply->body}}
                                                        </div>


                                                    </div>
                                                </div>
                                                @endif

                                            @endforeach



                                        @endif
                                    </div>
                                    <div class="col-sm-8">
                                        <form method="post" action="{{route('reply.store')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="comment_id" value="{{$comment->id}}">


                                                <div class="form-group">
                                                    <textarea name="body" class="form-control" id="body"
                                                              rows=1></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">submit</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{--                    @endforeach--}}
                    @endforeach
                @endif

            <!-- Comment with nested comments -->


                @endif
            </div>
            {{--        </div>--}}
    @endsection

</x-home-master>

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $('.toggle-reply').click(function () {

        $('.comment-reply-container').slideToggle("slow");

    });

</script>
