<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('21a64c8e4330847c4e5f', {
            cluster: 'ap2',
            encrypted: true

        });
        // var pusher = new Pusher('YOUR_API_KEY', {
        //     encrypted: true
        // });
        // Subscribe to the channel we used in our Laravel Event

        var channel = pusher.subscribe('notification-send');
        channel.bind('App\\Events\\NotificationEvent', function(data) {
                alert(JSON.stringify(data));

        });
        // var channel = pusher.subscribe('my-channel');
        // channel.bind('my-event', function(data) {
        //     alert(JSON.stringify(data));
        // });
    </script>
</head>
<body>
<h1>Pusher Test</h1>
<p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
</p>
</body>