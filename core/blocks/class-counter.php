<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Counter extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      startNumber: int,
	 *      endNumber: int,
	 *      description:  string,
	 *      decimal: int,
	 *      duration: int,
	 *      useEasing: string,
	 *      suffix: string,
	 *      prefix: string,
	 *      separator_enabled: bool,
	 *      separator: string,
	 *      decimal_point: string,
	 *      show_icon: bool,
	 *      icon_image: string,
	 *      icon_position: string,
	 *      icon_view_type: string,
	 *      content_alignment: string,
	 *      icon: array,
	 *      icon_size: int,
	 *      icon_spacing: int,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){

		$className = array( 'sb-counter', 'wp-block-sb-counter', 'align'.$this->attributes['align'], 'sb-content_alignment-'.$this->attributes['content_alignment'] );
		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}
		if((bool) $this->attributes['show_icon']) {
			$className[] = "sb-icon_type-".$this->attributes['icon_image'];
			$className[] = "sb-icon_position-".$this->attributes['icon_position'];
			$className[] = "sb-icon_view_type-".$this->attributes['icon_view_type'];
		}

		if(!is_numeric($this->attributes['startNumber']) || $this->attributes['startNumber'] < 0) {
			$this->attributes['startNumber'] = 0;
		}
		if(!is_numeric($this->attributes['endNumber']) || $this->attributes['endNumber'] < $this->attributes['startNumber']) {
			$this->attributes['endNumber'] = $this->attributes['startNumber']*100;
		}
		if(!is_numeric($this->attributes['decimal']) || $this->attributes['decimal'] < 0) {
			$this->attributes['decimal'] = 0;
		}

		$this->dataSettings = array(
			'startNumber' => intval($this->attributes['startNumber']),
			'endNumber'   => intval($this->attributes['endNumber']),
			'decimal'     => intval($this->attributes['decimal']),
			'duration'    => $this->attributes['duration'],
		);

		$suffix = !empty($this->attributes['suffix']) ? '<span class="sb-counter_suffix">'.esc_html($this->attributes['suffix']).'</span>' : '';
		$prefix = !empty($this->attributes['prefix']) ? '<span class="sb-counter_prefix">'.esc_html($this->attributes['prefix']).'</span>' : '';

		$options         = array(
			'useEasing'   => (bool) $this->attributes['useEasing'],
			'easingFn'    => $this->attributes['useEasing'],
			'useGrouping' => (bool) $this->attributes['separator_enabled'],
			'separator'   => $this->attributes['separator'],
			'decimal'     => $this->attributes['decimal_point'],
		);
		$this->dataSettings['options'] = $options;

		if(!$options['useGrouping']) {
			$this->attributes['separator'] = '';
		}

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-counter_text',
			'name'     => 'color',
			'value'    => $this->attributes['digits_color']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-counter_text',
			'typography' => $this->attributes['digits_typography']
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

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon .sb-counter-wrapper .sb_icon',
			array(
				'width'  => $this->attributes['icon_size'].'px',
				'color' => $this->attributes['icon_color']
			)
		);

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon.sb-icon_view_type-framed .sb-counter-wrapper .sb_icon',
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
			$this->selector.' .sb-icon_container',
			array(
				'--icon_spacing'  => $this->attributes['icon_spacing'].'px'
			)
		);
		
		$this->add_render_attribute('wrapper', 'class', $className);

		$icon = '';

		if((bool) $this->attributes['show_icon']) {
			switch($this->attributes['icon_image']) {
				case 'icon':
					$icon = '<div class="sb-icon_container"><span class="sb_icon">'.(Icons::getIcon($this->attributes['icon'])).'</span></div>';
					break;
				case 'image':
					$image = Image::getImage($this->attributes['image']);
					$icon  = '<div class="sb-icon_container">'.$image.'</div>';
					break;
				default:
					break;
			}
		}

		$counter_descr = (!empty($this->attributes['description'])) ? '<div class="sb-description">'.wp_kses_post($this->attributes['description']).'</div>' : '';
		$counter_info  = '<div class="sb-counter_info_wrapper"><div class="sb-counter_text">'.$prefix.'<span class="sb-counter_text_wrap"><span class="sb-counter"></span><span class="sb-hidden_end">'.number_format($this->attributes['endNumber'], $this->attributes['decimal'], $this->attributes['decimal_point'], $this->attributes['separator']).'</span></span>'.$suffix.'</div>'.$counter_descr.'</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		
		return '<div '.$this->get_render_attribute_string('wrapper').'><div class="sb-counter-wrapper">'.$icon.$counter_info.'</div></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}
