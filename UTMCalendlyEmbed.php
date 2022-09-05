<?php
/*
Plugin Name:    UTM Calendly Embed
Description:    For adding UTM parameters to calendly 
Version:        1.0.0
Author:         Sam Peret
Author URI:     https://www.samperet.com
License:        GPL-2.0+
License URI:    http://www.gnu.org/licenses/gpl-2.0.txt
*/

function calendly( $atts ) {
extract(
    shortcode_atts(
        array(
            'event_url'=>'',
            'styling_parameters' => '&amp;hide_event_type_details=1&amp;hide_gdpr_banner=1&amp;background_color=f5f4f1&amp;text_color=01655e&amp;primary_color=083744',    
        ), 
        $atts
    )
);
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url_components = parse_url($url); 
parse_str($url_components['query'], $params);

$utm_source   = $params['utm_source'];
$utm_medium   = $params['utm_medium'];
$utm_campaign = $params['utm_campaign'];
$utm_content  = $params['utm_content'];
$utm_term     = $params['utm_term'];

$utm_strings = '&utm_source='.$utm_source.'&utm_medium='.$utm_medium.'&utm_campaign='.$utm_campaign.'&utm_content='.$utm_content.'&utm_term='.$utm_term;
// $utm_strings = '&utm_source='.$utm_source;

$html= '<!-- Calendly inline widget begin -->
            <div class="calendly-inline-widget" data-url="'.$event_url.'?'.$utm_strings.$styling_parameters.'" style="min-width: 320px; height: 630px;"></div>
            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async=""></script>
        <!-- Calendly inline widget end -->';

return $html;
}
add_shortcode( 'calendly', 'calendly' );