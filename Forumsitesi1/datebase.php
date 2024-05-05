<?php
    try
	{
		$db = new PDO('mysql:host=localhost;dbname=formdb;charset=utf8mb4','root','');
    }
	catch(PDOException $m)
	{
		echo $m->getMessage();
	}
?>