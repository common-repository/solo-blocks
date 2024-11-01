<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Icon_Box extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      align: string,
	 *      show_icon: bool,
	 *      icon_position: string,
	 *      icon: object,
	 *      iconHover: object,
	 *      title_text: string,
	 *      description_text: string,
	 *      link: string,
	 *      title_size: string,
	 *      title_typography: object,
	 *      title_color: string,
	 *      title_color_hover: string,
	 *      description_typography: object,
	 *      description_color: string,
	 *      description_color_hover: string,
	 *      icon_view_type: string,
	 *      icon: array,
	 *      icon_size: int,
	 *      icon_spacing: int,
	 *      content_alignment: string,
	 *      vertical_alignment: string,
	 * }
	 */
	protected array $attributes = [];
	protected function render(){
	

		$className = array(
			'align'.$this->attributes['align'],
			'sb-content_alignment-'.$this->attributes['content_alignment'],
		);

		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}

		if($this->attributes['icon_position'] == 'left' || $this->attributes['icon_position'] == 'right') {
			$className[] = "sb-vertical_alignment-".$this->attributes['vertical_alignment'];
		}

		if((bool) $this->attributes['show_icon']) {
			$className[] = "sb-icon_type-icon";
			$className[] = "sb-icon_position-".$this->attributes['icon_position'];
			$className[] = "sb-icon_view_type-".$this->attributes['icon_view_type'];
		}

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-title',
			'name'     => 'color',
			'value'    => $this->attributes['title_color']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.':hover .sb-title',
			'name'     => 'color',
			'value'    => $this->attributes['title_color_hover']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-title',
			'typography' => $this->attributes['title_typography']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-description',
			'typography' => $this->attributes['description_typography']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-description',
			'name'     => 'color',
			'value'    => $this->attributes['description_color']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.':hover .sb-description',
			'name'     => 'color',
			'value'    => $this->attributes['description_color_hover']
		));

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon .sb-iconbox-wrapper .sb_icon',
			array(
				'width'  => $this->attributes['icon_size'].'px',
				'color' => $this->attributes['icon_color']
			)
		);

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon.sb-icon_view_type-framed .sb-iconbox-wrapper .sb_icon',
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
			$this->selector.'.sb-icon_type-icon:hover .sb-iconbox-wrapper .sb_icon',
			array(
				'color' => $this->attributes['icon_color_hover']
			)
		);

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon.sb-icon_view_type-framed:hover .sb-iconbox-wrapper .sb_icon',
			array(
				'background-color'    => $this->attributes['icon_background_hover'],
				'border-color'  => $this->attributes['icon_border_color_hover']
			)
		);

		CSS_Vars::add(
			$this->selector.' .sb-icon_container',
			array(
				'--icon_spacing'  => $this->attributes['icon_spacing'].'px'
			)
		);

		$icon = '';

		if((bool) $this->attributes['show_icon']) {
			$icon = '<div class="sb-icon_container">'.
			    '<span class="sb_icon">'.
			        '<span class="sb_icon_wrap">'.
				        Icons::getIcon($this->attributes['icon']).
				        Icons::getIcon($this->attributes['iconHover']) .
			        '</span>'.
			    '</span>'.
			'</div>';
		}
		$iconBox_title = (!empty($this->attributes['title_text'])) ? '<'.$this->attributes['title_size'].' class="sb-title">'.wp_kses_post($this->attributes['title_text']).'</'.$this->attributes['title_size'].'>' : '';

		$iconBox_descr = (!empty($this->attributes['description_text'])) ? '<div class="sb-description">'.wp_kses_post($this->attributes['description_text']).'</div>' : '';

		$iconBox_link = (!empty($this->attributes['link'])) ? '<a class="sb-iconbox_link" href="'.esc_attr($this->attributes['link']).'"></a>' : '';

		$iconBox_info = '<div class="sb-iconbox_info_wrapper">'.$iconBox_title . $iconBox_descr. '</div>';
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		
		return '<div '.$this->get_render_attribute_string('wrapper').'><div class="sb-iconbox-wrapper">'.$icon.$iconBox_info.'</div>'.$iconBox_link.'</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}
