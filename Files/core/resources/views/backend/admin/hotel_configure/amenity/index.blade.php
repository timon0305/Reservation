@extends('backend.master')
@section('title',"Amenities")
@section('content')

        <div class="card">
            <div class="card-header bg-white">
                <h2>Amenities
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.amenities.create')}}"><i class="fa fa-plus"></i>  Add Amenities</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($amenities as $amenity)
                    <tr>
                        <td>{{$amenity->name}}</td>
                        <td>{{$amenity->description}}</td>
                        <td><span class="badge {{$amenity->status?'badge-success':'badge-danger'}}">{{$amenity->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('backend.admin.amenities.edit',$amenity->id)}}" class="btn btn-tsk"><i class="fa fa-pencil"></i> Edit</a>
                            </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection