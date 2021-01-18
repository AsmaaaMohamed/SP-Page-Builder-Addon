<?php
/**
 * @package SP Page Builder
 * @author JoomReem - https://www.joomreem.com
 * @copyright Copyright (C) 2020 JoomReem All rights reserved.
 * @license GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
 */

//no direct accees
defined('_JEXEC') or die('Restricted Aceess');

class SppagebuilderAddonSample_addon extends SppagebuilderAddons {

    public function render() {
        $class      = (isset($this->addon->settings->class) && $this->addon->settings->class) ? ' ' . $this->addon->settings->class : '';
        $title      = (isset($this->addon->settings->title) && $this->addon->settings->title) ? $this->addon->settings->title : '';
        $addon_link = (isset($this->addon->settings->addon_link) && $this->addon->settings->addon_link) ? $this->addon->settings->addon_link : '';
        $addon_icon = (isset($this->addon->settings->addon_icon) && $this->addon->settings->addon_icon) ? $this->addon->settings->addon_icon : '';

        $output = '';
        $output .= '<div class="sppb-addon sppb-addon-sample' . $class . '">';
        if($title) {
            $output .= '<h1 class="sppb-addon-title">';
            $output .= (!empty($addon_link)) ? '<a href="' . $addon_link . '">' : '';
            $output .= (!empty($addon_icon)) ? '<i class="fa ' . $addon_icon . '"></i> ' : '';
            $output .= (!empty($title)) ? $title : '';
            $output .= (!empty($addon_link)) ? '</a>' : '';
            $output .= '</h1>';
        }

        $output .= '</div>';

        return $output;
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;

        $style = '';
        $style_sm = '';
        $style_xs = '';

        $style .= (isset($this->addon->settings->addon_margin) && $this->addon->settings->addon_margin) ?  SppagebuilderHelperSite::getPaddingMargin($this->addon->settings->addon_margin, 'margin') : '';
        $style_sm .= (isset($this->addon->settings->addon_margin_sm) && $this->addon->settings->addon_margin_sm) ?  SppagebuilderHelperSite::getPaddingMargin($this->addon->settings->addon_margin_sm, 'margin') : '';
        $style_xs .= (isset($this->addon->settings->addon_margin_xs) && $this->addon->settings->addon_margin_xs) ?  SppagebuilderHelperSite::getPaddingMargin($this->addon->settings->addon_margin_xs, 'margin') : '';

        $style .= (isset($this->addon->settings->addon_padding) && $this->addon->settings->addon_padding) ? SppagebuilderHelperSite::getPaddingMargin($this->addon->settings->addon_padding, 'padding') : '';
        $style_sm .= (isset($this->addon->settings->addon_padding_sm) && $this->addon->settings->addon_padding_sm) ? SppagebuilderHelperSite::getPaddingMargin($this->addon->settings->addon_padding_sm, 'padding') : '';
        $style_xs .= (isset($this->addon->settings->addon_padding_xs) && $this->addon->settings->addon_padding_xs) ? SppagebuilderHelperSite::getPaddingMargin($this->addon->settings->addon_padding_xs, 'padding') : '';

        $style .= (isset($this->addon->settings->addon_fontsize) && $this->addon->settings->addon_fontsize) ? 'font-size: ' . $this->addon->settings->addon_fontsize  . 'px; ' : '';
        $style_sm .= (isset($this->addon->settings->addon_fontsize_sm) && $this->addon->settings->addon_fontsize_sm) ? 'font-size: ' . $this->addon->settings->addon_fontsize_sm  . 'px; ' : '';
        $style_xs .= (isset($this->addon->settings->addon_fontsize_xs) && $this->addon->settings->addon_fontsize_xs) ? 'font-size: ' . $this->addon->settings->addon_fontsize_xs  . 'px; ' : '';

        $style .= (isset($this->addon->settings->addon_lineheight) && $this->addon->settings->addon_lineheight) ? 'line-height: ' . $this->addon->settings->addon_lineheight  . 'px; ' : '';
        $style_sm .= (isset($this->addon->settings->addon_lineheight_sm) && $this->addon->settings->addon_lineheight_sm) ? 'line-height: ' . $this->addon->settings->addon_lineheight_sm  . 'px; ' : '';
        $style_xs .= (isset($this->addon->settings->addon_lineheight_xs) && $this->addon->settings->addon_lineheight_xs) ? 'line-height: ' . $this->addon->settings->addon_lineheight_xs  . 'px; ' : '';

        // Font Style
        if(isset($addon->settings->addon_font_style->underline) && $addon->settings->addon_font_style->underline) {
            $style .= 'text-decoration: underline;';
        }

        if(isset($addon->settings->addon_font_style->italic) && $addon->settings->addon_font_style->italic) {
            $style .= 'font-style: italic;';
        }

        if(isset($addon->settings->addon_font_style->uppercase) && $addon->settings->addon_font_style->uppercase) {
            $style .= 'text-transform: uppercase;';
        }

        if(isset($addon->settings->addon_font_style->weight) && $addon->settings->addon_font_style->weight) {
            $style .= 'font-weight: ' . $addon->settings->addon_font_style->weight . ';';
        }

        $css = '';
        if ($style) {
            $css .= $addon_id . ' .sppb-addon-title {' . $style . '}';
        }

        if ($style_sm) {
            $css .= '@media (min-width: 768px) and (max-width: 991px) {';
            $css .= $addon_id . ' .sppb-addon-title {' . $style_sm . '}';
            $css .= '}';
        }

        if ($style_xs) {
            $css .= '@media (max-width: 767px) {';
            $css .= $addon_id . ' .sppb-addon-title {' . $style_xs . '}';
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate() {
        return false;
    }
}