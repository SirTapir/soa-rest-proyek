<?php
	$data = json_decode($_POST['data'], true);

	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL, 'http://192.168.0.126/api/add_detail/'.$data['tipe']);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query( array('foreign_id' => $data['foreign_id'],				
																'invoice_id' => $data['invoice_id'],
																'total' => $data['total'] )));

	$ret = curl_exec($ch);
	curl_close($ch);
	echo $ret;
?>