<?php
$string = 'http://www.mapquestapi.com/directions/v1/route?key=KEY&callback=renderAdvancedNarrative&ambiguities=ignore&avoidTimedConditions=false&doReverseGeocode=true&outFormat=json&routeType=fastest&timeType=1&enhancedNarrative=false&shapeFormat=raw&generalize=0&locale=en_US&unit=m&from=' . str_replace(' ', '%20',$_GET["from"]) . '&to=' . str_replace(' ', '%20',$_GET["to"]) . '&drivingStyle=2&highwayEfficiency=21.0';

$file = file_get_contents($string, true);

$jsonfile = substr($file, strpos($file, "route") -2, -2);

$object = json_decode($jsonfile);

echo $object->route->time;
?>
