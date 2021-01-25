<?php
/**
 * @package SP Page Builder
 *  @author JoomReem - https://www.joomreem.com
 * @copyright Copyright (C) 2020 JoomReem All rights reserved.
 * @license GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
 */

//no direct accees
defined('_JEXEC') or die('Restricted Aceess');

SpAddonsConfig::addonConfig(
    array(
        'type'=>'content',
        'addon_name'=>'advancedmaps',
        'title'=> 'Advanced Maps Addon',
        'desc'=> 'SP Page Builder addon to display advanced maps using OSM',
        'icon'=>JURI::root() . 'plugins/sppagebuilder/advancedmaps/addons/advancedmaps_addon/assets/images/icon.png',
        'category'=>'JoomReem Addons',
        'attr'=>array(
            'general' => array(
                'admin_label'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                    'std'=> ''
                ),
                'map_height'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GMAP_HEIGHT'),
                    'std'=>100,
                    'max'=>2000,
                    'responsive' => true,
                ),
                'map_zoom'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GMAP_ZOOM'),
                    'std'=>10,
                    'max'=>20,
                ),
                'map_scroll'=>array(
                    'type'=>'select',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_GMAP_DISABLE_MOUSE_SCROLL'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_GMAP_DISABLE_MOUSE_SCROLL_DESC'),
                    'values'=>array(
                        'false'=>JText::_('JYES'),
                        'true'=>JText::_('JNO'),
                    ),
                    'std'=>'true',
                ),
                'sp_location_item'=>array(
                    'title'=>JText::_('PLG_SPPAGEBUILDER_ADVANCED_MAPS_LOCATION'),
                    'attr'=>array(
                        'title'=>array(
                            'type'=>'text',
                            'title'=>JText::_('PLG_SPPAGEBUILDER_ADVANCED_MAPS_LOCATION'),
                            'desc'=>JText::_('PLG_SPPAGEBUILDER_ADVANCED_MAPS_LOCATION_DESC'),
                            'std'=>'Location Title',
                        ),
                        'latitude'=>array(
                            'type'=>'text',
                            'title'=>JText::_('PLG_SPPAGEBUILDER_ADVANCED_MAPS_LAT'),
                            'desc'=>JText::_('PLG_SPPAGEBUILDER_ADVANCED_MAPS_LAT_DESC'),
                            'std'=>  '00.00'
                        ),
                        'longitude'=>array(
                            'type'=>'text',
                            'title'=>JText::_('PLG_SPPAGEBUILDER_ADVANCED_MAPS_LNG'),
                            'desc'=>JText::_('PLG_SPPAGEBUILDER_ADVANCED_MAPS_LNG_DESC'),
                            'std'=>  '00.00'
                        ),
                    ),
                ),

                'class'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
                    'std'=>''
                ),

            ),
        ),
    )
);