@extends('layouts.app')

@section('content')
@foreach($inv_edit_qry as $inv_edit_qrys)
{!! Form::open(['action' => ['InventoryController@update',$inv_edit_qrys->id], 'method' => 'put', 'onsubmit'=>'return inventory_form();']) !!}
<div class="col-sm-12">
    <div class="panel panel-default panel-border-color panel-border-color-primary" style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;">
    <div class="panel-heading panel-heading-divider">Property No. <b>{{$inv_edit_qrys->inv_prop_no}}</b><span class="panel-subtitle">All feilds with (<span style="color:red;">*</span>) are required</span></div>
    <div class="panel-body">
        @if(session('suc'))
            <div role="alert" class="alert alert-success alert-dismissible">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span><strong>Success!</strong> You have successfully updated the record no. <b><u>{{session('suc')}}</u></b>.
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
        <div class="form-group xs-pt-10 col-sm-6">
            <label class="label_bold">Quantity & Unit<span style="color:red;"> *</span></label>
            <input type="text" name="inv_qty_unit" placeholder="Quantity & Unit" class="{{$errors->first('inv_qty_unit', ' bred')}} form-control tbox" value="{{old('inv_qty_unit',$inv_edit_qrys->inv_extra4)}}" required>
            <label class="label_bold">Item Name<span style="color:red;"> *</span></label>
            <input type="text" name="inv_name" placeholder="Name" class="{{$errors->first('inv_name', ' bred')}} form-control tbox" value="{{old('inv_name',$inv_edit_qrys->inv_name)}}" required autofocus>
            {{--  DIVIDER  --}}
            {{--  ACCESSORIES START  --}}
            @if($post_acc->count()>=1)
            <div class="col-md-12" style="margin-bottom:-30px;">
              <div class="panel">
                <div class="panel-heading panel-heading-divider" style="padding:0px;">Accessories</div>
                <div class="panel-body">
                  <ol>
                    @foreach($post_acc as $posts_acc)
                        <a href="{{url('inventory_acc_edit/'.$posts_acc->id)}}" class="a_list"><li>{{$posts_acc->acc_name}} <span style="color:red;">>></span> {{$posts_acc->acc_prop_no}} @if($posts_acc->acc_serial)<span style="color:red;">>></span> Serial: {{$posts_acc->acc_serial}}@endif</li></a>
                    @endforeach                    
                  </ol>
                </div>
              </div>
            </div>
            @endif
            {{--  ACCESSORIES END  --}}
            {{--  DIVIDER  --}}
            <button type="button" onclick="add_acc();" class="col-xs-3 col-xs-offset-9 btn btn-space btn-primary btn-sm"><i class="icon icon-left mdi mdi-plus-circle-o"></i> ACCESSORIES</button>
            <p id="demo2"></p>
            {{--  DIVIDER  --}}
            {{--  <label class="label_bold">Property No. Identifier<span style="color:red;"> *</span></label>
            <select type="text" name="inv_prop_no" placeholder="Identifier" style="height:40px;" class="{{$errors->first('inv_pro_no', ' bred')}} form-control tbox" value="{{old('inv_pro_no')}}" required>
                    <option value="">- - - Select - - -</option>
                @foreach($post_identifier as $posts_identifier)
                    @if($inv_edit_qrys->inv_extra2 == $posts_identifier->identifier_name)
                        <option value="{{$posts_identifier->identifier_name}}" selected>{{$posts_identifier->identifier_name}}</option>
                    @else
                        <option value="{{$posts_identifier->identifier_name}}">{{$posts_identifier->identifier_name}}</option>
                    @endif
                @endforeach
            </select> temporary comment  --}}
            <label class="label_bold">Propery Number<span style="color:red;"> *</span></label>
            <input type="text" name="property_number_temporary" placeholder="Property No." class="{{$errors->first('property_number_temporary', ' bred')}} form-control tbox" value="{{$inv_edit_qrys->inv_prop_no}}" required>
            {{--  DIVIDER  --}}
            <label class="label_bold" style="width:100%;">Description <a class="pull-right" onclick="document.getElementById('inv_desc').value=document.getElementById('inv_desc').value+' - Charge to AQMF';" style="cursor:pointer;">Charge to AQMF</a></label>
            <textarea type="text" name="inv_desc" id="inv_desc" placeholder="Description" class="{{$errors->first('inv_desc', ' bred')}} form-control tbox">{{old('inv_desc',$inv_edit_qrys->inv_desc)}}</textarea>
            {{--  DIVIDER  --}}
            <label class="label_bold">Date Acquired<span style="color:red;"> *</span></label>
            <input type="date" name="inv_date_acq" placeholder="" class="{{$errors->first('inv_date_acq', ' bred')}} form-control tbox" value="{{old('inv_date_acq',$inv_edit_qrys->inv_date_acq)}}" max="<?php echo date('Y-m-d'); ?>" required>
            {{--  DIVIDER  --}}
            <label class="label_bold">Serial No.</label>
            <input type="text" name="inv_serial" placeholder="Serial" class="{{$errors->first('inv_serial', ' bred')}} form-control tbox" value="{{old('inv_serial',$inv_edit_qrys->inv_serial)}}">
            {{--  DIVIDER  --}}
            <label class="label_bold">MR to<span style="color:red;"> *</span></label>
            <input type="text" name="inv_mr" placeholder="MR Fullname" style="text-transform:uppercase;" class="{{$errors->first('inv_mr', ' bred')}} form-control tbox" value="{{old('inv_mr',$inv_edit_qrys->inv_mr)}}" required>
            {{--  DIVIDER  --}}
            {{--  PAR START  --}}
            @if($post_par->count()>=1)
            <div class="col-md-10 col-md-offset-2" style="margin-bottom:-30px;">
              <div class="panel">
                <div class="panel-heading panel-heading-divider" style="padding:0px;">PAR</div>
                <div class="panel-body">
                  <ol>
                    @foreach($post_par as $posts_par)
                        <a href="{{url('inventory_par_edit/'.$posts_par->id)}}" class="a_list"><li>{{$posts_par->par_name}}</li></a>
                    @endforeach                    
                  </ol>
                </div>
              </div>
            </div>
            @endif
            {{--  PAR END  --}}
            {{--  DIVIDER  --}}
            <button type="button" onclick="add_par();" class="col-xs-2 col-xs-offset-10 btn btn-space btn-primary btn-sm"><i class="icon icon-left mdi mdi-plus-circle-o"></i> PAR</button>
            <p id="demo"></p>
        </div>
        <div class="form-group xs-pt-10 col-sm-6">
            {{--  DIVIDER  --}}
            <label class="label_bold">Property Type<span style="color:red;"> *</span></label>
            <select name="inv_life_span" style="height:40px;" class="{{$errors->first('inv_life_span', ' bred')}} form-control tbox" required>
                <option value="">- - - Select - - -</option>
                {{--  Type 1 Start  --}}
                <optgroup label="Land Improvements">
                    @foreach($post_property_type as $posts_property_type)
                        @if($posts_property_type->property_category == 1)
                            <option value="{{$posts_property_type->property_type_name}}|{{$posts_property_type->property_life_span}}" @if($posts_property_type->property_type_name == $inv_edit_qrys->inv_extra3) selected @endif>{{$posts_property_type->property_type_name}} ({{$posts_property_type->property_life_span}}yrs)</option>
                        @endif
                    @endforeach
                </optgroup>
                {{--  Type 2 Start  --}}
                <optgroup label="Buildings - Those that are predominantly">
                    @foreach($post_property_type as $posts_property_type)
                        @if($posts_property_type->property_category == 2)
                            <option value="{{$posts_property_type->property_type_name}}|{{$posts_property_type->property_life_span}}" @if($posts_property_type->property_type_name == $inv_edit_qrys->inv_extra3) selected @endif>{{$posts_property_type->property_type_name}} ({{$posts_property_type->property_life_span}}yrs)</option>
                        @endif
                    @endforeach
                </optgroup>
                {{--  Type 3 Start  --}}
                <optgroup label="Leasehold Improvements (Note 1)">
                    @foreach($post_property_type as $posts_property_type)
                        @if($posts_property_type->property_category == 3)
                            <option value="{{$posts_property_type->property_type_name}}|{{$posts_property_type->property_life_span}}" @if($posts_property_type->property_type_name == $inv_edit_qrys->inv_extra3) selected @endif>{{$posts_property_type->property_type_name}} ({{$posts_property_type->property_life_span}}yrs)</option>
                        @endif
                    @endforeach
                </optgroup>
                {{--  Type 4 Start  --}}
                <optgroup label="Office, Equipment, Furniture and Fixtures">
                    @foreach($post_property_type as $posts_property_type)
                        @if($posts_property_type->property_category == 4)
                            <option value="{{$posts_property_type->property_type_name}}|{{$posts_property_type->property_life_span}}" @if($posts_property_type->property_type_name == $inv_edit_qrys->inv_extra3) selected @endif>{{$posts_property_type->property_type_name}} ({{$posts_property_type->property_life_span}}yrs)</option>
                        @endif
                    @endforeach
                </optgroup>
                {{--  Type 5 Start  --}}
                <optgroup label="Machineries and Equipment">
                    @foreach($post_property_type as $posts_property_type)
                        @if($posts_property_type->property_category == 5)
                            <option value="{{$posts_property_type->property_type_name}}|{{$posts_property_type->property_life_span}}" @if($posts_property_type->property_type_name == $inv_edit_qrys->inv_extra3) selected @endif>{{$posts_property_type->property_type_name}} ({{$posts_property_type->property_life_span}}yrs)</option>
                        @endif
                    @endforeach
                </optgroup>
                {{--  Type 6 Start  --}}
                <optgroup label="Transportation Equipment">
                    @foreach($post_property_type as $posts_property_type)
                        @if($posts_property_type->property_category == 6)
                            <option value="{{$posts_property_type->property_type_name}}|{{$posts_property_type->property_life_span}}" @if($posts_property_type->property_type_name == $inv_edit_qrys->inv_extra3) selected @endif>{{$posts_property_type->property_type_name}} ({{$posts_property_type->property_life_span}}yrs)</option>
                        @endif
                    @endforeach
                </optgroup>
                {{--  Type 7 Start  --}}
                <optgroup label="Other Property, Plant and Equipment">
                    @foreach($post_property_type as $posts_property_type)
                        @if($posts_property_type->property_category == 7)
                            <option value="{{$posts_property_type->property_type_name}}|{{$posts_property_type->property_life_span}}" @if($posts_property_type->property_type_name == $inv_edit_qrys->inv_extra3) selected @endif>{{$posts_property_type->property_type_name}} ({{$posts_property_type->property_life_span}}yrs)</option>
                        @endif
                    @endforeach
                {{--  Type 1-7 End  --}}
                </optgroup>
            </select>
            {{--  DIVIDER  --}}
            {{--  <label class="label_bold">Life Span (in Years)<span style="color:red;"> *</span></label>
            <input type="number" name="inv_life_span" placeholder="Life Span (in years)" class="{{$errors->first('inv_life_span', ' bred')}} form-control tbox" value="{{old('inv_life_span',$inv_edit_qrys->inv_extra1)}}" min="1" max="20" required>  --}}
            {{--  DIVIDER  --}}
            <label class="label_bold">Locator<span style="color:red;"> *</span></label>
            <input type="text" name="inv_locator" placeholder="Locator" class="{{$errors->first('inv_locator', ' bred')}} form-control tbox" value="{{old('inv_locator',$inv_edit_qrys->inv_locator)}}" required>
            {{--  DIVIDER  --}}
            <label class="label_bold">Unit Value<span style="color:red;"> *</span></label>
            <input type="text" name="inv_unit_value" placeholder="Unit Value" class="{{$errors->first('inv_unit_value', ' bred')}} form-control tbox" value="{{old('inv_unit_value',$inv_edit_qrys->inv_unit_value)}}" required>
            {{--  DIVIDER  --}}
            <label class="label_bold">Total Value<span style="color:red;"> *</span></label>
            <input type="text" name="inv_total_value" placeholder="Total Value" class="{{$errors->first('inv_total_value', ' bred')}} form-control tbox" value="{{old('inv_total_value',$inv_edit_qrys->inv_total_value)}}" required>
            {{--  DIVIDER  --}}
            {{--  <label class="label_bold">Netbook Value<span style="color:red;"> *</span></label>
            <input type="text" name="inv_netbook_value" placeholder="Netbook Value" class="{{$errors->first('inv_netbook_value', ' bred')}} form-control tbox" value="{{old('inv_netbook_value',$inv_edit_qrys->inv_netbook_value)}}" required>  --}}
            {{--  DIVIDER  --}}
            <label class="label_bold">Remarks<span style="color:red;"> *</span></label>
            <select type="text" name="inv_remarks" placeholder="Identifier" style="height:40px;" class="{{$errors->first('inv_remarks', ' bred')}} form-control tbox" value="{{old('inv_remarks')}}" required>
                @if($inv_edit_qrys->inv_remarks == "Serviceable")
                    <option value="Serviceable" selected>Serviceable</option>
                    <option value="Serviceable-Fully Depreciated">Serviceable-Fully Depreciated</option>
                    <option value="Unserviceable">Unserviceable</option>
                @elseif($inv_edit_qrys->inv_remarks == "Serviceable-Fully Depreciated")
                    <option value="Serviceable">Serviceable</option>
                    <option value="Serviceable-Fully Depreciated" selected>Serviceable-Fully Depreciated</option>
                    <option value="Unserviceable">Unserviceable</option>
                @elseif($inv_edit_qrys->inv_remarks == "Unserviceable")
                    <option value="Serviceable">Serviceable</option>
                    <option value="Serviceable-Fully Depreciated">Serviceable-Fully Depreciated</option>
                    <option value="Unserviceable" selected>Unserviceable</option>
                @else
                @endif
            </select>
        </div>
        <div class="row xs-pt-15">
            <div class="col-xs-3 col-xs-offset-9">
                <p class="text-right">
                    <button type="button" id="submit_btn_enable" onclick="enable_submit_btn();" class="col-xs-12 btn btn-space btn-warning btn-lg"><i class="icon icon-left mdi mdi-power"></i> Enable Submission</button>
                    <button type="submit" id="submit_btn" class="col-xs-12 btn btn-space btn-primary btn-lg" style="visibility:hidden;position:absolute;" disabled><i class="icon icon-left mdi mdi-floppy"></i> Submit</button>
                </p>
            </div>
        </div>
    </div>
    </div>
