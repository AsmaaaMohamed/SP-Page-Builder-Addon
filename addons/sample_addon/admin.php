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
        'addon_name'=>'sample_addon',
        'title'=> 'Sample Addon',
        'desc'=> 'Sample addon for SP Page Builder',
        'icon'=>JURI::root() . 'plugins/sppagebuilder/addon/addons/sample_addon/assets/images/icon.png',
        'category'=>'MyAddons',
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
                    'title'=>JText::_('COM_SPPAGEBUILDER_MAP_HEIGHT'),
                    'std'=>100,
                    'max'=>2000,
                    'responsive' => true,
                ),
                'map_zoom'=>array(
                    'type'=>'slider',
                    'title'=>JText::_('COM_SPPAGEBUILDER_MAP_HEIGHT'),
                    'std'=>10,
                    'max'=>20,
                ),
                'sp_location_item'=>array(
                    'title'=>JText::_('PLG_SPPAGEBUILDER_ADDON_LOCATION'),
                    'attr'=>array(
                        'title'=>array(
                            'type'=>'text',
                            'title'=>JText::_('PLG_SPPAGEBUILDER_ADDON_LOCATION'),
                            'desc'=>JText::_('PLG_SPPAGEBUILDER_ADDON_LOCATION_DESC'),
                            'std'=>'Location Title',
                        ),
                        'latitude'=>array(
                            'type'=>'text',
                            'title'=>JText::_('PLG_SPPAGEBUILDER_ADDON_LAT'),
                            'desc'=>JText::_('PLG_SPPAGEBUILDER_ADDON_LAT_DESC'),
                            'std'=>  '000000000 00000'
                        ),
                        'longitude'=>array(
                            'type'=>'text',
                            'title'=>JText::_('PLG_SPPAGEBUILDER_ADDON_LNG'),
                            'desc'=>JText::_('PLG_SPPAGEBUILDER_ADDON_LNG_DESC'),
                            'std'=>  '000000000 0000'
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