@extends('layouts.dashboard.app',['title'=>'Create User'])
@section('content')
    <h2>Create users</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('dashboard.users.index')}}">users</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form action="{{route('dashboard.users.store')}}" method="post">
                @csrf
                @method('post')

                @include('dashboard.partials.errors')

                <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <label>Email : </label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                </div>

                <div class="form-group">
                    <label>Password : </label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password Confirmation: </label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group">
                    <label>Roles : </label>
                    <select name="role_id" class="form-control">
                        @foreach($roles as $role)
                      <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                    </select>
                <a href="{{route('dashboard.roles.create')}}">Create New Role</a>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add</button>
                </div>

            </form>
        </div><!--end of tile-->

    </div>
</div>











@stop