</div>
{!! Form::close() !!}
@endforeach

<script>
    //Enable to edit
    function enable_submit_btn(){
        document.getElementById('submit_btn').disabled = false;
        document.getElementById('submit_btn_enable').style.visibility = 'hidden';
        document.getElementById('submit_btn_enable').style.position = 'absolute';
        document.getElementById('submit_btn').style.visibility = 'visible';
        document.getElementById('submit_btn').style.position = 'relative';
    }
    //Enable to edit
    //Submit confirmation
    function inventory_form(){
        if(confirm('Do you want to submit?')==true){
            document.getElementById('submit_btn').disabled=true;
            document.getElementById('submit_btn').style.visibility='hidden';
            return true;
        }else{
            return false;
        }
    }
    //Submit confirmation
    //PAR  

    function add_par(){
        var x = document.createElement("INPUT");
            x.setAttribute("type", "text");
            x.setAttribute("name", "par_name[]");
            x.setAttribute("placeholder", "PAR Fullname & Details");
            x.setAttribute("class", "form-control tbox");
            x.setAttribute("style", "text-transform:uppercase;width:80%;margin-left:20%;");
        document.getElementById("demo").appendChild(x);
    }
    //PAR

    //ACCESSORIES2  
    function add_acc(){
        var x = document.createElement("INPUT");
            x.setAttribute("type", "text");
            x.setAttribute("name", "acc_name[]");
            x.setAttribute("placeholder", "Name");
            x.setAttribute("class", "form-control tbox");
            x.setAttribute("style", "width:40%;float:left;margin-left:20%;");
        var y = document.createElement("INPUT");
            y.setAttribute("type", "text");
            y.setAttribute("name", "acc_serial[]");
            y.setAttribute("placeholder", "Serial");
            y.setAttribute("class", "form-control tbox");
            y.setAttribute("style", "width:40%;float:left;");
        document.getElementById("demo2").appendChild(x);
        document.getElementById("demo2").appendChild(y);
    }
    //ACCESSORIES
</script>

@endsection