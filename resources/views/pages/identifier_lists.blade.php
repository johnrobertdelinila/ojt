@extends('layouts.app')

@section('content')
<div class="row">
    <div class="main-content container-fluid">
        <div class="user-profile">
        <div class="row">
            {{--  user profile  --}}
            <div class="col-md-5">
            <div class="user-display" style="border:1px solid gray;border-top:3px solid #2E4053;">
                <div class="user-display-bottom">
                <div class="row" style="font-size:15px;text-align:center;font-weight:bold;margin-bottom:10px;">Add Identifier</div>
                @if(session('suc'))
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span>{{session('suc')}}</u></b>
                    </div>
                @endif
                <form action="{{url('/identifier_add')}}" method="get">
                    <input type="text" class="form-control tbox" name="identifier_name" placeholder="Identifier Name" required autofocus>
                    <input type="submit" value="Add" class="btn btn-primary">
                </form>
                </div>
            </div>
            </div>
            {{--  user profile  --}}
            <div class="col-md-7">
            <div class="widget widget-fullwidth widget-small" style="border:1px solid gray;border-top:3px solid #2E4053;">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align:center;font-size:20px;">Identifier Lists</th>
                        </tr>
                        <tr>
                            <th>Identifier Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($post_identifier as $posts_identifier)
                        <tr>
                            <td style="padding:5px;"><?php echo $i++; ?>.{{$posts_identifier->identifier_name}}</td>
                            <td style="padding:5px;"><a href="{{url('identifier_delete/'.$posts_identifier->id)}}" class="btn btn-danger" style="padding:0px 20px;">Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection