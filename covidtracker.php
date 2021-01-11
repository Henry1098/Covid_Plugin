<?php
/* 
Plugin Name: covidtracker
Plugin URI: https://www.google.fr
Author: Henry Nzinga
Version: 1.0 
Author URI: https://www.google.fr
*/
defined('ABSPATH') or die('Oups !');
// Hook to the 'init' action, which is called after WordPress is finished loading the core code

include_once("Model/database.php");


if(isset($_POST['MAJ']))
    {
        $curl = curl_init("https://coronavirusapi-france.now.sh/AllLiveData");
        curl_setopt_array($curl,[CURLOPT_CAINFO =>__DIR__.DIRECTORY_SEPARATOR.'\certif\certif.cer',
        CURLOPT_RETURNTRANSFER=>true]);
    
        $data = curl_exec($curl);
        if($data == false)
        {
            var_dump(curl_error($curl));
        }else
            {
            if(curl_getinfo($curl,CURLINFO_HTTP_CODE)=== 200){
            $data = json_decode($data,true);
                
            for($i=0;$i<count($data['allLiveFranceData']);$i++){
            insertDB($data['allLiveFranceData'][$i]['code'] ,
            $data['allLiveFranceData'][$i]['nom'] ,
           $data['allLiveFranceData'][$i]['hospitalises'] ,
           $data['allLiveFranceData'][$i]['reanimation'],
            $data['allLiveFranceData'][$i]['nouvellesHospitalisations'],
            $data['allLiveFranceData'][$i]['nouvellesReanimations'] ,
            $data['allLiveFranceData'][$i]['deces'] ,
            $data['allLiveFranceData'][$i]['gueris']);
        }
        }
        }
        curl_close($curl);
    }

register_activation_hook(__FILE__,"createDB");

function tbare_wordpress_plugin_demo($atts) {
	$Content = "<style>\r\n";
	$Content .= "h3.demoClass {\r\n";
	$Content .= "color: #26b158;\r\n";
	$Content .= "}\r\n";
	$Content .= "</style>\r\n";
	$Content .= '<h3 class="demoClass">Check it out!</h3>';
	 
    return $Content;
}
add_shortcode('tbare-plugin-demo', 'tbare_wordpress_plugin_demo');

function my_admin_menu() {
    add_menu_page(
        __( 'Covid Tracker', 'my-textdomain' ),
        __( 'Covid Tracker', 'my-textdomain' ),
        'manage_options',
        'sample-page',
        'my_admin_page_contents',
        'dashicons-schedule',
        3
    );
}

add_action( 'admin_menu', 'my_admin_menu' );



function my_admin_page_contents() {
    ?>
        <h1>
           Bienvenue au Covid Tracker!
        </h1>
        <h3>Le Covid Tracker permet de tracker le Covid dans les regions et les departements</h3>

<form action="" method="POST"> 
<h3>Pour mettre à jour les données</h3>

<input type="submit" value="Mettre à jour" name="MAJ">
       </form>

    <h3>Veuillez séléctionner une option pour générer un shortcode</h3>

       <select name="choix" id="choix">
    <option value="">--Please choose an option--</option>
    <option value="departement">Departement</option>
    <option value="region">Région</option>
    <option value="departements">Departements</option>
    <option value="displayWidthSearchBar">displayWidthSearchBar</option>
</select>
       <button onclick="selection()">Click me</button>


<div id="short"></div>

<script>
function selection(){
var e = document.getElementById("choix");
var strUser = e.value;

document.getElementById('short').innerHTML="<h3>Voici votre shortcode à utiliser:</h3> ["+strUser+"]";

}</script>

        <?php
    }
    
    