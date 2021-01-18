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
        'icon'=>JURI::root() . 'plugins/sppagebuilder/demo/addons/sample_addon/assets/images/icon.png',
        'category'=>'MyAddons',
        'attr'=>array(
            'general' => array(
                'admin_label'=>array(
                    'type'=>'text',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
                    'std'=> ''
                ),
                // Title
                'title'=>array(
                    'type'=>'textarea',
                    'title'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE'),
                    'desc'=>JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
                    'std'=>  'This is sample title'
                ),
                'addon_icon'=>array(
                    'type'=>'icon',
                    'title'=>'Icon',
                    'depends'=>array(array('title', '!=', '')),
                ),
                'addon_link'=>array(
                    'type'=>'media',
                    'format'=>'attachment',
                    'title'=>'Link',
                    'placeholder'=>'http://',
                    'std'=>'',
                    'hide_preview'=>true,
                ),
                'addon_font_family'=>array(
                    'type'=>'fonts',
                    'title'=>'Font Family',
                    'depends'=>array(array('title', '!=', '')),
                    'selector'=> array(
                        'type'=>'font',
                        'font'=>'{{ VALUE }}',
                        'css'=>'.sppb-addon-title { font-family: {{ VALUE }}; }'
                    )
                ),
                'addon_fontsize'=>array(
                    'type'=>'slider',
                    'title'=>'Font Size',
                    'std'=>'',
                    'max'=>400,
                    'responsive'=>true
                ),
                'addon_lineheight'=>array(
                    'type'=>'slider',
                    'title'=>'Line Height',
                    'std'=>'',
                    'max'=>400,
                    'responsive'=>true
                ),

                'addon_font_style'=>array(
                    'type'=>'fontstyle',
                    'title'=>'Font Style',
                    'depends'=>array(array('title', '!=', '')),
                ),
                'addon_margin'=>array(
                    'type'=>'margin',
                    'title'=>'Margin',
                    'std' => '0px 0px 30px 0px',
                    'responsive'=>true
                ),
                'addon_padding'=>array(
                    'type'=>'padding',
                    'title'=>'Padding',
                    'std' => '0px 0px 0px 0px',
                    'responsive'=>true
                ),

                // Content
                'content'=>array(
                    'type'=>'editor',
                    'title'=>JText::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
                    'std'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer adipiscing erat eget risus sollicitudin pellentesque et non erat. Maecenas nibh dolor, malesuada et bibendum a, sagittis accumsan ipsum. Pellentesque ultrices ultrices sapien, nec tincidunt nunc posuere ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam scelerisque tristique dolor vitae tincidunt. Aenean quis massa uada mi elementum elementum. Nec sapien convallis vulputate rhoncus vel dui.'
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