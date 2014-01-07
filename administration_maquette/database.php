<?php
header("Content-Type: text/plain");	
require_once("../config/config.inc.php");

if(isset($_GET['choice']) && $_GET['choice']=='1')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT n.agreement,c.cause,a.name, ar.name, u.username, n.album, n.user FROM notarizealbum n, user u, album a, cause c,artist ar, `release` r WHERE c.id=n.cause and n.album=a.id and ar.id=r.artist and a.id=r.album and u.id=n.user limit 10;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].",".$row[6].";";
	}

	$stmt->closeCursor();
	echo $data;
}




if(isset($_GET['choice']) && $_GET['choice']=='2')
{
	$db = new DBHandler();
	$stmt = $db->query("SELECT n.agreement,c.cause, ar.name, u.username, n.artist, n.user FROM notarizeartist n, user u, cause c,artist ar WHERE c.id=n.cause and ar.id=n.artist and u.id=n.user limit 10;");
	$data ="";
	while ($row = $stmt->fetch(PDO::FETCH_NUM))
	{
		$data = $data.$row[0].",".$row[1].",".$row[2].",".$row[3].",".$row[4].",".$row[5].";";
	}

	$stmt->closeCursor();
	echo $data;
}



if(isset($_GET['not']) && $_GET['not']==1)
{
	$notarizealbum = new Notarizealbum($_GET['user'],$_GET['id']);
	echo 'ohey';
	$notarizealbum->delete($_GET['user'],$_GET['id']);
}



if(isset($_GET['not']) && $_GET['not']==2)
{
	$notarizeartist = new Notarizeartist($_GET['user'],$_GET['id']);
	$notarizeartist->delete($_GET['user'],$_GET['id']);
}

?>