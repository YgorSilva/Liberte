<?php
	$sql = 'select tag from tag_assinatura as a where usuario = "'.$userData['email'].'" 
	order by (select count(*) from tags where tag = a.tag) limit 6';

	$rs = mysql_query($sql);
	$i = 0;
	if($rs){
		while($row = mysql_fetch_array($rs)){
			$tags[$i] = $row['tag'];
			$i++;
		}
	}
	else echo mysql_error();
	if($i < 6){
		$sql = 'select tag from tags as b  
		order by (select count(*) from tags where tag = b.tag) limit '.(6-$i);
		$rs = mysql_query($sql);
		while($row = mysql_fetch_array($rs)){
			$tags[$i] = $row['tag'];
			$i++;
		}
	}
	if($i < 6){
		$sql = 'select tag from native_tags as b limit '.(6-$i);
		$rs = mysql_query($sql);
		while($row = mysql_fetch_array($rs)){
			$tags[$i] = $row['tag'];
			$i++;
		}
	}
?>
<link rel="stylesheet" type="text/css" href="style/navBar.css"/>
<script src="js/tagsSizing.js" type="text/javascript"></script>
<div id='nav'>
	<center><a href='index.php'><img class='menun logo' src='layoutImages/logo.png' width='200px'></a></center>
	<ul class='leftUL'>
		<li><a class='menun corner' href='pesquisa.php?s=%2523<?=$tags[0]?>'><?=$tags[0]?></a></li>
		<li><a class='menun middle' href='pesquisa.php?s=%2523<?=$tags[1]?>'><?=$tags[1]?></a></li>
		<li><a class='menun middle' href='pesquisa.php?s=%2523<?=$tags[2]?>'><?=$tags[2]?></a></li>
	</ul>
	<ul class='rightUL'>
		<li><a class='menun middle' href='pesquisa.php?s=%2523<?=$tags[3]?>'><?=$tags[3]?></a></li>
		<li><a class='menun middle' href='pesquisa.php?s=%2523<?=$tags[4]?>'><?=$tags[4]?></a></li>
		<li><a class='menun corner' href='pesquisa.php?s=%2523<?=$tags[5]?>'><?=$tags[5]?></a></li>
	</ul>
</div>