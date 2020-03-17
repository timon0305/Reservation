@extends('backend.master')
@section('title',"Staff")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Staff
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.staff.create')}}"><i class="fa fa-plus"></i> Create Staff</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($staffs as $key=>$staff)
                    <tr>
                        <td><a href="{{route('backend.admin.staff.view',$staff->id)}}">{{$staff->full_name}}</a></td>
                        <td>{{$staff->email}}</td>
                        <td>{{$staff->phone}}</td>

                        <td><span class="badge {{$staff->status?'badge-success':'badge-danger'}}">{{$staff->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('backend.admin.staff.view',$staff->id)}}" class="btn btn-outline-tsk"><i class="fa fa-eye"></i> </a>


                             </div>

                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-center">
                {{ $staffs->links() }}
            </div>
        </div>

@endsection