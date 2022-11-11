<?php
/*
  Plugin Name: gem-services
  Plugin URI: https://github.com/Trifoia/wordpress-shaka-player
  description: WordPress plugin that allows embedding of the gem-services via shortcode
  Version: 1.0.0
  Author: comunicacion social
  Author URI: https://trifoia.com
*/

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include( PLUGIN_PATH . 'php/embed-html-factory.php' );
include( PLUGIN_PATH . 'settings.php' );

function gem_noticias_vertical_function()
{
	$content = file_get_contents('http://morelos.gob.mx/rest/administracion_carrusel_vertical_ws.json');
	$data = json_decode($content);

	
	$html = '';
	foreach($data as $boletin) {
		$html .= '<div class="row slider-news">';
		$html .= '<div class="col-md-3">';
		$html .= '<img style="padding-right:10px" src="'.$boletin->imagen_small.'">';
		$html .= '</div>';
		$html .= '<div class="col-md-9">';
		$html .= '<a href="http://morelos.gob.mx/?q=node/'.$boletin->url_enlace.'"><h3>'.$boletin->titulo_boletin.'</h3></a>';
		$html .= '<span>Fecha: '.date('d/m/Y', $boletin->field_date).'</span>';
		$html .= '</div>';
		$html .= '</div>';
	}
	
	$html .= '<div style="text-align: center; padding-top: 20px">';
	$html .= '<a class="btn btn-success" href="#">Ver más noticias</a>';
	$html .= '</div>';
	return $html;
}

add_shortcode('gem_noticias_vertical', 'gem_noticias_vertical_function');