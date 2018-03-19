<?
	function generator(string $json_str, int $count) {
		$json = json_decode($json_str, true);
		foreach($json['data'] as $val)
			$prob[] = $val['probability'] * 100;

		for($max_p = 100, $i = 0; $i < count($prob); $max_p -= $prob[$i], ++$i) {
			$total[$i]['range'] = array($max_p - $prob[$i]+1, $max_p);
			$total[$i]['data'] = $json['data'][$i]['text'];
			$total[$i]['probability'] = $json['data'][$i]['probability'];
		}
		for($i = 0; $i < $count; ++$i) {
			$rand = mt_rand(1, 100);
			for($j = 0; $j < count($total); ++$j) 
				if($total[$j]['range'][0] < $rand && $total[$j]['range'][1] > $rand)
					yield $total[$j]['data'];
		}
		return $json;
	}
	function test(string $str) {
		foreach($gen = generator(make_json($str), 10000) as $val)
			$w[$val]++;
		$json = $gen->getReturn();
		foreach($w as $key => $val) 
			for($j = 0; $j < count($json['data']); ++$j) 
				if(strcmp($key, $json['data'][$j]['text']) == 0) 
					$total[] = array(array('text' => $key, 'count' => $val, 
						'calculated_probability' => $json['data'][$j]['probability']));
		echo json_encode($total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
	function debug($value) {
		echo '<pre>';
		var_dump($value);
		echo '</pre>';
	}
?>