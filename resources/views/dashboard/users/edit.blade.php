@extends('layouts.dashboard.app',['title'=>'Edit User'])
@section('content')
    <h2>Edit users</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('dashboard.users.index')}}">users</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form action="{{route('dashboard.users.update',$User->id)}}" method="post">
                @csrf
                @method('put')

                @include('dashboard.partials.errors')

                <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" class="form-control" value="{{old('name',$User->name)}}">
                </div>

                <div class="form-group">
                    <label>Email : </label>
                    <input type="email" name="email" class="form-control" value="{{old('email',$User->email)}}">
                </div>



                <div class="form-group">
                    <label>Roles : </label>
                    <select name="role_id" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{ $User->hasRole($role->name)? 'selected':'' }}>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Edit</button>
                </div>

            </form>
        </div><!--end of tile-->

    </div>
</div>






@stop
