<?php
require_once "config.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT nama_wna as course_name from tbl_wna where nama_wna LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
        $cname = $rs['course_name'];
        echo "$cname\n";
}
?>