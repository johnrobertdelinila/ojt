@extends('layouts.app')

@section('content')
<div  class="form-group xs-pt-10 col-sm-12">
    <span style="font-size:18px;font-weight:bold;"><i class="icon icon-left mdi mdi-attachment-alt"></i> Alternative Solution:</span>
    <form method="post" action="image/upload/store" enctype="multipart/form-data" class="dropzone" id="dropzone" style="margin-top:0px;font-size:18px;">
        <input type="text" name="dtr_id" value="900" readonly hidden>
        @csrf
    </form>   
</div>

    <script type="text/javascript">
            Dropzone.options.dropzone =
            {
                maxFilesize: 500,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                return time+'_'+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.mp4,.pdf",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file) 
                {
                    var name = file.upload.filename;
                    $.ajax({
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },
                        type: 'POST',
                        url: '{{ url("image/delete") }}',
                        data: {filename: name},
                        success: function (data){
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ? 
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
        
                success: function(file, response) 
                {
                    console.log(response);
                },
                error: function(file, response)
                {
                return false;
                }
            };
    if (prevType != e.type) {   //  reduce double fire issues
        switch (e.type) {
            case "blur":
                // do work
                break;
            case "focus":
                //location.reload();
                break;
        }
    }
    </script>

@endsection