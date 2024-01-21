<?php
function p($ob, $f = 1)
{
    print "<pre>";
    print_r($ob);
    print "</pre>";
    if ($f == 1) exit;
}

?>
