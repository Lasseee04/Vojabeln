<?php
//$oids[];
foreach($_POST['selected'] as $oid){
    $oids[] = $oid;
}
header('Location: ../gestartet.php?oids=<?php echo $oids ?>"');

exit();
?> 