<?php
$con = mysqli_connect('localhost', 'root','convox32');
mysqli_select_db($con, 'curdyt');

if (!$con) {
    echo "Connection failed: " . mysqli_connect_error();
}
?>

<!-- <script>
   function disableInspect() {
        document.addEventListener("contextmenu", event => {
            event.preventDefault();
            alert("This function is not allowed!");
        });

        document.addEventListener("keydown", event => {
            if (
                event.ctrlKey && ["u", "U"].includes(event.key) || 
                event.ctrlKey && event.shiftKey && ["i", "I", "j", "J"].includes(event.key) || 
                event.key === "F12" 
            ) {
                event.preventDefault();
                alert("This function is not allowed!");
            }
        });
    }

</script>
 -->
