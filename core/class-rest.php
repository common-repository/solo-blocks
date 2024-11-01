<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

use WP_REST_Server;
use WP_REST_Response;
use WP_REST_Request;

class Rest {
	
	const REST_NAMESPACE = 'sb/v1';
	
	private static $instance = null;
	
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}
		
		return static::$instance;
	}
	
	private function __construct(){
		add_action('rest_api_init', array( $this, 'rest_api_init' ));
	}
	
	function rest_api_init() : void{
		register_rest_route(
			self::REST_NAMESPACE,
			'fonts_get_all',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'permission_callback' => function(){
						return current_user_can('edit_posts');
					},
					'callback'            => array( $this, 'fonts_get_all' ),
				)
			)
		);
		
		register_rest_route(
			self::REST_NAMESPACE,
			'icons_get_all',
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'permission_callback' => function(){
						return current_user_can('edit_posts');
					},
					'callback'            => array( $this, 'icons_get_all' ),
				)
			)
		);
	}
	
	/**
	 * Params
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function fonts_get_all(WP_REST_Request $request) : WP_REST_Response{
		$fonts        = Fonts::getFonts();
		$font_options = array();
		foreach($fonts as $font) {
			/**
			 * @var array   $font       {
			 * @type string $family
			 * @type string $category
			 * @type array  $variants
			 *                          }
			 */
			
			$font_options[] = array(
				'id'   => $font['family'],
				'text' => $font['family']
			);
		}
		
		return rest_ensure_response(array(
			'fonts'        => $fonts,
			'font_options' => $font_options
		));
	}
	
	/**
	 * Params
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function icons_get_all(WP_REST_Request $request) : WP_REST_Response{
		$icons = Icons::getIcons();
		$categories = array_keys($icons);
		
		return rest_ensure_response(array(
			'icons'      => $icons,
			'categories' => $categories
		));
	}
}