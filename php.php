<?php

	function make_json(string $str) : string {
		foreach($text = explode("\n", $str) as $val) {
			$total['sum'] += $weight = (int)explode(' ', $val)[count(explode(' ', $val))-1];
			$total['data'][] = array('text' => $val, 'weight' => $weight);
		} 
		for($i = 0; $i < count($total['data']); ++$i)
			$total['data'][$i]['probability'] = round($total['data'][$i]['weight']/$total['sum'], 2);

		return json_encode($total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
	function generator(string $json_str) {
		$json = json_decode($json_str, true);
		echo count($json['data']).'lol';
		//foreach($json['data'] as $val)
	}
	function main_function(string $str) { 
		
	}
	if(isset($_POST['_area']))
		main_function($_POST['_area']);
	else include("index.html");
?>

