<x-admin-master>
    @section('content')
        <h1>All Comments</h1>
        @if(session('comment_delete'))
            {{--        <div class="alert alert-danger">{{Session::get('message')}}</div>--}}
            <div class="alert alert-danger">{{session('comment_delete')}}</div>
        @endif
        {{--        @if(session('message'))--}}
        {{--            --}}{{--        <div class="alert alert-danger">{{Session::get('message')}}</div>--}}
        {{--            <div class="alert alert-danger">{{session('message')}}</div>--}}
        {{--        @elseif(session('post-created'))--}}
        {{--            <div class="alert alert-success">{{session('post-created')}}</div>--}}
        {{--        @elseif(session('post-updated'))--}}
        {{--            <div class="alert alert-info">{{session('post-updated')}}</div>--}}
        {{--        @endif--}}


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>

                                <th>Id</th>
                                <th>Post</th>
                                <th>Replies</th>
                                <th>Owner</th>
                                <th>Email</th>
                                <th>Body</th>
                                <th>Created Time</th>
                                <th>Last Update</th>
                                <th>approval</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>

                                <th>Id</th>
                                <th>Post</th>
                                <th>Replies</th>
                                <th>Owner</th>
                                <th>Email</th>
                                <th>Body</th>
                                <th>Created Time</th>
                                <th>Last Update</th>
                                <th>approval</th>
                                <th>Delete</th>

                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->id}}</td>
                                    <td><a href="{{route('post',$comment->post->slug)}}">view post</a></td>
                                    <td><a href="{{route('reply.show',$comment->id)}}">view replies</a></td>
                                    <td>{{$comment->author}}</td>
                                    <td>{{$comment->email}}</td>
                                    <td> {{$comment->body}}</td>

                                    <td>{{$comment->created_at->diffForHumans()}}</td>
                                    <td>{{$comment->updated_at->diffForHumans()}}</td>

                                    <td>
                                        {{--                                    @can('view', $post)--}}
                                        @if($comment->is_active == 1)
                                            <form method="post" action="{{route('comment.update',$comment->id)}}"
                                                  enctype="multipart/form-data">
                                                @csrf
{{--                                                {{method_field('PATCH')}}--}}
                                                @method('PATCH')
                                                <input type="hidden" name="is_active" value="0">
                                                <button type="submit" class="btn btn-success">un-approve</button>
                                            </form>
                                        @else
                                            <form method="post" action="{{route('comment.update',$comment->id)}}"
                                                  enctype="multipart/form-data">
                                                @csrf
{{--                                                --}}
                                                @method('PATCH')
                                                <input type="hidden" name="is_active" value="1">
                                                <button type="submit" class="btn btn-info">approve</button>
                                            </form>


                                        @endif
                                    </td>
                                    <td>

                                        <form method="post" action="{{route('comment.delete',$comment->id)}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>


                                    </td>
                                    {{--                                    @endcan--}}


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{--        <div class="d-flex">--}}
            {{--            <div class="mx-auto">--}}
            {{--                {{$posts->links()}}--}}
            {{--            </div>--}}
            {{--        </div>--}}


    @endsection
    @section('scripts')
    <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        {{--        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}

    @endsection
</x-admin-master>
