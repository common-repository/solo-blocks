<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

class  Image {

	static function getImage($value = array(), $attrs = array(), $show_if_removed = false) : string{
		if(!is_array($value)) {
			$value = array();
		}

		$value = array_merge(array(
			'id'     => 0,
			'width'  => false,
			'height' => false,
		), $value);

		$hasWidth  = !!$value['width'];
		$hasHeight = !!$value['height'];

		$style = array();
		$class = array();

		foreach($attrs as $attr=>$attr_value) {
			switch($attr){
				case 'class':
					array_splice($class, 0,0, (array)$attr_value);
					break;
				case 'style':
					array_splice($style, 0,0, (array)$attr_value);
			}
		}

		if ($hasWidth) {
			$style[] = 'width: '.$value['width'].'px';
		}
		if ($hasHeight) {
			$style[] = 'height: '.$value['height'].'px';
		}

		if (!$hasWidth && !$hasHeight) {
			$class[] = 'sb-has-not-sizes';
		}

		if ($hasWidth && $hasHeight) {
			$class[] = 'sb-has-cover-image';
		} else {
			if (!$hasHeight) {
				$class[] = 'sb-has-height-auto';
			}
			if (!$hasWidth) {
				$class[] = 'sb-has-width-auto';
			}
		}

		$style = implode(';', $style);
		$class  = implode(' ', $class);

		if ($value['id'] === -1) {
			return $show_if_removed ? '<img src="'.Placeholder::getImageSrc().'" style="'.$style.'" class="'.$class.'" />' : '';
		}

		$url        = wp_prepare_attachment_for_js($value['id']);
		if (!$url) {
			return '';
		}
		$url = array_merge(array(
			'width' => 1,
			'height' => 1,
		), $url);

		$ratio      = intval($url['width'])/min(1,intval($url['height']));
		$_is_square = 1 === $ratio;

		$_sizes  = array();
		$sizes   = get_intermediate_image_sizes();
		$sizes[] = 'full';
		foreach($sizes as $size) {
			$_size = wp_get_attachment_image_src($value['id'], $size);
			if((false !== $_size && $_size[0] !== $url['url']) || 'full' === $size) {
				$_sizes[$size] = $_size;
			}
		}

		uasort($_sizes, function($a, $b){
			return ($a[1] === $b[1] ? 0 :  ($a[1] < $b[1] ? -1 : 1));
		});

		$selectedImg = $_sizes['full'];

		foreach($_sizes as $size) {
			$is_square = ($size[1] === $size[2]);

			if(
				(((!$is_square && !$_is_square) || ($is_square && $_is_square)) &&
				 (($hasWidth && !$hasHeight && $size[1] > $value['width'])
				 ||
				 (!$hasWidth && $hasHeight && $size[2] > $value['height'])
				 ||
				  ($hasWidth && $hasHeight && $size[1] > $value['width'] && $size[2] > $value['height']))
				)
			) {
				$selectedImg = $size;
			}
		}

		if ($selectedImg) {
				return '<img src="'.$selectedImg[0].'" style="'.$style.'" class="'.$class.'" />';
		}

		return '';
	}

}
