<?php
$newstate = $_POST['state'];
$oid = $_POST['orid'];
$pid = $_POST['pid'];
$qty = $_POST['qty'];
$finish = "";
if ($newstate == "Finished") {
  $finish = "Finish action can not undo..";
}
//echo $newstate;
echo "<script>function saving() {
  var answer = confirm('Are you sure want you to save changes? $finish');
  if (answer) {
    window.open('man_order.php?savechng=$newstate&orid=$oid&pid=$pid&qty=$qty');
  }
}
saving();
window.location.href='../order.php?click=ok';

</script>";

?>