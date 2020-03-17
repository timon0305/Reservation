@extends('backend.master')
@section('title',"Guest")
@section('content')
        <div class="card">
            <div class="card-header bg-white">
                <h2>Guest
                    <a class="btn btn-tsk float-right" href="{{route('backend.admin.guests.create')}}"><i class="fa fa-plus"></i> Create Guest</a>

                </h2>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-condensed mb-0">
                    <thead class="bg-tsk-o-1">
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>VIP</th>
                        <th>Status</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($guests as $key=>$guest)
                    <tr>
                        <td><a href="{{route('backend.admin.guests.view',$guest->id)}}">{{$guest->full_name}}</a></td>
                        <td>{{$guest->email}}</td>
                        <td>{{$guest->phone}}</td>
                        <td><span class="badge {{$guest->vip?'badge-success':'badge-danger'}}">{{$guest->vip?'VIP':''}}</span></td>
                        <td><span class="badge {{$guest->status?'badge-success':'badge-danger'}}">{{$guest->status?'Active':'Inactive'}}</span></td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('backend.admin.guests.view',$guest->id)}}" class="btn btn-outline-tsk"><i class="fa fa-eye"></i> </a>


                             </div>

                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-center">
                {{ $guests->links() }}
            </div>
        </div>

@endsection