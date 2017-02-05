<?php
	require ("config.php");

	$query = "SELECT count(*) as qtde, chassi, sum(consumo_medio)  as consumo_medio, sum(temperatura)  as temperatura, sum(velocidade_media)  as velocidade_media FROM infoMaquina GROUP BY chassi";
	$result = mysql_query($query);

	if(mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
    	$arr_maquinas[$row['chassi']] = $row;
		}
	}

	foreach($arr_maquinas as $key => $value){
		$arr_maquinas[$key]['consumo_medio']    = $value['consumo_medio']    / $value['qtde']; 
		$arr_maquinas[$key]['temperatura']      = $value['temperatura']      / $value['qtde']; 
		$arr_maquinas[$key]['velocidade_media'] = $value['velocidade_media'] / $value['qtde'];
	}

	print json_encode($arr_maquinas);

?>