<?php
$dest_month = "06";
$dest_year = "2013";
$dest_dir= "C:\\wamp\\www\\smdr\\".$dest_year."\\";
$dest_dir=$dest_dir.$dest_month."\\";
$log_file = $dest_dir."smdr_".$dest_month."_".$dest_year.".log";
$handle = @fopen($log_file, "r");
$sum_min = 0;
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) 
	{
		$dest_array = explode(",",$buffer);
		if($dest_array[3]=='71033' and $dest_array[8] !=='1' and $dest_array[1] !=='00:00:00' and strlen($dest_array[6]) > 8) 

			{       $min = $dest_array[1];
				$call_time = explode(":", $min);
				if($call_time[2] == "00")
					{$call_min = (int) $call_time[1];} 
				else 	{$call_min = (int) $call_time[1] + 1;}
 				$sum_min += (int) $call_min;
				echo $buffer."\n".$call_min."-".$sum_min."\n";
				
			}
    	}
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
echo $sum_min;
}
?>
