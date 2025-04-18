<?php
/*
-----------------------------------------------------------------------------------------------
Name:		index.php
Author:		Connor Bryan Andrew Clawson
Date:		2025-03-07
Language:	PHP
Purpose:	This page functions as a landing page.

-----------------------------------------------------------------------------------------------
ChangeLog:
Who			When			What
----------- --------------- -------------------------------------------------------------------
CBAC		2025-03-07		Original Version 
-----------------------------------------------------------------------------------------------
*/

include './view/header.php';

// echo "test loop<br>";
// $arr = array("a" => "1", "b" => "2", "c" => "3", "d" => "4");
// foreach ($arr as $key => $value) {
//     echo '' . $key . ' = ' . $value . ', ';
// }

?>

<main class="content-wrap">
    <?php include './controller/controller.php'; ?>
</main>

<?php include './view/footer.php'; ?>

