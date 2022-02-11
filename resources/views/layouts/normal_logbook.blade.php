
            @if($btn_check == 'time1')
                <div class="col-xs-12 text-center">
                    <span  id="loading_div"></span>
                    <button type="submit" name="btn_time" value="time1" style="font-size:30px;padding:50px;" class="col-xs-12 btn btn-space btn-success btn-lg"><i style="font-size:30px;" class="icon icon-left mdi mdi-account-calendar"></i>&nbsp; Time In (AM)</button>
                </div>
            @elseif($btn_check == 'time2')
                <div class="col-xs-12 text-center">
                    <span  id="loading_div"></span>
                    <button type="submit" name="btn_time" value="time2" style="font-size:30px;padding:50px;" class="col-xs-12 btn btn-space btn-danger btn-lg"><i style="font-size:30px;" class="icon icon-left mdi mdi-power"></i>&nbsp; Time Out (NN)</button>
                </div>
                <div class="col-xs-12" style="margin-bottom:5px;">
                    <p style="color:red;font-size:18px;font-weight:bold;">@if(session('err')) <br/>*{{session('err')}} @endif</p>
                    <textarea name="accomplishment" class="form-control" style="height:150px;font-size:18px;" placeholder="Write Your Journal Here ..." minlength="30" required autofocus>@if(isset($accomplishment)){{ $accomplishment }}@endif</textarea>
                </div>
                <div class="col-xs-12">
                    <button type="submit" name="btn_save" value="save" class="col-xs-12 btn btn-space btn-primary btn-lg"><i class="icon icon-left mdi mdi-floppy"></i>&nbsp; Save as Draft</button>
                </div>
            @elseif($btn_check == 'time3')
                <div class="col-xs-12 text-center">
                    <span  id="loading_div"></span>
                    <button type="submit" name="btn_time" value="time3" style="font-size:30px;padding:50px;" class="col-xs-12 btn btn-space btn-success btn-lg"><i style="font-size:30px;" class="icon icon-left mdi mdi-account-calendar"></i>&nbsp; Time In (NN)</button>
                </div>
            @elseif($btn_check == 'time4')
                <div class="col-xs-12 text-center">
                    <span  id="loading_div"></span>
                    <button type="submit" name="btn_time" value="time4" style="font-size:30px;padding:50px;" class="col-xs-12 btn btn-space btn-danger btn-lg"><i style="font-size:30px;" class="icon icon-left mdi mdi-power"></i>&nbsp; Time Out (PM)</button>
                </div>
                <div class="col-xs-12" style="margin-bottom:5px;">
                    <p style="color:red;font-size:18px;font-weight:bold;">@if(session('err')) <br/>*{{session('err')}} @endif</p>
                    <textarea name="accomplishment" class="form-control" style="height:150px;font-size:18px;" placeholder="Write Your Journal Here ..." minlength="30" required autofocus>@if(isset($accomplishment)){{ $accomplishment }}@endif</textarea>
                </div>
                <div class="col-xs-12">
                    <button type="submit" name="btn_save" value="save" class="col-xs-12 btn btn-space btn-primary btn-lg"><i class="icon icon-left mdi mdi-floppy"></i>&nbsp; Save as Draft</button>
                </div>
            @elseif($btn_check == 'time5')
                <div class="col-xs-12" style="font-size:30px;text-align:center;">
                    <br/><img style="width:200px;" src="{{ asset('property_inventory_theme/html/assets/img/happy_gif.gif') }}">
                    <h3 class="text-center text-success" style="font-size:30px;font-weight:bold;">You have completed your attendance today!</h3>
                </div>
            @else
                {{--  <div class="main-content container-fluid"><h3 class="text-center">Thank You!</h3></div>  --}}
            @endif