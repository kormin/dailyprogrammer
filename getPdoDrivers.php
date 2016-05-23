<?php
/*
 * Author: https://github.com/kormin
 * Date Created: May 2016
 * Description: 
 * Resources:
 *
 */
foreach (PDO::getAvailableDrivers() as $driver) {
	echo "$driver <br>";
}