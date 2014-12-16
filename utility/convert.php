<?php
require('phpcoord.lib.php');

$input = new SplFileObject("E_N.csv");
$input->setFlags(SplFileObject::READ_CSV + SplFileObject::READ_AHEAD);

$output = new SplFileObject('E_N_LAT_LNG.csv', 'w+');

foreach ($input as $row) {
	$os = new OSRef($row[0],$row[1]);
	$ll = $os->toLatLng();
	$ll->OSGB36ToWGS84();
	// output
	$output->fputcsv([$row[0],$row[1],$ll->lat,$ll->lng]);
	echo '.';
}
