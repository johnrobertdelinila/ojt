@extends('layouts.app')

@section('content')
@foreach($post_acc as $posts_acc)
{!! Form::Open(['url'=>'inventory_acc_update/'.$posts_acc->id, 'method'=>'post', 'onsubmit'=>'return confirm("Do you want to apply these changes?");']) !!}
<div class="col-sm-8">
    <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">Accessory No. <b>{{$posts_acc->acc_prop_no}}</b><span class="panel-subtitle">All feilds with (<span style="color:red;">*</span>) are required</span></div>
    <div class="panel-body">
        @if(session('suc'))
            <div role="alert" class="alert alert-success alert-dismissible">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span><strong>Success!</strong> You have successfully updated the record no. <b><u>{{session('suc')}}</u></b>.
            </div>
        @endif
        <div class="form-group xs-pt-10 col-sm-12">
            {{--  DIVIDER  --}}
            <label class="label_bold">Accessory Name</label>
            <input type="text" name="acc_name" placeholder="Accessory Name" class="{{$errors->first('acc_name', ' bred')}} form-control tbox" value="{{old('acc_name',$posts_acc->acc_name)}}" required>
            {{--  DIVIDER  --}}
            <label class="label_bold">Serial No.</label>
            <input type="text" name="acc_serial" placeholder="Serial" class="{{$errors->first('acc_serial', ' bred')}} form-control tbox" value="{{old('acc_serial',$posts_acc->acc_serial)}}">
            {{--  DIVIDER  --}}
        </div>
        <div class="row xs-pt-15">
            <div class="col-xs-6 col-xs-offset-6">
                <a href="{{ url('inventory_edit/'.$posts_acc->inv_tracer) }}" class="col-xs-5 btn btn-space btn-danger btn-sm"><i class="icon icon-left mdi mdi-long-arrow-return"></i> Back</a>
                <button type="submit" id="submit_btn" class="col-xs-6 btn btn-space btn-primary btn-sm"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
            </div>
        </div>
    </div>
    </div>
{!! Form::Close() !!}
</div>
@endforeach
@endsection