<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Query extends Basic {
	
	protected static $POST_TYPE = 'post';
	
	/**
	 * @param array $value
	 * @param string $return Return WP_Query or arguments. Default WP_Query
	 *
	 */
	protected function buildQuery($value, $return = 'query'){
		$value = array_merge(
			array(
				"perPage"  => '',
				"order"    => '',
				"orderBy"  => '',
				"author"   => [],
				"postType" => 'post',
				"sticky"   => '',
				"taxQuery" => [],
				"parents"  => [],
				/////////////////
				"post__in" => '',
				"ignore_sticky_posts" => '',
			), $value
		);
		
		$args = array(
			'post_status' => array( 'publish' ),
			'post_type'   => static::$POST_TYPE,
			'tax_query'   => array()
		);
		
		if(!empty($value['perPage'])) {
			$args['posts_per_page'] = $value['perPage'];
		}
		if(!empty($value['orderBy'])) {
			$args['orderby'] = $value['orderBy'];
		}
		if(!empty($value['order'])) {
			$args['order'] = $value['order'];
		}
		if(!empty($value['post__in'])) {
			$args['post__in'] = $value['post__in'];
		} else {
			if(!empty($value['ignore_sticky_posts']) && (bool) $value['ignore_sticky_posts']) {
				$args['ignore_sticky_posts'] = '1';
			}
			
			if(!empty($value['author'])) {
				$args['author__in'] = $value['author'];
			}
			
			if(!empty($value['taxQuery'])) {
				$args['tax_query'] = array(
					'relation' => 'AND',
				);
				
				$taxonomies_list = get_taxonomies(
					array(
						'object_type' => array(static::$POST_TYPE),
					), 'object'
				);
				
				$taxonomies_list = array_flip(array_filter(array_map(function(/* @var \WP_Taxonomy */ $tax) {
					return $tax->rest_base;
				}, $taxonomies_list), function(/* @var string*/ $tax){
					return is_string($tax);
				}));
				
				foreach($value['taxQuery'] as $taxonomy => $taxonomies) {
					if ($taxonomies && is_array($taxonomies) && count($taxonomies))
						$args['tax_query'][] = array(
							'taxonomy' => $taxonomies_list[$taxonomy],
							'operator' => 'IN',
							'terms'    => $taxonomies,
						);
				}
			}
		}
		
		if ("query" === $return) {
			return new \WP_Query($args);
		}
		
		return $args;
	}
}