@extends('backend.master')
@section('title',"Tax")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Tax
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.tax.create')}}"><i class="fa fa-plus"></i>Add Tax</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Rate</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taxes as $key=>$tax)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$tax->name}}</td>
                        <td>{{$tax->code}}</td>
                        <td>{{$tax->type}}</td>
                        <td>{{$tax->rate}}</td>
                        <td><span class="badge {{$tax->status?'badge-success':'badge-danger'}}">{{$tax->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('backend.admin.tax.edit',$tax->id)}}" class="btn btn-tsk"><i class="fa fa-pencil"></i> Edit</a>
                           </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection