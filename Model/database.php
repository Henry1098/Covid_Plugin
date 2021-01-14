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

function viderDB()
{

    global $wpdb;
    $wpdb->query('TRUNCATE TABLE wp_db_covid');
}


function allDepartements()
{
    global $wpdb;

    $Contenu = "<!doctype html>";
    $Contenu .= '<html lang="en">';
    $Contenu .= '  <head>';
    $Contenu .= '    <!-- Required meta tags -->';
    $Contenu .= '    <meta charset="utf-8">';
    $Contenu .= '    <meta name="viewport" content="width=device-width, initial-scale=1">';
    $Contenu .= '    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">';
    $Contenu .= '    </head>';
    $Contenu .= '  <body>';
    $Contenu .= ' <table class="table">';
    $Contenu .= '        <thead>';
    $Contenu .= '          <tr>';
    $Contenu .= '            <th scope="col">Nom</th>';
    $Contenu .= '            <th scope="col">Hospitalises</th>';
    $Contenu .= '            <th scope="col">Reanimation</th>';
    $Contenu .= '            <th scope="col">Nouvelles Hospitalisations</th>';
    $Contenu .= '            <th scope="col">Nouvelles Reanimations</th>';
    $Contenu .= '            <th scope="col">Deces</th>';
    $Contenu .= '            <th scope="col">Guéris</th>';
    $Contenu .= '          </tr>';
    $Contenu .= '        </thead>';
    $Contenu .= '        <tbody>';
    ?>
            <?php
    
    
        $resultats = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}db_covid WHERE code LIKE 'dep%'");
        foreach ($resultats as $post) {
    
            
       
            $Contenu .= '<tr>';
            ?>    
    
            <?php
            $Contenu .="<td>".$post->nom."</td>";
            $Contenu .="<td>".$post->hospitalises."</td>";
            $Contenu .="<td>".$post->reanimation."</td>";
            $Contenu .="<td>".$post->nouvellesHospitalisations."</td>";
            $Contenu .="<td>".$post->nouvellesReanimations."</td>";
            $Contenu .="<td>".$post->deces."</td>";
            $Contenu .="<td>".$post->gueris."</td>";
            $Contenu .=" </tr>
        ";
           }
           $Contenu .="</tbody>";
           $Contenu .="</table>";
           $Contenu .="</body>";
           $Contenu .="</html>";
    
           return $Contenu;
}


function allRegionsAtt($att)
{
    global $wpdb;

    $resultats = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}db_covid WHERE nom = '$att' AND code LIKE 'reg%'");
    return $resultats;

}

function allRegions()
{
    global $wpdb;

$Contenu = "<!doctype html>";
$Contenu .= '<html lang="en">';
$Contenu .= '  <head>';
$Contenu .= '    <!-- Required meta tags -->';
$Contenu .= '    <meta charset="utf-8">';
$Contenu .= '    <meta name="viewport" content="width=device-width, initial-scale=1">';
$Contenu .= '    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">';
$Contenu .= '    </head>';
$Contenu .= '  <body>';
$Contenu .= ' <table class="table">';
$Contenu .= '        <thead>';
$Contenu .= '          <tr>';
$Contenu .= '            <th scope="col">Nom</th>';
$Contenu .= '            <th scope="col">Hospitalises</th>';
$Contenu .= '            <th scope="col">Reanimation</th>';
$Contenu .= '            <th scope="col">Nouvelles Hospitalisations</th>';
$Contenu .= '            <th scope="col">Nouvelles Reanimations</th>';
$Contenu .= '            <th scope="col">Deces</th>';
$Contenu .= '            <th scope="col">Guéris</th>';
$Contenu .= '          </tr>';
$Contenu .= '        </thead>';
$Contenu .= '        <tbody>';
?>
        <?php


    $resultats = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}db_covid WHERE code LIKE 'reg%'");
    foreach ($resultats as $post) {

        
   
        $Contenu .= '<tr>';
        ?>    

        <?php
        $Contenu .="<td>".$post->nom."</td>";
        $Contenu .="<td>".$post->hospitalises."</td>";
        $Contenu .="<td>".$post->reanimation."</td>";
        $Contenu .="<td>".$post->nouvellesHospitalisations."</td>";
        $Contenu .="<td>".$post->nouvellesReanimations."</td>";
        $Contenu .="<td>".$post->deces."</td>";
        $Contenu .="<td>".$post->gueris."</td>";
        $Contenu .=" </tr>
";
       }
       $Contenu .="</tbody>";
       $Contenu .="</table>";
       $Contenu .="</body>";
       $Contenu .="</html>";

       return $Contenu;
}

