<?php
$data = $_GET['datavalue'];
$a = array('New Delhi', 'laxminagar');
$b = array('Guwahati', 'Dibrugarh');
$c = array('HYDERABAD', 'Ranga Reddy', 'Khammam');
$d = array('Ahmedabad', 'Surat');
$e = array('Aldona', 'Anjuna');
if ($data == "Delhi") {
    foreach ($a as $aone) {
        echo "<option> $aone </option>";
    }
}
if ($data == "Assam") {
    foreach ($b as $bone) {
        echo "<option> $bone </option>";
    }
}
if ($data == "Telangana") {
    foreach ($c as $cone) {
        echo "<option> $cone </option>";
    }
}
if ($data == "Gujrat") {
    foreach ($d as $done) {
        echo "<option> $done </option>";
    }
}
if ($data == "Goa") {
    foreach ($e as $eone) {
        echo "<option> $eone </option>";
    }
}
?>