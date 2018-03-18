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

<?php
	function main_function1(string $str) { 
		$workers = [ 
			0=>[ "fio" => "Иванов Иван Иванович", "phone" => "9(123)456-78-90", "pay" => 31000 ], 
			1=>[ "fio" => "Петров Пётр Петрович", "phone" => "9(123) 323-99-71", "pay" => 34000 ] 
		];
		//print_r(json_encode($workers, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		//echo json_decode($json, true);
	}
	if(isset($_POST['_area']))
		main_function1($_POST['_area']);
	else include("index.html");
?>