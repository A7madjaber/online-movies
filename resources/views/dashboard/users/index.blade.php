@extends('layouts.dashboard.app',['title'=>'Users'])
@section('content')

    <h2>users</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">users</li>
        </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="row">




                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" autofocus name="search" class="form-control" placeholder="search" value="{{request()->search}}">
                                </div>
                                </div> <!--end of col4-->



                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" name="role_id">
                                        <option value="">All Roles</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}"{{ request()->role_id == $role->id ?'aside':''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>search</button>

                                    @if(auth()->user()->hasPermission('create_users'))

                                    <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>
                         @else
                                        <a href="#" disabled="" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>

                                    @endif

                            </div><!--end of col4-->






                        </div><!--end col md-->

                    </form><!--end of form  -->

                </div><!--end of col 12-->
            </div><!--end of row-->

            <div class="col-md-12">
                @if($users ->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($users as $index=>$user)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>

                                <td>
                                @foreach($user->roles as $role )
                                          <h5 style="display: inline-block"><span class="badge badge-primary">{{$role->name}}</span></h5>

                                    @endforeach

                                </td>
                                <td>
                                    @if(auth()->user()->hasPermission('update_users'))

                                    <a  class="btn btn-warning btn-sm" href="{{route('dashboard.users.edit',$user->id)}}"><i class="fa fa-edit"></i>Edit</a>

                                    @else
                                        <a class="btn btn-warning btn-sm" href="#" disabled=""><i class="fa fa-edit"></i>Edit</a>

                                    @endif

                                    <form method="post"action="{{route('dashboard.users.destroy',$user->id)}}" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        @if(auth()->user()->hasPermission('delete_users'))

                                        <button  type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i>Delete</button>
                                  @else
                                            <button disabled  type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i>Delete</button>

                                        @endif
                                    </form><!--end form-->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$users->appends(request()->query())->links()}}
                @else
                    <h3 style="font-weight: 300;">Sorry no records found</h3>
            </div>
            @endif

        </div><!--end of tile-->

    </div>
</div>

@stop
