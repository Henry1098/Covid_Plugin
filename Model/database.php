<?php
    require_once(ABSPATH."wp-admin/includes/upgrade.php");

function createDB()
{
    global $wpdb;

    $db = $wpdb->prefix. "db_covid";
    $query ="CREATE TABLE $db( 
        id int(6) NOT NULL AUTO_INCREMENT,
        code varchar(30) ,
        nom varchar(30),
        hospitalises int(30),
        reanimation	int(30),
	nouvellesHospitalisations	int(30),
	nouvellesReanimations	int(30),
	deces	int(30),
	gueris	int(30),
    PRIMARY KEY(id)
    )";

    dbDelta($query);
}

function insertDB($code,$nom,$hospitalises,$reanimation,$nouvellesHospitalisations,$nouvellesReanimations,$deces,$gueris)
{
    global $wpdb;

    $table_name = $wpdb->prefix. "db_covid";

    $wpdb->insert($table_name, array('id' => NULL,'code' => $code, 'nom' => $nom, 'hospitalises' => $hospitalises, 'reanimation' => $reanimation, 'nouvellesHospitalisations' => $nouvellesHospitalisations,'nouvellesReanimations' => $nouvellesReanimations, 'deces' => $deces, 'gueris' => $gueris)); 

}