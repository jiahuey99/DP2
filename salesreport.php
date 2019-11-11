<?php
	include_once 'connection.php';
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="salesreport.css?n={random number/string}">
</head>
<header>
	<?php include'navigation.php'?>
</header>
<body>

<?php
	//format post date and fetch between
	$quantityttt = 0;
	$sdate = date('Y-m-d', strtotime($_POST['sdate']));
	$fdate = date('Y-m-d', strtotime($_POST['fdate']));
	$fff = date('Y-m-d', strtotime($fdate . ' +1 day'));
	$splitsdate = explode('-',strval($sdate));
	$splitfdate = explode('-',strval($fdate));
	echo "<h1>Sales Report From $sdate to $fdate</h1>";
	echo "<h2>Food Sales</h2><table><tr><th>Food</th><th>Total Quantity</th><th>Total Price</th></tr>";
	$getting =  mysqli_query($conn,"SELECT * FROM transaction where date BETWEEN '$sdate' AND '$fff' order by date");
	$arr = array();
	$arrr = array();
	$amountarr = array();
	$getmenunames = mysqli_query($conn,"SELECT name FROM menuitems order by name");
	while($namess = $getmenunames->fetch_assoc()){
		array_push($arr,strval($namess['name']));
		array_push($arrr,0);
	}
	while($gott = $getting->fetch_assoc()){
		$getmenuitem = mysqli_query($conn,"SELECT name FROM menuitems order by name");
		$splitfood = explode(',',$gott['food']);
		$arraycount = count($splitfood);
		for($x = 1; $x < $arraycount; $x++){
			$result = preg_replace("/[^a-zA-Z]+/", "", $splitfood[$x]);
			$foodcount = strlen ($result);
			for($y = 0 ; $y < count($arr) ; $y++){	
				if(substr($splitfood[$x],0,$foodcount) == $arr[$y]){
					$arrr[$y] = $arrr[$y]+ intval(substr(strval($splitfood[$x]),$foodcount,10));
				}
			}
		}
	}
	
	$k=1;
	$arrrrr = array();
	for($z = 0 ; $z < count($arrr) ; $z++){
		$getprice = mysqli_query($conn,"SELECT price FROM menuitems where name = '$arr[$z]'");
		
		while($price = $getprice->fetch_assoc()){
			if($k==1){
				$pri = $price['price'];
				echo '<tr><th class = "food">'.$arr[$z].'</th><td class="ttd">'.$arrr[$z].'</td><td class="ttd">'.floatval($pri)*floatval($arrr[$z])."</td></tr>";
				$quantityttt = $quantityttt + $arrr[$z];
				array_push($arrrrr,floatval($pri)*floatval($arrr[$z]));
				$k = $k * -1;
			}else{
				$pri = $price['price'];
				echo '<tr><th class = "food">'.$arr[$z].'</th><td class="lttd">'.$arrr[$z].'</td><td class="lttd">'.floatval($pri)*floatval($arrr[$z])."</td></tr>";
				$quantityttt = $quantityttt + $arrr[$z];
				array_push($arrrrr,floatval($pri)*floatval($arrr[$z]));
				$k = $k * -1;
			}
		}
	}

	echo '</table>';
	$amounttttttt = 0;
	for($yyy=0;$yyy<count($arrrrr);$yyy++){
		$amounttttttt = $amounttttttt + floatval($arrrrr[$yyy]);
	}
	echo '<table id="box"><tr><td class="haaa"></td><td class="names" colspan=2>';
	for($hehe=0;$hehe<count($arr);$hehe++){
		echo '<p class="graphnames">'.$arr[$hehe].'</p>';
	}
	echo '</td></tr><tr><td class="haa">Quantity</td><td class="valuess">';
	
	for($nono = 0; $nono<count($arrr); $nono++){
		$height="";
		if($quantityttt == 0){
			$height = 0;
		}else{
			$height = round(($arrr[$nono]/$quantityttt)*100,3);
		}
		$strheight = strval($height*10);
		$strheight .="px";
		
		$height2="";
		if($amounttttttt == 0){
			$height2 = 0;
		}else{
			$height2 = round(($arrrrr[$nono]/$amounttttttt)*100,3);
		}
		$strheight2 = strval($height2*10);
		$strheight2 .="px";
		echo '<table id="graph" >';
		echo '<tr>';
		echo '<td class ="graph" height='.$strheight.'></td>';
		echo '</tr>';
		echo '</table>';
		echo '<table id="graphright">';
		echo '<tr>';
		echo '<td class ="graphright" height='.$strheight2.'></td>';
		echo '</tr>';
		echo '</table>';
	}
	echo '</td></tr><tr><td class ="concon" colspan=2><p class="light"></p><p>:Total Quantity</p><p class="dark"></p><p>:Total Price</p></td></tr></table>';
	
	echo "<h2>Individual Day's Sales</h2>";
	$arrl = array();
	$arrrl = array();
	$getmenunamess = mysqli_query($conn,"SELECT name FROM menuitems order by name");
	while($namesss = $getmenunamess->fetch_assoc()){
		array_push($arrl,strval($namesss['name']));
		array_push($arrrl,0);
	}
	echo '<table>';
	echo '<tr><th>Date</th>';
	for($m=0 ; $m<count($arrl);$m++){
		echo '<th>'.$arrl[$m].'</th>';
	}
	echo '<th>Total of Day</th>';
			echo '</tr>';
			
			
	$datearray = array();		
	$daytarray = array();
	$dayitemarray = array();
	do{
			array_push($datearray,$sdate);
			$sonedate = date('Y-m-d', strtotime($sdate . ' +1 day'));
			$gettingg =  mysqli_query($conn,"SELECT * FROM transaction where  date BETWEEN '$sdate' AND '$sonedate'");
			for($h = 0; $h<count($arrrl);$h++){
					$arrrl[$h] = 0;
			}
			$smallamount = array();
			
			while($gottt = $gettingg->fetch_assoc()){
				$getmenuitem = mysqli_query($conn,"SELECT name FROM menuitems order by name");
				$splitfoodd = explode(',',$gottt['food']);
				$arraycount = count($splitfoodd);
				for($x = 1; $x < $arraycount; $x++){
					$resultt = preg_replace("/[^a-zA-Z]+/", "", $splitfoodd[$x]);
					$foodcountt = strlen ($resultt);
					for($y = 0 ; $y < count($arrl) ; $y++){	
						if(substr($splitfoodd[$x],0,$foodcountt) == $arrl[$y]){
							$arrrl[$y] = $arrrl[$y]+ intval(substr(strval($splitfoodd[$x]),$foodcountt,10));
						}
					}
				}
				
				
				
				}
			echo '<tr><th class="lth">'.$sdate.'</th>';
			$daytotal = 0;
			for($n=0 ; $n<count($arrrl); $n++){
				$daytotal = intval($arrrl[$n])+ $daytotal;
				echo '<td class="ltd">'.$arrrl[$n].'</td>';
			}
			echo '<td class ="ltd">'.$daytotal.'</td>';
			echo '</tr>';
			echo '<tr><th class="hth">SubTotal</th>';
			$dayptotal = 0.0;
			for($p = 0 ; $p < count($arrrl) ; $p++){
				$getpricee = mysqli_query($conn,"SELECT price FROM menuitems where name = '$arr[$p]'");
				while($pricee = $getpricee->fetch_assoc()){
				$prie = $pricee['price'];
				echo '<td class="htd">'.floatval($prie)*floatval($arrrl[$p])."</td>";
				$dayptotal = $dayptotal+floatval($prie)*floatval($arrrl[$p]);
				}
			}
			echo '<td class="htd">'.$dayptotal.'</td>';
			echo '</tr>';
			array_push($dayitemarray,$daytotal);
			array_push($daytarray,$dayptotal);
			$sdate = date('Y-m-d', strtotime($sdate . ' +1 day'));
			
			
	}while(date('Y-m-d', strtotime($sdate)) != date('Y-m-d', strtotime($fdate.'+1 day')));
	
	echo '<tr><td>Price Total</td>';
	$tttt = 0.0;
	for($z = 0 ; $z < count($arrr) ; $z++){
		$getprice = mysqli_query($conn,"SELECT price FROM menuitems where name = '$arr[$z]'");
		while($price = $getprice->fetch_assoc()){
			$pri = $price['price'];
			echo '<td>'.floatval($pri)*floatval($arrr[$z])."</td>";
			$tttt = $tttt + floatval($pri)*floatval($arrr[$z]);
		}
		
	}
	echo '<td>'.$tttt.'</td>';
	echo '</tr></table>';
	$tt1=0;
	$tt2=0;
	for($lolo=0;$lolo<count($dayitemarray);$lolo++){
		$tt1 = $tt1+$dayitemarray[$lolo];
	}
	for($lili=0;$lili<count($dayitemarray);$lili++){
		$tt2 = $tt2+$daytarray[$lili];
	}
	
	
	
	echo '<table id="box"><tr><td class="haaa"></td><td class="names" colspan=2>';
	for($hehe=0;$hehe<count($datearray);$hehe++){
		echo '<p class="graphnames">'.$datearray[$hehe].'</p>';
	}
	echo '</td></tr><tr><td class="haa">Quantity</td><td class="valuess">';
	
	for($nono = 0; $nono<count($datearray); $nono++){
		$height="";
		if($tt1==0){
			$height = 0;
		}else{
			$height = round(($dayitemarray[$nono]/$tt1)*100,3);
		}
		$strheight = strval($height*5);
		$strheight .="px";
		
		$height2="";
		if($tt2==0){
			$height2 = 0;
		}else{
			$height2 = round(($daytarray[$nono]/$tt2)*100,3);
		}
		$strheight2 = strval($height2*5);
		$strheight2 .="px";
		echo '<table id="graph" >';
		echo '<tr>';
		echo '<td class ="graph" height='.$strheight.'></td>';
		echo '</tr>';
		echo '</table>';
		echo '<table id="graphright">';
		echo '<tr>';
		echo '<td class ="graphright" height='.$strheight2.'></td>';
		echo '</tr>';
		echo '</table>';
	}
	echo '</td></tr><tr><td class ="concon" colspan=2><p class="light"></p><p>:Total items of Day</p><p class="dark"></p><p>:Total Price of Day</p></td></tr></table>';
?>


<?php
	

?>

<?php

?>

	
</body>
</html>