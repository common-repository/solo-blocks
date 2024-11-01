<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Icons;

class Icon_List_Item extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *     icon: array,
	 *     iconViewType: string,
	 *     iconSize: string,
	 *     iconColor: string,
	 *     iconBackground: string,
	 *     iconBorder: string,
	 *     iconBorderWidth: string,
	 *     iconBorderColor: string,
	 *     iconBorderRadius: string,
	 *     iconPadding: string,
	 *     text: string,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){
		
		$className[] = "sb-icon_view_type-".$this->attributes['iconViewType'];
		
		CSS_Vars::add(
			$this->selector.' .sb-icon_container .sb_icon',
			array(
				'width' => $this->attributes['iconSize'].'px',
				'color' => $this->attributes['iconColor']
			)
		);
		
		CSS_Vars::add(
			$this->selector.'.sb-icon_view_type-framed .sb-icon_container .sb_icon',
			array(
				'background-color' => $this->attributes['iconBackground'],
				'border-style'     => $this->attributes['iconBorder'],
				'border-width'     => $this->attributes['iconBorderWidth'].'px',
				'border-color'     => $this->attributes['iconBorderColor'],
				'border-radius'    => $this->attributes['iconBorderRadius'].'%',
				'padding'          => $this->attributes['iconPadding'].'px'
			)
		);
		
		$icon = '<div class="sb-icon_container">'.
		        '<span class="sb_icon">'.
		        '<span class="sb_icon_wrap">'.
		        Icons::getIcon($this->attributes['icon']).
		        '</span>'.
		        '</span>'.
		        '</div>';
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		echo '<div '.$this->get_render_attribute_string().'>'. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		     $icon. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		     '<div class="sb-icon-list-description">'.wp_kses_post($this->attributes['text']).'</div>'.
		     '</div>';
	}
}
