@extends('layouts.dashboard.app',['title'=>'Create Category'])
@section('content')
    <h2>Create Category</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ul>


<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form action="{{route('dashboard.categories.store')}}" method="post">
                @csrf
                @method('post')

                @include('dashboard.partials.errors')

                <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add</button>
                </div>

            </form>
        </div><!--end of tile-->

    </div>
</div>











@stop
