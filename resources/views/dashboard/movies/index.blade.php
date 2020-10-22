@extends('layouts.dashboard.app',['title'=>'Movies'])
@section('content')

    <h2>Movies</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Movies</li>
        </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">
            <div class="row">
                <div class="col-12">
                    <form>
                        <div class="row">


                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" autofocus name="search" class="form-control" placeholder="search by : name,description,year,rating" value="{{request()->search}}">
                                </div>
                            </div> <!--end of col4-->

                            <div class="col-4">
                                <div class="form-group">
                                    <select name="category" class="form-control"><option value="">All Categories</option>

                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"{{request()->category == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> <!--end of col4-->

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>search</button>
                                <a href="{{route('dashboard.movies.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>
                            </div><!--end of col4-->

                        </div><!--end of row-->

                    </form><!--end of form  -->

                </div><!--end of col 12-->
            </div><!--end of row-->

            <div class="col-md-12">
                @if($movies ->count()>0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="">#</th>
                            <th style="width: 14%">Name</th>
                            <th>Description</th>
                            <th style="width: 18%">Category</th>
                            <th>Year</th>
                            <th>Rating</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($movies as $index=>$movie)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$movie->name}}</td>
                                <td>{{str_limit($movie->description,20)}}</td>

                                <td>
                                    @foreach($movie->categories as $category)
                                        <h5 style="display: inline-block"><span class="badge badge-primary">{{$category->name}}</span></h5>
                                    @endforeach
                                </td>

                                </td>
                                <td>{{$movie->year}}</td>
                                <td>{{$movie->rating}}</td>


                                <td><a  class="btn btn-warning btn-sm" href="{{route('dashboard.movies.edit',$movie->id)}}"><i class="fa fa-edit"></i>Edit</a>
                                    <form method="post"action="{{route('dashboard.movies.destroy',$movie->id)}}" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button  type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i>Delete</button>
                                    </form><!--end form-->
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$movies->appends(request()->query())->links()}}
                @else
                    <h3 style="font-weight: 300;">Sorry no records found</h3>
            </div>
            @endif

        </div><!--end of tile-->

    </div>
</div>

@stop
