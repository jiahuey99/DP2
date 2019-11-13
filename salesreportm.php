<?php
	include_once 'connection.php';
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="salesreport.css?x={random number/string}">
</head>
<header>
	<?php include'navigation.php'?>
</header>
<body>

<?php
	//format post date and fetch between
	$quantityttt = 0;
	$sdate = date('Y-m-00', strtotime($_POST['sdate']));
	$fdate = date('Y-m-00', strtotime($_POST['fdate']));
	$fdatemonthval = date('m', strtotime($_POST['fdate']));
	if($fdatemonthval == '12'){
		$fff = date('Y-m-00', strtotime($fdate . ' + 2 month'));
	}else{
		$fff = date('Y-m-00', strtotime($fdate . ' +1 month'));
	}
	$splitsdate = explode('-',strval($sdate));
	$splitfdate = explode('-',strval($fdate));
	echo "<h1>Sales Report From $sdate to $fdate</h1>";
	echo "<h2>Food Sales</h2><table><tr><th>Food</th><th>Total Quantity</th><th>Total Price</th></tr>";
	$getting =  mysqli_query($conn,"SELECT * FROM transaction where date > '$sdate' and date < '$fff'order by date");
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
	$arrrrr = array();
	$jojo = 1;
	for($z = 0 ; $z < count($arrr) ; $z++){
		$getprice = mysqli_query($conn,"SELECT price FROM menuitems where name = '$arr[$z]'");
		while($price = $getprice->fetch_assoc()){
			if($jojo==1){
			$pri = $price['price'];
				$quantityttt = $quantityttt + $arrr[$z];
				array_push($arrrrr,floatval($pri)*floatval($arrr[$z]));
				echo '<tr><th>'.$arr[$z].'</th><td class="ltd">'.$arrr[$z].'</td><td class="ltd">'.floatval($pri)*floatval($arrr[$z])."</td></tr>";
			}else{
				$quantityttt = $quantityttt + $arrr[$z];
				array_push($arrrrr,floatval($pri)*floatval($arrr[$z]));
				echo '<tr><th>'.$arr[$z].'</th><td class="htd">'.$arrr[$z].'</td><td class="htd">'.floatval($pri)*floatval($arrr[$z])."</td></tr>";
			}
			$jojo = $jojo *-1;
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
	echo '</td></tr><tr><td class="haa"></td><td class="valuess">';
	
	for($nono = 0; $nono<count($arrr); $nono++){
		$height="";
		if($quantityttt==0){
			$height = 0;
		}else{
			$height = round(($arrr[$nono]/($quantityttt+$amounttttttt))*100,3);
		}
		$strheight = strval($height*10);
		$strheight .="px";
		
		$height2="";
		if($amounttttttt==0){
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
	echo '<th>Total of Month</th>';
	echo '</tr>';
	$xxx = 0;
	$totototo =0;
	$tp = 0;
	$datearray = array();
	$daytarray = array();
	$dayitemarray = array();
	do{	
			$sonedate = date('Y-m-00', strtotime($sdate . ' +1 month'));
			$gdate = date('Y-m-00',strtotime($sdate));
			
			$gettingg =  mysqli_query($conn,"SELECT * FROM transaction where  date > '$gdate' AND date <'$sonedate'");
			$gg = 0;
			for($gg = 0; $gg<count($arrrl);$gg++){
					$arrrl[$gg] = 0;
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
			if($xxx!=0){
				array_push($datearray,$gdate);
				echo '<tr><td class="ltd">'.$sdate.'</td>';
				$t = 0;
				for($n=0 ; $n<count($arrrl); $n++){
					echo '<td class="ltd">'.$arrrl[$n].'</td>';
					$t = $t + $arrrl[$n];
				}
				echo '<td class="ltd">'.$t.'</td>';
				echo '</tr>';
				echo '<tr><td class="htd">SubTotal</td>';
				$tp = 0;
				for($p = 0 ; $p < count($arrrl) ; $p++){
					
					$getpricee = mysqli_query($conn,"SELECT price FROM menuitems where name = '$arr[$p]'");
					while($pricee = $getpricee->fetch_assoc()){
					$prie = $pricee['price'];
					$tp = $tp+floatval($prie)*floatval($arrrl[$p]);
					echo '<td class="htd">'.floatval($prie)*floatval($arrrl[$p])."</td>";
					
					}
				}
				echo '<td class ="htd">'.$tp.'</td>';
				echo '</tr>';
				$totototo = $totototo + $tp;
				array_push($dayitemarray,$t);
			}
			array_push($daytarray,$tp);
			$xxx = 1;
			$sdate = date('Y-m', strtotime($sdate . ' +1 month'));
			
			
			
	}while(date('Y-m-00', strtotime($gdate)) != date('Y-m-00', strtotime($fdate)));
	
	echo '<tr><td>Total</td>';
	for($z = 0 ; $z < count($arrr) ; $z++){
		$getprice = mysqli_query($conn,"SELECT price FROM menuitems where name = '$arr[$z]'");
		while($price = $getprice->fetch_assoc()){
			$pri = $price['price'];
			echo '<td>'.floatval($pri)*floatval($arrr[$z])."</td>";
		}
	}
	echo '<td>'.$totototo.'</td>';
	echo '</tr></table>';
	
	$newdaytarray = array();
	$tt1=0;
	$tt2=0;
	for($lolo=0;$lolo<count($dayitemarray);$lolo++){
		$tt1 = $tt1+$dayitemarray[$lolo];
	
	}
	for($lili=0;$lili<count($daytarray)-1;$lili++){
		$tt2 = $tt2+$daytarray[$lili+1];
		array_push($newdaytarray,$daytarray[$lili+1]);
	}
	$highest=0;
	for($hahaha=0;$hahaha<count($dayitemarray);$hahaha++){
		$height="";
		if($tt1 == 0){
			$height = 0;
		}else{
			$height = round(($dayitemarray[$hahaha]/($tt1+$tt2))*100,3);
		}
		$strheight = strval($height*10);
		
		$height2="";
		if($tt2 == 0){
			$height2 = 0;
		}else{
			$height2 = round(($newdaytarray[$hahaha]/($tt2+$tt1))*100,3);
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
	for($hohoho=0;$hohoho<count($newdaytarray);$hohoho++){
		if($newdaytarray[$hohoho]> $high){
			$high = $newdaytarray[$hohoho];
		}
	}
	$www = (count($datearray)+1.7)*80;
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
	$hhh= ($tt2+$tt1)/5;
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
		if($tt1 == 0){
			$height = 0;
		}else{
			$height = round(($dayitemarray[$nono]/($tt1+$tt2))*100,3);
		}
		$strheight = strval($height*10);
		$strheight .="px";
		
		$height2="";
		if($tt2== 0){
			$height2 = 0;
		}else{
			$height2 = round(($daytarray[$nono+1]/($tt2+$tt1))*100,3);
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
<table>

<?php
	

?>

<?php

?>
</table>
	
</body>
</html>