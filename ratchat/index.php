<?php
session_start();
// $_SESSION['name'] = null;
if (isset($_POST['submit'])) {
    $_SESSION['name'] = $_POST['name'];
}
?>

<?php
if (!isset($_SESSION['name'])) {
    ?>
    <form method="post">
    <h3>Enter Your name for start chat.</h3>
        <input type="text" value="" name="name" id="name">
        <input type="submit" value="Sumit" name="submit" id="submit">
    </form>
    <?php
}else{
    ?>
    
<form method="post">

    <input type="text" value="" name="msg" id="msg">
    <input type="button" value="Send" name="send" id="send">
</form>

<div id="msgBox"></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function (e) {
        console.log("Connection established!");
        // conn.send('Hello World!');
    };

    conn.onmessage = function (e) {
        var getData = JSON.parse(e.data)
        console.log(getData.msg);
        console.log(getData.name);
        var html = $("#msgBox").append('<b>'+getData.name+'<b>: '+getData.msg+'<br>')
    };

    $("#send").click(function () {
        var msg = $("#msg").val();
        var name = `<?php echo $_SESSION['name']; ?>`;
        var content = {
            msg: msg,
            name:name
        }
        var html = $("#msgBox").append('<b>'+name+'<b>: '+msg+'<br>')
        conn.send(JSON.stringify(content))
    })
</script>
<?php
}
?>