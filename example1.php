<?php

require('routeros/routeros_api.class.php');

$API = new RouterosAPI();

//$API->debug = true;

if ($API->connect('103.146.17.2', 'radiustest', 'rd123')) {

   //$API->write('/interface/getall');
   $API->write('/system/resource/print');

   $READ = $API->read(true);

   
   $ARRAY = $API->parseResponse($READ);

   print_r($READ);

   echo"<br>";
   echo"<br>";

   echo $READ['0']['uptime']."<br>";
   echo $READ['0']['platform']."<br>";
echo $READ['0']['version']."<br>";
echo $READ['0']['architecture-name']."<br>";
echo $READ['0']['cpu']."<br>";
echo $READ['0']['cpu-count']."Core <br>";
echo $READ['0']['cpu-frequency']/(1000)." GHz <br>";
   //echo $API->read('cpu');

   $API->disconnect();

   
   
   $host="103.146.17.2";

      exec("ping -c 1 " . $host, $output, $result);

      //print_r($output);

      if ($result == 0)

      echo "Ping successful!";

      else

      echo "Ping unsuccessful!";

}

?>
