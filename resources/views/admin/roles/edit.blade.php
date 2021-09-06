<x-admin-master>
    @section('content')
        <h1>Role is: {{$role->name}}</h1>
        @if(session()->has('role-update'))
            <div class="alert alert-success">{{session('role-update')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <form method="post" action="{{route('roles.update', $role->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{$role->name}}"
                               class="form-control @error('name')is-invalid @enderror">
                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($permissions->isNotEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>


                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Options</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Attach</th>
                                        <th>Detach</th>

                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td><input type="checkbox"
                                                       @foreach ($role->permissions as $role_permission)
                                                       @if($role_permission->slug == $permission->slug)
                                                       checked
                                                    @endif
                                                    @endforeach

                                                ></td>
                                            <td>{{$permission->id}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->slug}}</td>
                                            <td>
                                                <form method="post" action="{{route('role.permission.attach',$role)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{$permission->id}}">

                                                    <button class="btn btn-primary"
                                                            @if($role->permissions->contains($permission))
                                                            disabled
                                                        @endif>Attach
                                                    </button>

                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="{{route('role.permission.detach',$role)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{$permission->id}}">

                                                    <button class="btn btn-dark"
                                                            @if(!$role->permissions->contains($permission))
                                                            disabled
                                                        @endif>Detach
                                                    </button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endsection


</x-admin-master>
