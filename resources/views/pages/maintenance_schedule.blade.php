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
                <div class="row" style="font-size:15px;text-align:center;font-weight:bold;margin-bottom:10px;">MAINTENANCE SCHEDULE DATE</div>
                    
                    <?php $maintenance_date = ''; ?>
                    
                    @foreach($post as $posts)
                        <?php $maintenance_date = $posts->maintenance_date; ?>
                    @endforeach

                    <form action="maintenance_add" method="post" id="maintenance_add">
                    {{ csrf_field() }}
                        <input type="date" class="form-control tbox" value="{{$maintenance_date}}" name="maintenance_date" required autofocus>
                        <button class="btn btn-space btn-primary" id="btn_save"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
                    </form>
                
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#maintenance_add').on('submit', function(event){
            $('#btn_save').attr('disabled',true);
        });
    });
</script>
@endsection