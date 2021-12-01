<x-admin-master>
    @section('content')
        <h1>Roles</h1>
        <div class="row">
            @if(session()->has('role-delete'))
                <div class="alert alert-danger">{{session('role-delete')}}</div>
            @endif
        </div>
        <div class="row">

            <div class="col-sm-3">
                <form method="post" action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name')is-invalid @enderror">
                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Submit</button>
                </form>
            </div>
            <form method="POST" action="{{route('role.bulk')}}" class="form-inline" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <select name="checkboxArray" class="form-control" id="">
                        <option value="post">Delete</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-primary">
                </div>


                <div class="col-sm-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="options"></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>


                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th><input type="hidden"></th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Delete</th>


                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td><input class="checkboxes" type="checkbox" name="checkboxArray[]"
                                                       value="{{$role->id}}"></td>

                                            <td>{{$role->id}}</td>
                                            <td><a href="{{route('roles.edit',$role->id)}}">{{$role->name}}</a></td>
                                            <td>{{$role->slug}}</td>
                                            <td>
                                                <form method="post" action="{{route('roles.destroy',[$role] )}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    @endsection


</x-admin-master>
<script>
    $(document).ready(function (){
        $('#options').click(function (){
            if(this.checked){
                $('.checkboxes').each(function (){
                    this.checked = true;
                })
            }else {
                $('.checkboxes').each(function (){
                    this.checked = false;
                })
            }
        })
    })

</script>
