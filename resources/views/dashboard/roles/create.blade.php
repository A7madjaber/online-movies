@extends('layouts.dashboard.app',['title'=>'Create role'])
@section('content')
    <h2>Create Roles</h2>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('dashboard.roles.index')}}">Roles</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ul>

<div class="row">
    <div class="col-md-12">
        <div class="tile mb-4">

            <form action="{{route('dashboard.roles.store')}}" method="post">
                @csrf
                @method('post')

                @include('dashboard.partials.errors')

                <div class="form-group">
                    <label>Name : </label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                </div>

                <div class="form-group">
                    <h4 style="font-weight:400">Permissions</h4>
                    <table class="table table-hover">

                        <thead>

                        <tr>

                            <th style="width: 5%">#</th>
                            <th style="width: 15%">Model</th>
                            <th>Permissions </th>
                        </tr>
                        </thead>

                        <tbody>

                        @php
                            $models=['categories','users','movies','settings'];
                        @endphp
                        <tr>
                            @foreach($models as $index=> $model)
                                <td>{{$index+1}}</td>
                                <td class="text-capitalize">{{$model}}</td>
                                <td>
                                    @php

                                        $Permissions_maps=['create','read','update','delete'];
                                    @endphp

                                    @if($model=='settings')
                                        @php

                                            $Permissions_maps=['create','read',];
                                        @endphp
                                    @endif

                                    <select name="permissions[]" class="form-control select2" multiple>

                                        @foreach($Permissions_maps as $Permission_map)
                                            <option value="{{$Permission_map . '_' . $model}}">{{$Permission_map}}</option>
                                        @endforeach
                                    </select>

                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>Add</button>
                </div>

            </form>
        </div><!--end of tile-->

    </div>
</div>











@stop
