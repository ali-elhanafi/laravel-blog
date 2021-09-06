<x-admin-master>
    @section('content')
        <h1>create</h1>
        {{--         {!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\PostsController@store']) !!}--}}
        {{--    @csrf--}}
        {{--           <div class="form-group">--}}
        {{--                {!! Form::label('title', 'Title') !!}--}}
        {{--                {!! Form::text('title', null, ['class' => 'form-control']) !!}--}}
        {{--           </div>--}}

        {{--           <div class="form-group">--}}
        {{--                {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}--}}
        {{--           </div>--}}
        {{--           {!! Form::close() !!}--}}
        <form method="post"  action="{{route('post.update',$post->id)}}" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title </label>
                <input type="text"
                       name="title"
                       class="form-control"
                       id="title"
                       aria-describedby=""
                       placeholder="enter title"
                       value="{{$post->title}}"
                >
            </div>
            <div class="form-group">

                <label for="file">File </label>
                <div><img height="140px" src="{{$post->post_image}}" alt=""></div>
                <input type="file"
                       name="post_image"
                       class="form-control-file"
                       id="post_image">
            </div>
            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="10">value="{{$post->body}}"</textarea>
            </div>
            <button type="submit" class="btn btn-primary">submit</button>


        </form>
    @endsection
</x-admin-master>
