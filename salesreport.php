<?php
	include_once 'connection.php';
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="salesreport.css?kkddj={random number/string}">
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
	$arrrrr = array();
	$amountarr = array();
	$getmenunames = mysqli_query($conn,"SELECT name FROM menuitems order by name");
	while($namess = $getmenunames->fetch_assoc()){
		array_push($arr,strval($namess['name']));
		array_push($arrr,0);
		array_push($arrrrr,0);
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
					$splitsplit = explode(' ',$splitfood[$x]);
					$arrr[$y] = $arrr[$y]+ intval(substr(strval($splitsplit[0]),$foodcount,10));
					$arrrrr[$y] = $arrrrr[$y]+floatval($splitsplit[1]);
				}
			}
		}
	}
	
	$k=1;
	
	for($z = 0 ; $z < count($arrr) ; $z++){
		$getprice = mysqli_query($conn,"SELECT price FROM menuitems where name = '$arr[$z]'");
		
		while($price = $getprice->fetch_assoc()){
			if($k==1){
				$pri = $price['price'];
				echo '<tr><th class = "food">'.$arr[$z].'</th><td class="ttd">'.$arrr[$z].'</td><td class="ttd">'.$arrrrr[$z]."</td></tr>";
				$quantityttt = $quantityttt + $arrr[$z];
				$k = $k * -1;
			}else{
				$pri = $price['price'];
				echo '<tr><th class = "food">'.$arr[$z].'</th><td class="lttd">'.$arrr[$z].'</td><td class="lttd">'.$arrrrr[$z]."</td></tr>";
				$quantityttt = $quantityttt + $arrr[$z];
				$k = $k * -1;
			}
		}
	}

	echo '</table>';
	$amounttttttt = 0;
	for($yyy=0;$yyy<count($arrrrr);$yyy++){
		$amounttttttt = $amounttttttt + floatval($arrrrr[$yyy]);
	}
	$highest=0;
	for($hahaha=0;$hahaha<count($arr);$hahaha++){
		$height="";
		if($quantityttt == 0){
			$height = 0;
		}else{
			$height = round(($arrr[$hahaha]/($quantityttt+$amounttttttt))*100,3);
		}
		$strheight = strval($height*10);
		
		$height2="";
		if($amounttttttt == 0){
			$height2 = 0;
		}else{
			$height2 = round(($arrrrr[$hahaha]/($amounttttttt+$quantityttt))*100,3);
		}
		$strheight2 = strval($height2*10);
		
		if(floatval($strheight)>$highest){
			$highest = floatval($strheight);
		}
		if(floatval($strheight2)>$highest){
			$highest = floatval($strheight2);
		}
	}
	$high=0;
	for($hohoho=0;$hohoho<count($arrrrr);$hohoho++){
		if($arrrrr[$hohoho]> $high){
			$high = $arrrrr[$hohoho];
		}
	}
	$www = (count($arrrrr)+1.5)*80;
	$strwww = strval($www);
	$strwww .= "px";
	$forhui = strval(($www*0.5)*-1);
	$forhui .= "px";
	$huihuihui = 'margin-left:';
	$huihuihui .= $forhui;
	$strhhh = strval($highest+6);
	$strhhh .="px";
	$strhighest = (strval(($highest/5)-2));
	$strhighest .="px";
	$hhh= ($amounttttttt+$quantityttt)/5;
	$high1= $high*0.2;
	$high2= $high*0.4;
	$high3= $high*0.6;
	$high4= $high*0.8;
	$high5= $high*1;
	$strhhhh = floatval($strhhh)+150;
	
	echo '<table id="front" height='.$strhhh.' width='.$strwww.' style='.$huihuihui.'><tr><td class="alignment">'.$high1.'</td></tr><tr><td class="alignment">'.$high2.'</td></tr><tr><td class="alignment">'.$high3.'</td></tr><tr><td class="alignment">'.$high4.'</td></tr><tr><td class="alignment">'.$high5.'</td></tr></table>';
	echo '<table id="borbor" height='.$strhhhh.' width='.$strwww.' style='.$huihuihui.'><tr><td></td></tr></table>';
	echo '<table id="box"><tr id="whay"><td class="haaa"></td><td class="names" colspan=2>';
	for($hehe=0;$hehe<count($arr);$hehe++){
		echo '<p class="graphnames">'.$arr[$hehe].'</p>';
	}
	echo '</td></tr><tr><td class="haa">';
	
	
	
	
	echo '</td><td class="valuess">';
	for($nono = 0; $nono<count($arrr); $nono++){
		$height="";
		if($quantityttt == 0){
			$height = 0;
		}else{
			$height = round(($arrr[$nono]/($quantityttt+$amounttttttt))*100,3);
		}
		$strheight = strval($height*10);
		$strheight .="px";
		
		$height2="";
		if($amounttttttt == 0){
			$height2 = 0;
		}else{
			$height2 = round(($arrrrr[$nono]/($amounttttttt+$quantityttt))*100,3);
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
	$ararar = array();
	$getmenunamess = mysqli_query($conn,"SELECT name FROM menuitems order by name");
	while($namesss = $getmenunamess->fetch_assoc()){
		array_push($arrl,strval($namesss['name']));
		array_push($arrrl,0);
		array_push($ararar,0);
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
					$ararar[$h] = 0;
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
							$splitsplit = explode(' ',$splitfoodd[$x]);
							$arrrl[$y] = $arrrl[$y]+ intval(substr(strval($splitsplit[0]),$foodcountt,10));
							$ararar[$y] = $ararar[$y] + floatval($splitsplit[1]); 
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
				echo '<td class="htd">'.$ararar[$p]."</td>";
				$dayptotal = $dayptotal+$ararar[$p];
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
	for($z = 0 ; $z < count($arrrrr) ; $z++){
		
		
	
			echo '<td>'.$arrrrr[$z]."</td>";
			$tttt = $tttt + $arrrrr[$z];
		
		
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
	
	
	$amounttttttt = 0;
	for($yyy=0;$yyy<count($daytarray);$yyy++){
		$amounttttttt = $amounttttttt + floatval($daytarray[$yyy]);
	}
	$highest=0;
	for($hahaha=0;$hahaha<count($dayitemarray);$hahaha++){
		$height="";
		if($quantityttt == 0){
			$height = 0;
		}else{
			$height = round(($dayitemarray[$hahaha]/($quantityttt+$amounttttttt))*100,3);
		}
		$strheight = strval($height*10);
		
		$height2="";
		if($amounttttttt == 0){
			$height2 = 0;
		}else{
			$height2 = round(($daytarray[$hahaha]/($amounttttttt+$quantityttt))*100,3);
		}
		$strheight2 = strval($height2*10);
		
		if(floatval($strheight)>$highest){
			$highest = floatval($strheight);
		}
		if(floatval($strheight2)>$highest){
			$highest = floatval($strheight2);
		}
	}
	$high=0;
	for($hohoho=0;$hohoho<count($daytarray);$hohoho++){
		if($daytarray[$hohoho]> $high){
			$high = $daytarray[$hohoho];
		}
	}
	$www = (count($datearray)+1.5)*80;
	$strwww = strval($www);
	$strwww .= "px";
	$forhui = strval(($www*0.5)*-1);
	$forhui .= "px";
	$huihuihui = 'margin-left:';
	$huihuihui .= $forhui;
	$strhhh = strval($highest+6);
	$strhhh .="px";
	$strhighest = (strval(($highest/5)-2));
	$strhighest .="px";
	$hhh= ($amounttttttt+$quantityttt)/5;
	$high1= $high*0.2;
	$high2= $high*0.4;
	$high3= $high*0.6;
	$high4= $high*0.8;
	$high5= $high*1;
	$strhhhh = floatval($strhhh)+150;
	echo '<table id="front" height='.$strhhh.' width='.$strwww.' style='.$huihuihui.'><tr><td class="alignment">'.$high1.'</td></tr><tr><td class="alignment">'.$high2.'</td></tr><tr><td class="alignment">'.$high3.'</td></tr><tr><td class="alignment">'.$high4.'</td></tr><tr><td class="alignment">'.$high5.'</td></tr></table>';
	echo '<table id="borbor" height='.$strhhhh.' width='.$strwww.' style='.$huihuihui.'><tr><td></td></tr></table>';
	echo '<table id="box"><tr id="whay"><td class="haaa"></td><td class="names" colspan=2>';
	for($hehe=0;$hehe<count($datearray);$hehe++){
		echo '<p class="graphnames">'.$datearray[$hehe].'</p>';
	}
	
	echo '</td></tr><tr><td class="haa"></td><td class="valuess">';
	
	for($nono = 0; $nono<count($datearray); $nono++){
		$height="";
		if($tt1==0){
			$height = 0;
		}else{
			$height = round(($dayitemarray[$nono]/($tt1+$tt2))*100,3);
		}
		$strheight = strval($height*10);
		$strheight .="px";
		
		$height2="";
		if($tt2==0){
			$height2 = 0;
		}else{
			$height2 = round(($daytarray[$nono]/($tt2+$tt1))*100,3);
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
	echo '</td></tr><tr><td class ="concon" colspan=2><p class="light"></p><p>:Total items of Day</p><p class="dark"></p><p>:Total Price of Day</p></td></tr></table>';
	
	
?>


<?php
	

?>

<?php

?>

	
</body>
</html>