<?php
//echo "-".dir('\\\\192.168.1.7\\smdr');
$source_dir="\\\\192.168.1.2\\games\\111";
$dest_dir="C:/wamp/www/smdr/1/";
$d = dir($source_dir);
//echo "Дескриптор: " . $d->handle . "\n";
//echo "Путь: " . $d->path . "\n";

while (false !== ($entry = $d->read())) {
$str = $entry;
$substr = "rpc";
if (strstr($str, $substr))
{
echo "---". $entry."\n";
copy($source_dir."\\".$entry,$dest_dir.$entry);
}
   }
$d->close();
?>
