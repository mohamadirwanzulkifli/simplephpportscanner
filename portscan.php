<?php
ini_set('max_execution_time', 0);
if(isset($_POST)) {    

	$ip = $_POST['ip'];
	$ip1 = $_POST['ip1'];
	$ip2 = $_POST['ip2'];
	$ports = $_POST['ports'];
	
	$port_arr = explode(",",$ports);
	
	foreach($port_arr as $port){
		$name = getservbyport($port, "tcp");
	
		for($a=$ip1;$a<=$ip2;$a++){
			$add = $ip.'.'.$a;
			if($pf = @fsockopen($add, $port, $err, $err_string, 1)) {
				$result[] = $add."&nbsp;<span style=\"color:green\">[+] OPEN</span>: Port ".$port.($name)."<br />";
				fclose($pf);
			} 
		}
	}
	
	if(count($result)>0){
		foreach($result as $val){
			echo $val.'<br>';
		}
	} else {
		echo "No ports open.";
	}
}
?>

<form method="post">
<input type="text" name="ip" value="<?php echo $ip;?>">
<input type="text" name="ip1" value="<?php echo $ip1;?>">
<input type="text" name="ip2" value="<?php echo $ip2;?>">
<input type="text" name="ports" value="<?php echo $ports;?>">
<input type="submit">
</form>