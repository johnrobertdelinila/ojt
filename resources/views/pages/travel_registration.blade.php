@extends('layouts.app')

@section('content')
<div class="col-sm-6">
    <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
    <div class="panel-heading panel-heading-divider">Travel Registration Form<span class="panel-subtitle">All feilds with (<span style="color:red;">*</span>) are required</span></div>
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
        <form method="post" action="travel_registration_process" onsubmit="return travel_form();">
        {{ csrf_field() }}
                <div class="form-group xs-pt-10 col-sm-12">
                    {{--  DIVIDER NAME  --}}
                    <label class="label_bold col-md-4 h4">Name/s: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="name[]" multiple="" class="select2" required>
                                @foreach($post_users as $posts_users)
                                    @if($posts_users->utype != 'admin' && $posts_users->utype != 'rd' )
                                    <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                    <?php $date_now = date("Y-m-d"); ?>
                    {{--  DIVIDER DEPARTURE  --}}
                    <label class="label_bold col-md-4 h4">Departure: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <input type="date" name="departure" id="departure" min="<?php echo $date_now; ?>" class="form-control" required>
                    </div>
                    {{--  DIVIDER ARRIVAL  --}}
                    <label class="label_bold col-md-4 h4">Arrival: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <input type="date" name="arrival" id="arrival" min="<?php echo $date_now; ?>" class="form-control" required>
                    </div>
                    {{--  DIVIDER DESTINATION  --}}
                    <label class="label_bold col-md-4 h4">Destination: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="destination" class="form-control" required></textarea>
                    </div>
                    {{--  DIVIDER PURPOSE  --}}
                    <label class="label_bold col-md-4 h4">Purpose: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="purpose" class="form-control" required></textarea>
                    </div>
                    {{--  DIVIDER PER DIEMS  --}}
                    <label class="label_bold col-md-4 h4">Per Diem/Expenses Allowed: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="per_diems" class="form-control"></textarea>
                    </div>
                    {{--  DIVIDER LABORERS  --}}
                    <label class="label_bold col-md-4 h4">Assistants or Laborers Allowed: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="laborers" class="form-control"></textarea>
                    </div>
                    {{--  DIVIDER REMARKS  --}}
                    <label class="label_bold col-md-4 h4">Remarks: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>
                    {{--  DIVIDER FIRST SIGNATORY  --}}
                    <label class="label_bold col-md-4 h4">First Signatory: </label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="signatory_first" class="select2">
                                <option value="">- - - Select Employee - - -</option>
                                @foreach($post_users as $posts_users)
                                    @if($posts_users->utype == 'sc' || $posts_users->utype == 'dc')
                                    <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                    {{--  DIVIDER SECOND SIGNATORY  --}}
                    <label class="label_bold col-md-4 h4">Second Signatory: <span style="color:red;"> *</span></label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="signatory_second" class="select2" required>
                                <option value="">- - - Select Employee - - -</option>
                                @foreach($post_users as $posts_users)
                                    @if($posts_users->utype == 'dc' || $posts_users->utype == 'rd')
                                    <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                    {{--  DIVIDER TO INFORM  --}}
                    <label class="label_bold col-md-4 h4">To Inform:</label>
                    <div class="col-md-8" style="margin-bottom:5px;">
                        <select name="routed_to" class="select2">
                                <option value="">- - - Select Employee - - -</option>
                                @foreach($post_users as $posts_users)
                                    @if($posts_users->utype == 'sc' || $posts_users->utype == 'dc')
                                    <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                    <div class="row xs-pt-15">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button type="submit" id="submit_btn" class="col-xs-12 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
                        </div>
                    </div>
                </div>
        </form>
        {{--  WHOLE FORM  --}}
    </div>
    
</div>

<script>
    document.getElementById('submit_btn').disabled=false;
    function travel_form(){
        if(confirm('Do you want to submit?')==true){
            document.getElementById('submit_btn').disabled=true;
            document.getElementById('submit_btn').innerHTML  ='<i class="icon icon-left mdi mdi-floppy"></i> Saving <img src="property_inventory_theme/html/assets/img/loading.gif" style="width:15px;height:15px;">';
            //document.getElementById('submit_btn').style.visibility='hidden';
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