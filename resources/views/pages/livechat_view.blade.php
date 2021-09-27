<head>
  <title>Pusher Test</title>
  <!DOCTYPE html>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
  <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('0caa629122300b6d4e2e', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      //alert(JSON.stringify(data));
      alert(data.message);
    });
    
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
  <br/>
  <?php //echo sha1($_SERVER['HTTP_USER_AGENT']); ?><br/>
  <?php //echo system('ipconfig/all'); ?><br/>
  <?php //echo substr(shell_exec('getmac'), 159, 20); ?>
  <?php //echo $_SERVER['REMOTE_ADDR']; ?>
</body>