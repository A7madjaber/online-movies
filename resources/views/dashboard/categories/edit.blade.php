@extends('layouts.dashboard.app',['title'=>'Edit Category'])
@section('content')
    <h2>Edit Category</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ul>


<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form action="{{route('dashboard.categories.update',$category->id)}}" method="post">
                @csrf
                @method('put')

                @include('dashboard.partials.errors')

                <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" class="form-control"value="{{old('name',$category->name)}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>Edit</button>
                </div>

            </form>
        </div><!--end of tile-->

    </div>
</div>











@stop
