<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/firebasejs/4.1.2/firebase-app.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/firebasejs/4.1.2/firebase-messaging.js"></script>
<script type="text/javascript" src="https://pushjs.org/scripts/push.min.js"></script>
<script type="text/javascript">
	demo();
	function demo() {
    Push.create('Hello world!', {
        body: 'How\'s it hangin\'?',
        icon: 'https://pngimg.com/uploads/mario/mario_PNG125.png',
        link: '/#',
        //timeout: 4000,
        onClick: function () {
            window.focus();
            this.close();
        },
        vibrate: [200, 100, 200, 100, 200, 100, 200]
    });
}

</script>