@extends('backend.master')
@section('title',"Floor")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Floor
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.floor.create')}}"><i class="fa fa-plus"></i>Add Floor</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($floors as $key=>$floor)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$floor->name}}</td>
                        <td>{{$floor->number}}</td>
                        <td>{{$floor->description}}</td>
                        <td><span class="badge {{$floor->status?'badge-success':'badge-danger'}}">{{$floor->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('backend.admin.floor.edit',$floor->id)}}" class="btn btn-tsk"><i class="fa fa-pencil"></i> Edit</a>
                           </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection