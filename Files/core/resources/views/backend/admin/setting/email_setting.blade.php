@extends('backend.master')
@section('title',"Email Setting")
@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <h2>Email Setting</h2>
        </div>
        <div class="card-body">
            <div class="card mb-4">
                <div class="card-header bg-white font-weight-bold">
                    Short Code
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> CODE </th>
                                                <th> DESCRIPTION </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td> 1 </td>
                                                <td> <pre>&#123;&#123;message&#125;&#125;</pre> </td>
                                                <td> Details Text From Script</td>
                                            </tr>
                                            <tr>
                                                <td> 2 </td>
                                                <td> <pre>&#123;&#123;name&#125;&#125;</pre> </td>
                                                <td> Users Name. Will Pull From Database and Use in EMAIL text</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white font-weight-bold">
                    Email Template
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="{{route('backend.admin.email_setting.update')}}">
                        @csrf
                        <div class="form-group row">

                            <div class="col-sm-12">
                                <label ><strong>EMAIL SENT FROM</strong></label>
                                <input type="email" class="form-control form-control-lg" name="sender_email" value="{{general_setting()->sender_email}}" >
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-12">
                                <label><strong>EMAIL TEMPLATE</strong> </label>
                                <textarea class="form-control" name="email_message" id="nicEdit" style="width: 100%;height: 600px">@php echo general_setting()->email_message ; @endphp</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button class="btn btn-tsk btn-block" >Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({
                iconsPath : '{{asset('assets/plugin/niceditor/nicEditorIcons.gif')}}',
                fullPanel : true
            }).panelInstance('nicEdit');
        });
    </script>
@endsection