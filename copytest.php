<?php
//version 0.2
$source_dir="\\\\10.1.227.130\\avaya_log\\";
//dest month,year,dir
$dest_month = "12";
$dest_year = "2013";
$dest_dir= "C:\\wamp\\www\\smdr\\".$dest_year."\\";

mkdir($dest_dir.$dest_month);
$dir_bat=$dest_dir.$dest_month."\\1.bat";;
$dest_dir=$dest_dir.$dest_month."\\";
$dest_file=$dest_dir.$dest_month.".log";
$d = dir($source_dir);

while (false !== ($entry = $d->read())) {
$str = $entry;
$substr = "-".$dest_month."-".$dest_year;
$substr2 = "smdr";
if (strstr($str, $substr))
	{
		if(strstr($str, $substr2))
			{
				echo $entry."\n";
				copy($source_dir.$entry,$dest_dir.$entry);
			}
	}
   }
copy("1.bat",$dir_bat);
chdir($dest_dir);
exec("1.bat");
rename("1.log","smdr_".$dest_month."_".$dest_year.".log");
$d->close();
?>
