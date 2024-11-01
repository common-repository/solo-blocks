<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;

class Testimonial extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      contentAlignment: string,
	 *      image: object,
	 *      imagePosition: string,
	 *      authorImageAlignment: string,
	 *      imageSize: number,
	 *      imageSpacing: number,
	 *      imageRadius: number,
	 *      verticalAlignment: string,
	 *      descriptionTypography: object,
	 *      nameTypography: object,
	 *      companyTypography: object,
	 *      descriptionColor: string,
	 *      nameColor: string,
	 *      companyColor: string,
	 * }
	 */
	protected array $attributes = array();
	
	
	protected function render(){
		$className = array(
			'sb-content_alignment-'.$this->attributes['contentAlignment'],
			'sb-image-position-'.$this->attributes['imagePosition'],
		);

		if($this->attributes['imagePosition'] == 'left' || $this->attributes['imagePosition'] == 'right') {
			$className[] = "sb-vertical_alignment-".$this->attributes['verticalAlignment'];
		}

		if ($this->attributes['imagePosition'] === 'bottom') {
			$className[] = "sb-image_alignment-".$this->attributes['authorImageAlignment'];
		}

		CSS_Vars::add(
			$this->selector.' .sb-testimonial-image',
			array(
				'--image_size'  => $this->attributes['imageSize'].'px',
				'--image_spacing'  => $this->attributes['imageSpacing'].'px',
				'border-radius' => $this->attributes['imageRadius'].'%',
			)
		);

		CSS_Vars::add(
			$this->selector.'.sb-image-position-bottom .sb-testimonial-author-block',
			array(
				'--image_spacing'  => $this->attributes['imageSpacing'].'px',
			)
		);

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-testimonial-description',
			'typography' => $this->attributes['descriptionTypography']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-testimonial-description',
			'name'     => 'color',
			'value'    => $this->attributes['descriptionColor']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-testimonial-author',
			'typography' => $this->attributes['nameTypography']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-testimonial-author',
			'name'     => 'color',
			'value'    => $this->attributes['nameColor']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-testimonial-position',
			'typography' => $this->attributes['companyTypography']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-testimonial-position',
			'name'     => 'color',
			'value'    => $this->attributes['companyColor']
		));

		$image = Image::getImage(array_merge(
			$this->attributes['image'],
			array(
				'width' => $this->attributes['imageSize'],
				'height' => $this->attributes['imageSize'],
			)
		), array('class'=>'sb-main_image'));

		$image = $author_image = (!empty($image)) ? '<div class="sb-testimonial-image">'.$image.'</div>' : '';

		if ($this->attributes['imagePosition'] !== 'bottom') {
			$author_image = '';
		}
		if ($this->attributes['imagePosition'] === 'bottom') {
			$image = '';
		}

		$testimonial_text = (!empty($this->attributes['description'])) ? '<div class="sb-testimonial-description">'.esc_html($this->attributes['description']).'</div>' : '';

		$testimonial_author = (!empty($this->attributes['name'])) ? '<div class="sb-testimonial-author">'.esc_html($this->attributes['name']).'</div>' : '';

		$testimonial_company = (!empty($this->attributes['company'])) ? '<div class="sb-testimonial-position">'.esc_html($this->attributes['company']).'</div>' : '';

		$testimonial_author_block = '';
		if (!empty($testimonial_author) || !empty($testimonial_company) || !empty($author_image)) {
			$testimonial_author_block = '<div class="sb-testimonial-author-block">'. $author_image . ((!empty($testimonial_author) || !empty($testimonial_company)) ? "<div class='sb-testimonial-author-wrapper'>" : "") . $testimonial_author . $testimonial_company . ((!empty($testimonial_author) || !empty($testimonial_company)) ? "</div>" : "") . '</div>';
		}
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		return '<div '.$this->get_render_attribute_string().'>'. $image . '<div class="sb-testimonial-text-wrapper">'. $testimonial_text . $testimonial_author_block . '</div></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
