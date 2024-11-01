<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Icon extends Basic {
	
	/**
	 * Attributes
	 *
	 * @var array{
	 *     align: string,
	 *     icon: string,
	 *     link: string,
	 *     icon_size: string,
	 *     icon_color: string,
	 *     icon_color_hover: string,
	 *     icon_view_type: string,
	 *     icon_background: string,
	 *     icon_background_hover: string,
	 *     icon_border: string,
	 *     icon_border_width: string,
	 *     icon_border_color: string,
	 *     icon_border_color_hover: string,
	 *     icon_border_radius: string,
	 *     icon_padding: string,
	 *     content_alignment: string,
	 * }
	 */
	protected array $attributes = array();
	protected function render(){
		$className = array(
			'align'.$this->attributes['align'],
			'sb-content_alignment-'.$this->attributes['content_alignment'],
		);

		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}

		$className[] = "sb-icon_type-icon";
		$className[] = "sb-icon_view_type-".$this->attributes['icon_view_type'];

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon .sb-icon-wrapper .sb_icon',
			array(
				'width'  => $this->attributes['icon_size'].'px',
				'color' => $this->attributes['icon_color']
			)
		);

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon.sb-icon_view_type-framed .sb-icon-wrapper .sb_icon',
			array(
				'background-color'    => $this->attributes['icon_background'],
				'border-style'        => $this->attributes['icon_border'],
				'border-width'  => $this->attributes['icon_border_width'].'px',
				'border-color'  => $this->attributes['icon_border_color'],
				'border-radius' => $this->attributes['icon_border_radius'].'%',
				'padding'       => $this->attributes['icon_padding'].'px'
			)
		);

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon:hover .sb-icon-wrapper .sb_icon',
			array(
				'color' => $this->attributes['icon_color_hover']
			)
		);

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon.sb-icon_view_type-framed:hover .sb-icon-wrapper .sb_icon',
			array(
				'background-color'    => $this->attributes['icon_background_hover'],
				'border-color'  => $this->attributes['icon_border_color_hover']
			)
		);

		$icon_link = (!empty($this->attributes['link'])) ? '<a class="sb-icon_link" href="'.esc_attr($this->attributes['link']).'"></a>' : '';

		$icon = '<div class="sb-icon_container">'.
		    '<span class="sb_icon">'.
		        '<span class="sb_icon_wrap">'.
			        Icons::getIcon($this->attributes['icon']).
		        '</span>'.
		    '</span>'. $icon_link .
		'</div>';

		$this->add_render_attribute('wrapper', 'class', $className);
		

		return '<div '.$this->get_render_attribute_string('wrapper').'><div class="sb-icon-wrapper">'.$icon.'</div></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}
