<?php
//version 0.6
$dest_month = "12";
$dest_year = "2013";
$telnum = "71012";
$dest_dir= "C:\\wamp\\www\\smdr\\".$dest_year."\\";
$dest_dir=$dest_dir.$dest_month."\\";
$log_file = $dest_dir."smdr_".$dest_month."_".$dest_year.".log";
$bee_file = "C:\\wamp\\www\\beeline\\".$dest_year."\\HF975_".$dest_month.".TXT";

function findcost($number)
{
//version 0.2
global $bee_file;
$number=substr_replace($number, '7', 0, 1);
$handle = @fopen($bee_file, "r");
$sum_cost = 0.00;
if ($handle) {
$counter = 0;
$find = 0;
    while (($buffer = fgets($handle, 4096)) !== false) 
	{
$buffer = preg_replace('/[\s]{2,}/', ' ', $buffer);
$dest_array = explode(" ",$buffer);
if($counter>=11)$findnum=substr_count($dest_array[6],$number);
		if($counter++ >=11 and $findnum >0 and $dest_array[3]!='0:00')
			{       
				$cost1 =explode(".", $dest_array[4]);
				$cost = $cost1[0]+$cost1[1]/100;
				$minutes1 =explode(":", $dest_array[3]);
				$minutes = (int) $minutes1[0];
				$sum_cost = $cost/$minutes;
				$find++;
			}
    	}
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
return $sum_cost;
}
}

$handle = @fopen($log_file, "r");
$sum_min = 0;
$sum_costs = 0.00;
if ($handle) {
$counter = 0;
    while (($buffer = fgets($handle, 4096)) !== false) 
	{
		$counter_cost = 0.00;
		$dest_array = explode(",",$buffer);
		if($counter++ >=2 and $dest_array[3]==$telnum and $dest_array[8] !=='1' and $dest_array[1] !=='00:00:00' and strlen($dest_array[6]) > 8) 

			{       $min = $dest_array[1];
				$call_time = explode(":", $min);
				if($call_time[2] == "00")
					{$call_min = (int) $call_time[1];} 
				else 	{$call_min = (int) $call_time[1] + 1;}
 				$sum_min += (int) $call_min;
 				$counter_cost = (float) findcost($dest_array[5]) * (int) $call_min;
				$sum_costs += $counter_cost;
				echo $buffer."\n".$call_min."-".$counter_cost."\n".$sum_costs."\n";
				
			}
    	}
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
echo "Sum min:".$sum_min."Sum rub:".$sum_costs;
}
?>
