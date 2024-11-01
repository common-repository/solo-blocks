<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use WP_Block;
use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Search extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      color: string,
	 *      align: string,
	 * }
	 */
	protected array $attributes = array();
	protected function render(){
		
		CSS_Vars::add(array(
			'selector' => $this->selector,
			'name'     => 'color',
			'value'    => ($this->attributes['color']),
		));
		$className = array();
		
		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}
		
		
		$this->add_render_attribute('wrapper', 'class', $className);
		$this->add_render_attribute('wrapper', 'data-id', $this->uid);
		
		
		echo '<div '.$this->get_render_attribute_string().'>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		
		if(is_user_logged_in()) {
			$user = wp_get_current_user();
			echo '<p><span class="user_avatar">'.get_avatar($user->user_email, 25).'</span>'.
			     '<span class="search">'.esc_html($user->display_name).'</span></p>';
		} else {
			echo '<p>'.esc_html__('Login / Register', 'solo-blocks').'</p>';
		}
		echo '</div>';
		
		$attributes = array(
			'uid' => $this->uid
		);
		
		add_action('wp_footer', function() use ($attributes){
			if(!class_exists('WooCommerce')) {
				return;
			}
			
			echo "<div class='sb__login-modal login-id-".esc_attr($attributes['uid'])." ".(get_option('woocommerce_enable_myaccount_registration') != 'yes' ? ' without_register' : '').(is_user_logged_in() ? ' user_logged_in' : '')."'>";
			echo "<div class='sb__login-modal-cover'></div>";
			echo "<div class='sb__login-modal_container container'>";
			echo "<div class='sb__login-modal-close'></div>";
			if(is_user_logged_in()) {
				wc_get_template('myaccount/navigation.php');
			}
			if(!is_user_logged_in()) {
				$sb_notice = wc_get_notices();
				echo do_shortcode('[woocommerce_my_account]');
				wc_set_notices($sb_notice);
			}
			echo "</div>";
			
			echo "</div>";
		}, PHP_INT_MAX);
		
		
	}
}
