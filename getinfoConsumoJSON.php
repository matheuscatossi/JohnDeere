<?php
	require ("config.php");

	$query = "SELECT count(*) as qtde, chassi, sum(consumo_medio) as consumo_medio FROM infoMaquina GROUP BY chassi";
	$result = mysql_query($query);

	if(mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
    	$arr_maquinas[$row['chassi']] = $row;
		}
	}

	foreach($arr_maquinas as $key => $value){
		$arr_maquinas[$key]['consumo_medio']    = $value['consumo_medio']    / $value['qtde'];
	}

	$count = 0;
	$consumo = 0;
	foreach($arr_maquinas as $key => $value){
		$consumo    += $value['consumo_medio'];
		$count ++;
	}	

	$consumo = $consumo / $count;
	$consumo = number_format($consumo, 2, '.', '');
	print json_encode($consumo);

?>