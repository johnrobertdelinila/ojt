@extends('layouts.app')

@section('content')
{!! Form::open(['action' => 'OjtController@store', 'method' => 'post', 'onsubmit'=>'return inventory_form();']) !!}
{{ csrf_field() }}
<div class="col-sm-6">
    <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
    <div class="panel-heading panel-heading-divider">Item Registration Form<span class="panel-subtitle">All feilds with (<span style="color:red;">*</span>) are required</span></div>
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
        <div class="form-group xs-pt-10 col-sm-12">
            {{--  DIVIDER  --}}
            <label class="label_bold h4">Seller Name<span style="color:red;"> *</span></label>
            <select name="seller_id" class="form-control" style="padding:0px 10px;" required>
                    <option value="">- - - Select Seller - - -</option>
                @foreach($post_seller as $posts_seller)
                    <option value="{{$posts_seller->id}}">{{$posts_seller->seller_name}}</option>
                @endforeach
            </select>
            <button type="button" style="margin-top:5px;" onclick="add_acc();" class="col-xs-3 col-xs-offset-9 btn btn-space btn-primary btn-sm"><i class="icon icon-left mdi mdi-plus-circle-o"></i> ADD ITEMS</button>
            <p id="demo2"></p>
            {{--  DIVIDER  --}}
        </div>
        <div class="row xs-pt-15">
            <div class="col-xs-6 col-xs-offset-3">
                <button type="submit" id="submit_btn" class="col-xs-12 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
            </div>
        </div>
    </div>
    </div>
    
</div>
{!! Form::close() !!}

<script>
    document.getElementById('submit_btn').disabled=true;
    function inventory_form(){
        if(confirm('Do you want to submit?')==true){
            document.getElementById('submit_btn').disabled=true;
            document.getElementById('submit_btn').innerHTML  ='<i class="icon icon-left mdi mdi-floppy"></i> Saving <img src="property_inventory_theme/html/assets/img/loading.gif" style="width:15px;height:15px;">';
            //document.getElementById('submit_btn').style.visibility='hidden';
            return true;
        }else{
            return false;
        }
    }

    //ACCESSORIES2  
    function add_acc(){
        var x = document.createElement("INPUT");
            x.setAttribute("type", "text");
            x.setAttribute("name", "buyer_name[]");
            x.setAttribute("placeholder", "Buyer Name");
            x.setAttribute("class", "form-control tbox");
            x.setAttribute("style", "width:40%;float:left;margin-left:20%;");
        var y = document.createElement("INPUT");
            y.setAttribute("type", "number");
            y.setAttribute("name", "item_amount[]");
            y.setAttribute("placeholder", "Item Amount");
            y.setAttribute("class", "form-control tbox");
            y.setAttribute("style", "width:40%;float:left;");
        document.getElementById("demo2").appendChild(x);
        document.getElementById("demo2").appendChild(y);
        document.getElementById('submit_btn').disabled=false;
    }
    //ACCESSORIES
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