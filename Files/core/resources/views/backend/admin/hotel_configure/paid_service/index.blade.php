@extends('backend.master')
@section('title',"Paid Service")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Paid Service
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.paid_service.create')}}"><i class="fa fa-plus"></i> Add Paid Service</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paid_services as $key=>$paid_service)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><i class="fa fa-{{$paid_service->icon}}"></i> </td>
                        <td>{{$paid_service->title}}</td>
                        <td>{{number_format($paid_service->price,2)}} {{general_setting()->cur}}</td>
                        <td><span class="badge {{$paid_service->status?'badge-success':'badge-danger'}}">{{$paid_service->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('backend.admin.paid_service.edit',$paid_service->id)}}" class="btn btn-tsk"><i class="fa fa-pencil"></i> edit</a>

                            </div>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection