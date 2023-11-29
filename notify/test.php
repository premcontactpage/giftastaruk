<!DOCTYPE html>

<html>

<head>
<title>Hello!</title>


<script>

notify();

function notify(){

 navigator.serviceWorker.register('sw.js');
 Notification.requestPermission().then( function( permission )
        {
            if ( permission != "granted" )
            {
                alert( "Notification failed!" );
                return;
            }

            navigator.serviceWorker.ready.then( function( registration )
            {
                registration.showNotification( "Hello world", { body:"Here is the body!" } );
            } );

        } );
}
</script>
</head>

<body>

</body>