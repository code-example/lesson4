<?php
	function simple_generator($arr, $count) {
		foreach($arr as $val)
			$prob[] = $val[1];
		$max_p = 100;
		$i = 0;

		foreach($prob as $val) {
			$a = $max_p - $val;
			$total[$i]['range'] = array($a+1, $max_p);
			$total[$i]['data'] = 3;
			$max_p -= $val;
			$i++;
		}
		for($i = 0; $i < $count; ++$i) {
			$rand = mt_rand(1, 100);
			for($j = 0; $j < count($total); ++$j)  {
				if($total[$j]['range'][0] < $rand && $total[$j]['range'][1] > $rand)
					yield $total[$j]['data'];
			}
		}
	}
	function debug($var) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}











	function generator(/*string*/ $json_str, /*int*/ $count) {
		$json = json_decode($json_str, true);
		foreach($json['data'] as $val)
			$prob[] = $val['probability'] * 100;
		$max_p = 100;
		$i = 0;
		foreach($prob as $val) {
			$a = $max_p - $val;
			$total[$i]['range'] = array($a+1, $max_p);
			$total[$i]['data'] = $json['data'][$i]['text'];
			$max_p -= $val;
			$i++;
		}
		for($i = 0; $i < $count; ++$i) {
			$rand = mt_rand(1, 100);
			for($j = 0; $j < count($total); ++$j)  {
				if($total[$j]['range'][0] < $rand && $total[$j]['range'][1] > $rand)
					yield $total[$j]['data'];
			}
		}
	}
	function test($str) {
		$json = make_json($str);
		$arr = json_decode($json, true);
		foreach(generator($json, 1000) as $val) {
			$w[$val]++;
		}
		$i = 0;
		foreach($w as $k => $v) {
			$total[]['text'] = $k;
			$total[$i]['count'] = $v;
			$total[$i]['calculated_probability'] = $arr['data'][$i]['probability'];
			$i++;
		}
		debug($w);
		debug($arr);
		//for($i = 0; $i < count($arr['data']); ++$j) {
			

		//}
		echo 'TOTAL: ';
		debug($total);
	}
	function make_json(/*string*/ $str) /* : string*/ {
		foreach($text = explode("\n", $str) as $val) {
			$total['sum'] += $weight = (int)explode(' ', $val)[count(explode(' ', $val))-1];
			$total['data'][] = array('text' => $val, 'weight' => $weight);
		} 
		for($i = 0; $i < count($total['data']); ++$i)
			$total['data'][$i]['probability'] = round($total['data'][$i]['weight']/$total['sum'], 2);
		return json_encode($total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
	function main_function(/*string*/ $str) { 
		echo make_json($str).'<br>';
		test($str);
	}
	if(isset($_POST['_area']))
		main_function($_POST['_area']);
	else include("index.html");
?>
