<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<form method="post" action="livechat_form_submit" id="livechat_form_submit">
    {{ csrf_field() }}
    <input type="text" name="content" autofocus></input>
    <input type="submit"></input>
</form>

<script>
$(document).ready(function(){
	$('#livechat_form_submit').on('submit',function(event){
            event.preventDefault();
		$.ajax({
            url:"{{ route('livechat_form_submit.action') }}",
			method:"POST",
            data:new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,
			success:function(data){
                alert('success!');
			}
		});
	});
});
</script>