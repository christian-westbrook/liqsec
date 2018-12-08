<?php
include '../session.php';

if($sessionStarted == false)
{
   header('Location: /~iot3/');
}

if(closeSession())
{
	header('Location: /~iot3/');
}
?>
