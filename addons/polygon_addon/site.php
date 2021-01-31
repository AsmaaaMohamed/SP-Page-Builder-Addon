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

class SppagebuilderAddonPolygon_addon extends SppagebuilderAddons {
    protected  $map_id ='';
    public function render() {
        $document = Factory::getDocument();
        $document->addStyleSheet("https://unpkg.com/leaflet@1.3.4/dist/leaflet.css", array(), ['integrity' => 'sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==','crossorigin' => '']);
        $document->addScript("https://unpkg.com/leaflet@1.3.4/dist/leaflet.js", array(), ['integrity' => 'sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==','crossorigin' => '']);
        $this->map_id = 'sppb-addon-'.$this->addon->id;

        $output = '';

        return $output;
    }
    public function js() {
        $location_count = count($this->addon->settings->sp_location_item);
        $map_zoom      = (isset($this->addon->settings->map_zoom) && $this->addon->settings->map_zoom) ? $this->addon->settings->map_zoom : '10';
        $map_scroll      = (isset($this->addon->settings->map_scroll) && $this->addon->settings->map_scroll) ? $this->addon->settings->map_scroll : 'true';
        $map_popup      = (isset($this->addon->settings->popup_info) && $this->addon->settings->popup_info) ? $this->addon->settings->popup_info : '';
        $selectedmaptype = (isset($this->addon->settings->map_type) && $this->addon->settings->map_type) ? $this->addon->settings->map_type : 'Default';
        $fill_color      = (isset($this->addon->settings->fill_color) && $this->addon->settings->fill_color) ? $this->addon->settings->fill_color : '#3388ff';
        $bound_color     = (isset($this->addon->settings->bound_color) && $this->addon->settings->bound_color) ? $this->addon->settings->bound_color : '#3388ff';
        $height  = (isset($this->addon->settings->map_height) && $this->addon->settings->map_height) ?  $this->addon->settings->map_height . 'px '  : '100px';
        $map_marker  = (isset($this->addon->settings->map_marker) && $this->addon->settings->map_marker) ?  $this->addon->settings->map_marker. '.png '  : 'blue-marker.png';
        if (isset($map_marker) && substr($map_marker,0, 4)==='leaf') {
            $icon = "iconUrl: '".JURI::root() ."plugins/sppagebuilder/advancedmaps/addons/assets/images/".$map_marker."',
            shadowUrl: '".JURI::root() ."plugins/sppagebuilder/advancedmaps/addons/assets/images/leaf-shadow.png',
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94],
            popupAnchor:  [-3, -76],
            shadowAnchor: [4, 62],";
        }
        elseif (isset($map_marker) ){
            $icon = "iconUrl: '".JURI::root() ."plugins/sppagebuilder/advancedmaps/addons/assets/images/".$map_marker."',
            iconAnchor:   [12, 40],
            popupAnchor:  [-3, -30],";
        }
        $cordints = '[';
        if(isset($this->addon->settings->sp_location_item) && is_array($this->addon->settings->sp_location_item) && $location_count){
            $latSum =0;
            $lngSum = 0;
            foreach ($this->addon->settings->sp_location_item as $key => $item) {

                if(isset($item->latitude) && $item->latitude != '' && isset($item->longitude) && $item->longitude != '') {
                    $cordints .=  "[". $item->latitude.",".$item->longitude."],";
                    $latSum += $item->latitude;
                    $lngSum += $item->longitude;
                }
            }
            $cordints .= ']';
            $centr = "[".$latSum/$location_count.",".$lngSum/$location_count."]";
        }
        $js = "window.addEventListener('load', function() {   
           document.getElementById(\"".$this->map_id."\").style.height = \"".$height."\";   
           var mymap = L.map('".$this->map_id."').setView(".$centr.", ".$map_zoom.");
           let maptypes ={
            'Default':'{s}.tile.osm.org',
            'OpenCycleMap':'tile.thunderforest.com/cycle',
            'Humanitariane':'a.tile.openstreetmap.fr/hot',
            'Bike':'tiles.wmflabs.org/hikebike',
            'Dark':'cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all'};
           L.tileLayer('https://'+maptypes['".$selectedmaptype."']+'/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors, Imagery © <a href=\"https://www.mapbox.com/\">Mapbox</a>',    
            }).addTo(mymap);
            var greenIcon = L.icon({".$icon."});
            var marker = L.marker(".$centr.", {icon: greenIcon}).addTo(mymap);
            var polygon = L.polygon(".$cordints."
            , {
            color: '".$bound_color."',
            fillColor: '".$fill_color."',
            fillOpacity: 0.5,
            }).addTo(mymap);
            if('".$map_popup."' != ''){
            polygon.bindPopup('".$map_popup."');
            marker.bindPopup('".$map_popup."').openPopup();
            }
            if(".$map_scroll." === false)
                mymap.scrollWheelZoom.disable();
                });";
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



        return $css;
    }

    public static function getTemplate() {
        return false;
    }
}