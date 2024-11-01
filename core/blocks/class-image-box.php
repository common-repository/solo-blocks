<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;

class Image_Box extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      align: string,
	 *      show_icon: bool,
	 *      icon_position: string,
	 *      image: object,
	 *      imageHover: object,
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
	 *      icon_spacing: int,
	 *      content_alignment: string,
	 *      vertical_alignment: string,
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
		
		if($this->attributes['icon_position'] == 'left' || $this->attributes['icon_position'] == 'right') {
			$className[] = "sb-vertical_alignment-".$this->attributes['vertical_alignment'];
		}
		
		if((bool) $this->attributes['show_icon']) {
			$className[] = "sb-icon_position-".$this->attributes['icon_position'];
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
			$this->selector.' .sb-icon_container',
			array(
				'--icon_spacing' => $this->attributes['icon_spacing'].'px'
			)
		);
		
		$icon = '';
		
		if((bool) $this->attributes['show_icon']) {
			$image = Image::getImage($this->attributes['image'], array( 'class' => 'sb-main_image' )).Image::getImage($this->attributes['imageHover'], array( 'class' => 'hover_image' ));
			
			$icon = '<div class="sb-icon_container">'.$image.'</div>';
		}
		
		$this->add_render_attribute('title', 'class', 'sb-title');
		$imageBox_title = (!empty($this->attributes['title_text'])) ? sprintf('<%1$s %2$s>%3$s</%1$s>',
			$this->attributes['title_size'],
			$this->get_render_attribute_string('title'),
			esc_html($this->attributes['title_text'])
		) : '';
		
		$imageBox_descr = (!empty($this->attributes['description_text'])) ? '<div class="sb-description">'.esc_html($this->attributes['description_text']).'</div>' : '';
		
		$imageBox_link = (!empty($this->attributes['link'])) ? '<a class="sb-imagebox_link" href="'.esc_url($this->attributes['link']).'"></a>' : '';
		
		$imageBox_info = '<div class="sb-imagebox_info_wrapper">'.$imageBox_title.$imageBox_descr.'</div>';
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		return '<div '.$this->get_render_attribute_string().'>'. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		       '<div class="sb-imagebox-wrapper">'.
		       $icon.$imageBox_info. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		       '</div>'.
		       $imageBox_link. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		       '</div>';
		
	}
}
