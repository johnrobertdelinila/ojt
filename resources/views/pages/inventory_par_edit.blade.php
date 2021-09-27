@extends('layouts.app')

@section('content')
@foreach($post_par as $posts_par)
{!! Form::Open(['url'=>'inventory_par_update/'.$posts_par->id, 'method'=>'post', 'onsubmit'=>'return confirm("Do you want to apply these changes?");']) !!}
<div class="col-sm-8">
    <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">PAR Name: <b>{{$posts_par->par_name}}</b><span class="panel-subtitle">All feilds with (<span style="color:red;">*</span>) are required</span></div>
    <div class="panel-body">
        @if(session('suc'))
            <div role="alert" class="alert alert-success alert-dismissible">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span><strong>Success!</strong> You have successfully updated.
            </div>
        @endif
        <div class="form-group xs-pt-10 col-sm-12">
            {{--  DIVIDER  --}}
            <label class="label_bold">PAR Name</label>
            <input type="text" name="par_name" placeholder="Accessory Name" class="{{$errors->first('par_name', ' bred')}} form-control tbox" value="{{old('par_name',$posts_par->par_name)}}" required>
            {{--  DIVIDER  --}}
        </div>
        <div class="row xs-pt-15">
            <div class="col-xs-6 col-xs-offset-6">
                <a href="{{ url('inventory_edit/'.$posts_par->inv_tracer) }}" class="col-xs-5 btn btn-space btn-danger btn-sm"><i class="icon icon-left mdi mdi-long-arrow-return"></i> Back</a>
                <button type="submit" id="submit_btn" class="col-xs-6 btn btn-space btn-primary btn-sm"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
            </div>
        </div>
    </div>
    </div>
{!! Form::Close() !!}
</div>
@endforeach
@endsection