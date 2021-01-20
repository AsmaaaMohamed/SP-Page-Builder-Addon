<?php
/**
 * @package SP Page Builder
 * @author JoomReem - https://www.joomreem.com
 * @copyright Copyright (C) 2020 JoomReem All rights reserved.
 * @license GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
 */

//no direct accees
defined('_JEXEC') or die('Restricted Aceess');
use Joomla\CMS\Factory;

class SppagebuilderAddonSample_addon extends SppagebuilderAddons {
    protected  $map_id ='';
    public function render() {
        $document = Factory::getDocument();
        $document->addScript("https://polyfill.io/v3/polyfill.min.js?features=default");

        $class      = (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
        $this->map_id = 'sppb-addon-'.$this->addon->id;
        $document->addScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyANP28FGbJ_v3xkK70yJjY01mTSiWkNR18&callback=initMap&libraries=&v=weekly",array(), array("defer" => "defer"));
        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-sample' . $class . '" id ="'.$this->map_id.'">';


        $output .= '</div>';

        return $output;
    }
    public function js() {
        $location_count = count($this->addon->settings->sp_location_item);
        $cordints = '[';
        if(isset($this->addon->settings->sp_location_item) && is_array($this->addon->settings->sp_location_item) && $location_count){
            $latSum =0;
            $lngSum = 0;
            foreach ($this->addon->settings->sp_location_item as $key => $item) {

                if(isset($item->latitude) && $item->latitude != '' && isset($item->longitude) && $item->longitude != '') {
                    $cordints .=  "{ lat:". $item->latitude.", lng:".$item->longitude."},";
                    $latSum += $item->latitude;
                    $lngSum += $item->longitude;
                }
            }
            $cordints .= ']';
            $centr = "{lat:".$latSum/$location_count.",lng:".$lngSum/$location_count."}";
        }
        $js = "let map;
                let infoWindow;
                
                function initMap() {
                  map = new google.maps.Map(document.getElementById('".$this->map_id."'), {
                    zoom: 5,
                    center: ".$centr.",
                    mapTypeId: \"terrain\",
                  });
                  // Define the LatLng coordinates for the polygon.
                  const triangleCoords = ".$cordints.";
             
                  // Construct the polygon.
                  const bermudaTriangle = new google.maps.Polygon({
                    paths: triangleCoords,
                    strokeColor: \"#FF0000\",
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillColor: \"#FF0000\",
                    fillOpacity: 0.35,
                  });
                  bermudaTriangle.setMap(map);
                  // Add a listener for the click event.
                  bermudaTriangle.addListener(\"click\", showArrays);
                  infoWindow = new google.maps.InfoWindow();
                }
                
                function showArrays(event) {
                  // Since this polygon has only one path, we can call getPath() to return the
                  // MVCArray of LatLngs.
                  const polygon = this;
                  const vertices = polygon.getPath();
                  let contentString =
                    \"<b>Bermuda Triangle polygon</b><br>\" +
                    \"Clicked location: <br>\" +
                    event.latLng.lat() +
                    \",\" +
                    event.latLng.lng() +
                    \"<br>\";

                  // Iterate over the vertices.
                  for (let i = 0; i < vertices.getLength(); i++) {
                    const xy = vertices.getAt(i);
                    contentString +=
                      \"<br>\" + \"Coordinate \" + i + \":<br>\" + xy.lat() + \",\" + xy.lng();
                  }
                  // Replace the info window's content and position.
                  infoWindow.setContent(contentString);
                  infoWindow.setPosition(event.latLng);
                  infoWindow.open(map);
                }";
        return $js;
    }

    public function css() {
        $addon_id = '#'.$this->map_id;
        $height = '';
        $height_sm='';
        $height_xs='';

        $height  .= (isset($this->addon->settings->map_height) && $this->addon->settings->map_height) ? 'height: ' . $this->addon->settings->map_height  . 'px; ' : '100px';
        $height_sm .= (isset($this->addon->settings->map_height_sm) && $this->addon->settings->map_height_sm) ? 'height: ' . $this->addon->settings->map_height_sm  . 'px; ' : '';
        $height_xs .= (isset($this->addon->settings->map_height_xs) && $this->addon->settings->map_height_xs) ? 'height: ' . $this->addon->settings->map_height_xs  . 'px; ' : '';


        $css = '';

        if($height){
            $css .= $addon_id . '{' . $height . '}';
        }
        if($height_sm){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            $css .= $addon_id . '{' . $height_sm . '}';
            $css .= '}';
        }
        if($height_xs){
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            $css .= $addon_id . '{' . $height_xs . '}';
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate() {
        return false;
    }
}