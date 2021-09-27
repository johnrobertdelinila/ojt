@extends('layouts.app')

@section('content')
<div class="col-sm-6">
    <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
    <div class="panel-heading panel-heading-divider">Travel Modification Form<span class="panel-subtitle">All feilds with (<span style="color:red;">*</span>) are required</span></div>
    <div class="panel-body">
        @if(session('suc_name'))
            <div role="alert" class="alert alert-success alert-dismissible" style="font-size:15px;">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span><b>{{session('suc_ctr')}}</b> New Item/s Of <b><a style="color:#00ECFF;font-size:20px;" href="{{url('inventory_export_excel?seller_name='.session('suc_name').'&buyer_name=&item_status=&date_actioned=&per_page=10&filter=Filter')}}">{{session('suc_name')}}</a></b> Are Successfully Registered!</u></b>.
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--  WHOLE FORM  --}}
        @foreach($post_to_selected as $posts_to_selected)
        <form method="post" action="travel_edit_process" onsubmit="return travel_form();">
        {{ csrf_field() }}
                <input hidden type="text" name="id_holder" value="{{$posts_to_selected->id}}">
                <div class="form-group xs-pt-10 col-sm-12">
                    {{--  DIVIDER NAME  --}}
                    <label class="label_bold col-md-6 h4" style="text-align:left;margin-bottom:20px;">T.O. Number: {{$posts_to_selected->travel_id}}</label>
                    <label class="label_bold col-md-6 h4" style="text-align:right;margin-bottom:20px;">T.O. Status: {{$posts_to_selected->travel_status}}</label>
                    <label class="label_bold col-md-4 h4">Name/s: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="name[]" multiple="" class="select2" required>
                                @foreach($post_users_selected as $posts_users_selected)
                                @if($posts_users_selected->utype != 'admin' && $posts_users_selected->utype != 'rd')
                                        <option value="{{$posts_users_selected->student_id}}" selected>{{$posts_users_selected->name}}</option>
                                @endif
                                @endforeach

                                @foreach($post_users_not_selected as $posts_users_not_selected)
                                @if($posts_users_not_selected->utype != 'admin' && $posts_users_not_selected->utype != 'rd')
                                        <option value="{{$posts_users_not_selected->id}}">{{$posts_users_not_selected->name}}</option>
                                @endif                                        
                                @endforeach
                        </select>
                    </div>
                    {{--  DIVIDER DEPARTURE  --}}
                    <label class="label_bold col-md-4 h4">Departure: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <input type="date" name="departure" value="{{ $posts_to_selected->departure }}" class="form-control" required>
                    </div>
                    {{--  DIVIDER ARRIVAL  --}}
                    <label class="label_bold col-md-4 h4">Arrival: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <input type="date" name="arrival" value="{{ $posts_to_selected->arrival }}" class="form-control" required>
                    </div>
                    {{--  DIVIDER DESTINATION  --}}
                    <label class="label_bold col-md-4 h4">Destination: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="destination" class="form-control" required>{{ $posts_to_selected->destination }}</textarea>
                    </div>
                    {{--  DIVIDER PURPOSE  --}}
                    <label class="label_bold col-md-4 h4">Purpose: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="purpose" class="form-control" required>{{ $posts_to_selected->purpose }}</textarea>
                    </div>
                    {{--  DIVIDER PER DIEMS  --}}
                    <label class="label_bold col-md-4 h4">Per Diem/Expenses Allowed: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="per_diems" class="form-control">{{ $posts_to_selected->per_diems }}</textarea>
                    </div>
                    {{--  DIVIDER LABORERS  --}}
                    <label class="label_bold col-md-4 h4">Assistants or Laborers Allowed: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="laborers" class="form-control">{{ $posts_to_selected->laborers }}</textarea>
                    </div>
                    {{--  DIVIDER REMARKS  --}}
                    <label class="label_bold col-md-4 h4">Remarks: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="remarks" class="form-control">{{ $posts_to_selected->remarks }}</textarea>
                    </div>
                    {{--  DIVIDER FIRST SIGNATORY  --}}
                    <label class="label_bold col-md-4 h4">First Signatory: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="signatory_first" class="select2">
                                <option value="">- - - Select First Signatory - - -</option>
                                @foreach($post_all_users_selected as $posts_all_users_selected)
                                @if($posts_all_users_selected->utype == 'sc' || $posts_all_users_selected->utype == 'dc')
                                    @if($posts_all_users_selected->name == $posts_to_selected->signatory_first)
                                        <option value="{{$posts_all_users_selected->name}}" selected>{{$posts_all_users_selected->name}}</option>
                                    @else
                                        <option value="{{$posts_all_users_selected->name}}">{{$posts_all_users_selected->name}}</option>
                                    @endif
                                @endif
                                @endforeach
                        </select>
                    </div>
                    {{--  DIVIDER SECOND SIGNATORY  --}}
                    <label class="label_bold col-md-4 h4">Second Signatory: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="signatory_second" class="select2" required>
                                <option value="">- - - Select Second Signatory - - -</option>
                                @foreach($post_all_users_selected as $posts_all_users_selected)
                                @if($posts_all_users_selected->utype == 'dc' || $posts_all_users_selected->utype == 'rd')
                                    @if($posts_all_users_selected->name == $posts_to_selected->signatory_second)
                                        <option value="{{$posts_all_users_selected->name}}" selected>{{$posts_all_users_selected->name}}</option>
                                    @else
                                        <option value="{{$posts_all_users_selected->name}}">{{$posts_all_users_selected->name}}</option>
                                    @endif
                                @endif
                                @endforeach
                        </select>
                    </div>
                    {{--  DIVIDER TO INFORM  --}}
                    <label class="label_bold col-md-4 h4">To Inform:</label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="routed_to" class="select2">
                                <option value="">- - - Select Employee - - -</option>
                                @foreach($post_all_users_selected as $posts_all_users_selected)
                                @if($posts_all_users_selected->utype == 'sc' || $posts_all_users_selected->utype == 'dc')
                                    @if($posts_all_users_selected->name == $posts_to_selected->routed_to)
                                        <option value="{{$posts_all_users_selected->name}}" selected>{{$posts_all_users_selected->name}}</option>
                                    @else
                                        <option value="{{$posts_all_users_selected->name}}">{{$posts_all_users_selected->name}}</option>
                                    @endif
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                    <div class="row xs-pt-15">
                    @if(Auth::user()->name == $posts_to_selected->signatory_first && $posts_to_selected->travel_status == 'PENDING')
                        <div class="col-xs-12">
                            <button type="submit" id="submit_btn1" name="btn_type" value="recommend" class="col-xs-6 col-xs-offset-3 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Recommend For Approval</button>
                            <button type="submit" id="submit_btn2" name="btn_type" value="disapprove" class="col-xs-6 col-xs-offset-3 btn btn-space btn-danger btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Disapprove</button>
                        </div>
                    @elseif(Auth::user()->name == $posts_to_selected->signatory_second && $posts_to_selected->travel_status == 'RECOMMENDED FOR APPROVAL')
                        <div class="col-xs-12">
                            <button type="submit" id="submit_btn1" name="btn_type" value="approve" class="col-xs-6 col-xs-offset-3 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Approve</button>
                            <button type="submit" id="submit_btn2" name="btn_type" value="disapprove" class="col-xs-6 col-xs-offset-3 btn btn-space btn-danger btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Disapprove</button>
                        </div>
                    @elseif(Auth::user()->name == $posts_to_selected->signatory_second && $posts_to_selected->signatory_first == '' && $posts_to_selected->travel_status == 'PENDING')
                        <div class="col-xs-12">
                            <button type="submit" id="submit_btn1" name="btn_type" value="approve" class="col-xs-6 col-xs-offset-3 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Approve</button>
                            <button type="submit" id="submit_btn2" name="btn_type" value="disapprove" class="col-xs-6 col-xs-offset-3 btn btn-space btn-danger btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Disapprove</button>
                        </div>
                    @else
                    @endif
                    
                    @if(Auth::user()->id == 1)
                        <div class="col-xs-12">
                            <button type="submit" id="submit_btn3" name="btn_type" value="save" class="col-xs-6 col-xs-offset-3 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
                        </div>
                    @endif
                    </div>
                </div>
        </form>
        @endforeach
        {{--  WHOLE FORM  --}}
    </div>
    
</div>

<script>
    function travel_form(){
        if(confirm('Do you want to proceed?')==true){
            return true;
        }else{
            return false;
        }
    }

</script>
<script>
    function total_value_javascript(){
        document.getElementById('inv_total_value').value = document.getElementById('inv_qty').value * document.getElementById('inv_unit_value').value;
    }
</script>
{{--  INITIALIZE FORM ELEMENTS  --}}
    <script type="text/javascript">
        $(document).ready(function(){
            App.formElements();
        });
    </script>
@endsection