function Region($attr,$content = null)
{
    global $wpdb;
    if(!empty($attr['s']))
    $regions=allRegionsAtt($attr['s']);
    else
    $atts['s']	= '';

				 if(empty($regions)){
       return "<p>Aucune région avec ce nom trouvée !</p>";
    }
    
    $Contenu = "<!doctype html>";
    $Contenu .= '<html lang="en">';
    $Contenu .= '  <head>';
    $Contenu .= '    <!-- Required meta tags -->';
    $Contenu .= '    <meta charset="utf-8">';
    $Contenu .= '    <meta name="viewport" content="width=device-width, initial-scale=1">';
    $Contenu .= '    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">';
    $Contenu .= '    </head>';
    $Contenu .= '  <body>';
    $Contenu .= ' <table class="table">';
    $Contenu .= '        <thead>';
    $Contenu .= '          <tr>';
    $Contenu .= '            <th scope="col">Nom</th>';
    $Contenu .= '            <th scope="col">Hospitalises</th>';
    $Contenu .= '            <th scope="col">Reanimation</th>';
    $Contenu .= '            <th scope="col">Nouvelles Hospitalisations</th>';
    $Contenu .= '            <th scope="col">Nouvelles Reanimations</th>';
    $Contenu .= '            <th scope="col">Deces</th>';
    $Contenu .= '            <th scope="col">Guéris</th>';
    $Contenu .= '          </tr>';
    $Contenu .= '        </thead>';
    $Contenu .= '        <tbody>';
    ?>
            <?php
    
    
        foreach ($regions as $post) {
    
            
       
            $Contenu .= '<tr>';
            ?>    
    
            <?php
            $Contenu .="<td>".$post->nom."</td>";
            $Contenu .="<td>".$post->hospitalises."</td>";
            $Contenu .="<td>".$post->reanimation."</td>";
            $Contenu .="<td>".$post->nouvellesHospitalisations."</td>";
            $Contenu .="<td>".$post->nouvellesReanimations."</td>";
            $Contenu .="<td>".$post->deces."</td>";
            $Contenu .="<td>".$post->gueris."</td>";
            $Contenu .=" </tr>
    ";
           }
           $Contenu .="</tbody>";
           $Contenu .="</table>";
           $Contenu .="</body>";
           $Contenu .="</html>";
    
           return $Contenu;
}
function RegionSearch()
{
    global $wpdb;
  
    $resultats = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}db_covid WHERE code LIKE 'reg%'");

    $Contenu = "<!doctype html>";
    $Contenu .= '<html lang="en">';
    $Contenu .= '  <head>';
    $Contenu .= '    <!-- Required meta tags -->';
    $Contenu .= '    <meta charset="utf-8">';
    $Contenu .= '    <meta name="viewport" content="width=device-width, initial-scale=1">';
    $Contenu .= '    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">';
    $Contenu .= '  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
    $Contenu .= '    </head>';
    $Contenu .= '  <body>';
    $Contenu .= '<select name="sel" id="selection">';
    $Contenu .= '    <option value="">--Veuillez séléctionner une région--</option>';
    foreach ($resultats as $post) {
        $Contenu .=' <option value="'.$post->nom.'">'.$post->nom.'</option>"';
    }    
    $Contenu .= '</select>';
    $Contenu .= ' <table class="table">';
    $Contenu .= '        <thead>';
    $Contenu .= '          <tr>';
    $Contenu .= '            <th scope="col">Nom</th>';
    $Contenu .= '            <th scope="col">Hospitalises</th>';
    $Contenu .= '            <th scope="col">Reanimation</th>';
    $Contenu .= '            <th scope="col">Nouvelles Hospitalisations</th>';
    $Contenu .= '            <th scope="col">Nouvelles Reanimations</th>';
    $Contenu .= '            <th scope="col">Deces</th>';
    $Contenu .= '            <th scope="col">Guéris</th>';
    $Contenu .= '          </tr>';
    $Contenu .= '        </thead>';
    $Contenu .= '        <tbody id="myTable">';
    ?>
            <?php
    
    
        foreach ($resultats as $post) {
    
            
       
            $Contenu .= '<tr>';
            ?>    
    
            <?php
            $Contenu .="<td>".$post->nom."</td>";
            $Contenu .="<td>".$post->hospitalises."</td>";
            $Contenu .="<td>".$post->reanimation."</td>";
            $Contenu .="<td>".$post->nouvellesHospitalisations."</td>";
            $Contenu .="<td>".$post->nouvellesReanimations."</td>";
            $Contenu .="<td>".$post->deces."</td>";
            $Contenu .="<td>".$post->gueris."</td>";
            $Contenu .=" </tr>
    ";
           }
        
           $Contenu .="</tbody>";
           
           $Contenu .="</table>";
           $Contenu .="</body>";
           $Contenu .="</html>";
    
           return $Contenu;
}