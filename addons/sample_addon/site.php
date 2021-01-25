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
        $document->addStyleSheet("https://unpkg.com/leaflet@1.3.4/dist/leaflet.css", array(), ['integrity' => 'sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==','crossorigin' => '']);
        $document->addScript("https://unpkg.com/leaflet@1.3.4/dist/leaflet.js", array(), ['integrity' => 'sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==','crossorigin' => '']);
        $class      = (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
        $this->map_id = 'sppb-addon-'.$this->addon->id;

        $output = '';

        return $output;
    }
    public function js() {
        $location_count = count($this->addon->settings->sp_location_item);
        $map_zoom      = (isset($this->addon->settings->map_zoom) && $this->addon->settings->map_zoom) ? $this->addon->settings->map_zoom : '10';
        $map_scroll      = (isset($this->addon->settings->map_scroll) && $this->addon->settings->map_scroll) ? $this->addon->settings->map_scroll : 'true';
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
           var mymap = L.map('".$this->map_id."').setView(".$centr.", ".$map_zoom.");
           L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a> contributors, Imagery © <a href=\"https://www.mapbox.com/\">Mapbox</a>',    
            }).addTo(mymap);
            var marker = L.marker(".$centr.").addTo(mymap);
            var polygon = L.polygon(".$cordints.").addTo(mymap);
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