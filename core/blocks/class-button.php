<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Button extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      uid: string,
	 *      button_size: string,
	 *      align: string,
	 *      button_title: string,
	 *      link: string,
	 *      button_padding: object,
	 *      button_alignment: string,
	 *      show_icon: bool,
	 *      icon_position: string,
	 *      icon_image: string,
	 *      btn_icon: object,
	 *      btn_image: object,
	 *      backgroundControl: object,
	 *      backgroundControlHover: object,
	 *      icon_size: int,
	 *      icon_spacing: int,
	 *      btn_typography: object,
	 *      buttonShadow: object,
	 *      titleColor: string,
	 *      iconColor: string,
	 *      titleColorHover: string,
	 *      iconColorHover: string,
	 *      btn_border: string,
	 *      btn_border_width: number,
	 *      btn_border_color: string,
	 *      btn_border_color_hover: string,
	 *      btn_border_radius: string,
	 * }
	 */
	protected array $attributes = array();

	protected function render(){

		$className = array(
			'align'.$this->attributes['align'],
			'sb-button-size-'.$this->attributes['button_size'],
			'sb-button-align-'.$this->attributes['button_alignment'],
		);

		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}

		if((bool) $this->attributes['show_icon']) {
			$className[] = "sb-icon_type-".$this->attributes['icon_image'];
			$className[] = "sb-icon_position-".$this->attributes['icon_position'];
		}

		$boxShadow = array_key_exists("buttonShadow", $this->attributes) ? $this->attributes["buttonShadow"] : array();

		if(!empty($boxShadow)) {
			$className[] = 'has-sb-shadow';
			$className[] = (!empty($boxShadow['position'])) ? 'sb-shadow-inset' : '';
		}

		$this->add_render_attribute('wrapper', 'class', $className);

		if(!empty($this->attributes['button_padding'])) {
			CSS_Vars::add(
				$this->selector.'.sb-button-size-custom .sb-button',
				array(
					'padding-top'    => $this->attributes['button_padding']['top'],
					'padding-right'  => $this->attributes['button_padding']['right'],
					'padding-bottom' => $this->attributes['button_padding']['bottom'],
					'padding-left'   => $this->attributes['button_padding']['left']
				)
			);
		}

		$background = array_key_exists("backgroundControl", $this->attributes) ? $this->attributes["backgroundControl"] : array();

		$background = array_merge(array(
			'color' => '',
			'media' => array()
		), $background);

		$mediaValue = array_merge(array(
			'mediaUrl'         => '',
			'focalPoint'       => false,
			'backgroundRepeat' => 'repeat',
			'backgroundSize'   => 'auto',
		), $background['media']);

		if(false === strpos($background['color'], 'gradient') && strlen($background['color'])) {
			$this->add_render_attribute('button', 'class', 'has-color-background');
		}

		if(false !== strpos($background['color'], 'gradient') && strlen($background['color'])) {
			$this->add_render_attribute('button', 'class', 'has-gradient-background');
		}

		if($mediaValue['mediaUrl'] && strlen($mediaValue['mediaUrl'])) {
			$this->add_render_attribute('button', 'class', 'has-media-background');
		}

		$this->add_render_attribute('button', 'class', 'sb-button');
		$this->add_render_attribute('button', 'href', ((!empty($this->attributes['link'])) ? $this->attributes['link'] : "javascript:void(0)"));

		CSS_Vars::render_background_vars(array(
			'selector'   => $this->selector.' .sb-button',
			'attributes' => $this->attributes,
			'field'      => 'backgroundControl',
		));

		CSS_Vars::render_background_vars(array(
			'selector'   => $this->selector.' .sb-button:hover',
			'attributes' => $this->attributes,
			'field'      => 'backgroundControlHover',
		));

		CSS_Vars::add(
			$this->selector.'.sb-icon_type-icon .sb-icon_container',
			array(
				'width' => $this->attributes['icon_size'].'px'
			)
		);

		CSS_Vars::add(
			$this->selector.' .sb-icon_container',
			array(
				'--icon_spacing' => $this->attributes['icon_spacing'].'px'
			)
		);

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-button',
			'typography' => $this->attributes['btn_typography']
		));

		if(!empty($boxShadow)) {
			CSS_Vars::add(
				$this->selector.'.has-sb-shadow .sb-button',
				array(
					'--shadowColor'      => $boxShadow['color'],
					'--shadowHorizontal' => $boxShadow['horizontal'],
					'--shadowVertical'   => $boxShadow['vertical'],
					'--shadowBlur'       => $boxShadow['blur'],
					'--shadowSpread'     => $boxShadow['spread'],
					'--shadowPosition'   => $boxShadow['position'],
				)
			);
		}

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-button',
			'name'     => 'color',
			'value'    => $this->attributes['titleColor']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-button:hover',
			'name'     => 'color',
			'value'    => $this->attributes['titleColorHover']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.'.sb-icon_type-icon .sb-icon_container',
			'name'     => 'color',
			'value'    => $this->attributes['iconColor']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.'.sb-icon_type-icon .sb-button:hover .sb-icon_container',
			'name'     => 'color',
			'value'    => $this->attributes['iconColorHover']
		));

		CSS_Vars::add(
			$this->selector.' .sb-button',
			array(
				'border-style'  => $this->attributes['btn_border'],
				'border-width'  => $this->attributes['btn_border_width'].'px',
				'border-color'  => $this->attributes['btn_border_color'],
				'border-radius' => $this->attributes['btn_border_radius'].'px',
			)
		);

		CSS_Vars::add(
			$this->selector.' .sb-button:hover',
			array(
				'border-color' => $this->attributes['btn_border_color_hover']
			)
		);

		$icon = '';

		if((bool) $this->attributes['show_icon']) {
			switch($this->attributes['icon_image']) {
				case 'icon':
					$icon = '<div class="sb-icon_container">'.Icons::getIcon($this->attributes['btn_icon']).'</div>';
					break;
				case 'image':
					$icon = '<div class="sb-icon_container">'.Image::getImage($this->attributes['btn_image'], array( 'class' => 'sb-main_image' ), true).'</div>';
					break;
				default:
					break;
			}
		}

		$button_title = (!empty($this->attributes['button_title'])) ? '<span class="sb-title">'.esc_html($this->attributes['button_title']).'</span>' : '';

		return '<div '.$this->get_render_attribute_string('wrapper').'><a '.$this->get_render_attribute_string('button').'><span class="sb-button-inner">'. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		       $icon.$button_title // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		       .'</span></a></div>';
	}
}


