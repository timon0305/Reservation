
@extends('backend.master')
@section('title',ucfirst(str_replace('-',' ',$section)))
@section('content')
    <div class="card  mb-4">
        <div class="card-header bg-white">
            <h2> {{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small></h2>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="{{route('admin.web_setting.section.store',['faq','faq_section'])}}" method="post" enctype="multipart/form-data">@csrf
                        <div class="form-group">
                            <label for="title_1">Title 1</label>
                            <input type="text" class="form-control form-control-lg" id="title_1" name="title_1" value="{{web_setting()->faq_faq_section_title_1}}">
                        </div>
                        <div class="form-group">
                            <label for="title_2">Sub Title</label>
                            <input type="text" class="form-control form-control-lg" id="title_2" name="title_2" value="{{web_setting()->faq_faq_section_title_2}}">
                        </div>
                        <div class="form-group">
                            <hr/>
                            <button type="submit" class="btn btn-tsk btn-block"><i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h5>{{strtoupper(str_replace('-',' ',$section))}} ITEM
            <a href="#" class="btn btn-sm btn-tsk btn-square float-right" data-toggle="modal" data-target="#addNew"><i class="fa fa-plus"></i> Add New</a>
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-sm table-striped mb-0">
                        <thead>
                        <tr>
                            <th width="30px">SL</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th class="text-right">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse(\App\Model\WebSetting\WebFaq::all() as $key=>$value)
                            <div class="modal fade" id="update_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small> Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    <form action="{{route('admin.web_setting.faq.update',$value->id)}}" method="post" enctype="multipart/form-data">@csrf
                                                        <div class="form-group">
                                                            <label for="question">Question </label>
                                                            <input type="text" class="form-control" id="question" name="question" value="{{$value->question}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="answer">Answer </label>
                                                            <input type="text" class="form-control" id="answer" name="answer" value="{{$value->answer}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <hr/>
                                                            <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                                            <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Update</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <tr>
                            <td >{{$key+1}}</td>
                            <td >{{$value->question}}</td>
                            <td >{{$value->answer}}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-tsk" data-toggle="modal" data-target="#update_{{$value->id}}"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" onclick="confirm('Are you sure delete this data')?$('#delete_form_{{$value->id}}').submit():false"><i class="fa fa-trash"></i></a>
                                </div>
                                <form action="{{route('admin.web_setting.faq.delete',$value->id)}}" id="delete_form_{{$value->id}}" method="post">@csrf</form>

                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center" colspan="4">No result </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ucfirst(str_replace('-',' ',$page))}} <small> ( {{ucfirst(str_replace('-',' ',$section))}} )</small> Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form action="{{route('admin.web_setting.faq.store')}}" method="post" >@csrf

                                <div class="form-group">
                                    <label for="question">Question </label>
                                    <input type="text" class="form-control" id="question" name="question" >
                                </div>
                                <div class="form-group">
                                    <label for="answer">Answer </label>
                                    <input type="text" class="form-control" id="answer" name="answer">
                                </div>
                                <div class="form-group">
                                    <hr/>
                                    <button type="reset" class="btn btn-outline-tsk"><i class="fa fa-refresh"></i> Reset</button>
                                    <button type="submit" class="btn btn-tsk"><i class="fa fa-save"></i> Save</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection