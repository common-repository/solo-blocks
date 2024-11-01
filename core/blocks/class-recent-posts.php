<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;
use WP_Query;

class Recent_Posts extends Query {
	/**
	 * Attributes
	 *
	 * @var array{
	 *     query: array,
	 *     itemsPerLine: string,
	 *     spacingBetweenItems: string,
	 *     showFeaturedImage: string,
	 *     imageProportion: string,
	 *     imageSize: string,
	 *     postCategories: bool,
	 *     postAuthor: bool,
	 *     postDate: bool,
	 *     postComments: bool,
	 *     displayExcerpt: bool,
	 *     showMoreButtonEnable: bool,
	 *     showMoreButtonTitle: bool,
	 *     excerptLength: numeric,
	 * }
	 */
	protected array $attributes = array();
	
	protected WP_Query|null $query = null;
	
	protected function render(){
		$className = array(
			'sb-items-perline'.$this->attributes['itemsPerLine']
		);
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		$this->query = $this->buildQuery($this->attributes['query']);
		
		CSS_Vars::add(
			$this->selector,
			array(
				'--spacing_between_items'      => $this->attributes['spacingBetweenItems'].'px',
				'--spacing_between_items_half' => ($this->attributes['spacingBetweenItems']/1.5).'px',
			)
		);
		
		CSS_Vars::add(
			$this->selector.'.sb-items-perline1 .sb-post-item',
			array(
				'margin-bottom' => $this->attributes['spacingBetweenItems'].'px',
			)
		);
		
		$has_post = $this->query->have_posts();
		ob_start();
		
		if(!$has_post) {
			echo esc_html__('Posts empty', 'solo-blocks');
		} else {
			while($this->query->have_posts()) {
				$this->query->the_post();
				$this->render_post();
			}
		}
		
		$content = ob_get_clean();
		echo '<div '.$this->get_render_attribute_string().'>'.$content.'</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	
	
	protected function render_post(){
		$post          = $this->query->post;
		$attribute_key = 'post_item_'.$post->ID;
		ob_start();
		$this->add_render_attribute($attribute_key, 'class', 'sb-post-item');
		
		$this->get_image();
		$this->get_categories();
		$this->get_title();
		?>
		<div class="sb-post-breadcrumbs">
			<?php
			$this->get_author();
			$this->get_date();
			$this->get_comments();
			?>
		</div>
		<?php
		$this->get_content();
		$this->get_read_more_button();
		
		$content = ob_get_clean();
		echo '<div '.$this->get_render_attribute_string($attribute_key).'>'.$content.'</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	
	protected function get_image(){
		if(!$this->attributes['showFeaturedImage']) {
			return;
		}
		
		$post           = $this->query->post;
		$featured_image = get_post_thumbnail_id($post);
		if(!$featured_image) {
			return;
		}
		
		$featured_image = wp_get_attachment_image_src($featured_image, $this->attributes['imageSize']);
		if(!is_array($featured_image)) {
			return;
		}
		$featured_image = $featured_image[0];
		
		$attribute_key = 'get_image_'.$post->ID;
		
		$this->add_render_attribute($attribute_key, 'class', array(
			'sb-post-image',
			'sb-image-proportion-'.$this->attributes['imageProportion']
		));
		
		$this->add_render_attribute($attribute_key, 'data-thumbnail', esc_url($featured_image));
		
		echo '<div '.$this->get_render_attribute_string($attribute_key).'>'. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		     '<a href="'.esc_url(get_permalink()).'"><img src="'.esc_url($featured_image).'"></a>'.
		     '</div>';
	}
	
	protected function get_categories(){
		if(!$this->attributes['postCategories']) {
			return;
		}
		
		$categories = get_the_category();
		
		echo '<div class="sb-categories">';
		if(is_array($categories) && count($categories)) {
			echo join('', array_map(function($term){
				return '<span class="sb-category">'.
				       '<a href="'.esc_url(get_category_link($term->term_id)).'">'.esc_html($term->name).'</a>'.
				       '</span>';
			}, $categories));
		}
		echo '</div>';
	}
	
	protected function get_title(){
		$attribute_key = 'title_'.$this->query->post->ID;
		
		$this->add_render_attribute($attribute_key, 'class', 'sb-post-title');
		
		echo sprintf('<%1$s %2$s>%3$s</%1$s>',
			$this->attributes['titleTag'],
			$this->get_render_attribute_string($attribute_key),
			'<a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a>'
		);
	}
	
	protected function get_author(){
		if(!$this->attributes['postAuthor']) {
			return;
		}
		$author_id = $this->query->post->post_author;
		echo '<span class="sb-author"><a href="'.esc_url(get_author_posts_url($author_id)).'">'.
		     (esc_html(get_the_author_meta('display_name'))).
		     '</a></span>';
	}
	
	protected function get_date(){
		if(!$this->attributes['postDate']) {
			return;
		}
		
		echo '<span class="sb-date"><a href="'.esc_url(get_permalink()).'">'.esc_html(get_the_time(get_option('date_format'))).'</a></span>';
	}
	
	protected function get_comments(){
		if(!$this->attributes['postComments']) {
			return;
		}
		$comments_count = (int) get_comments_number($this->query->post->ID);
		
		echo '<span class="sb-comments"><a href="'.esc_url(get_comments_link()).'">'.
		     sprintf(
		     /* translators: %s: Number of comments. */
			     _n('%s Comment', '%s Comments', $comments_count, 'solo-blocks'),
			     number_format_i18n($comments_count)
		     )
		     .'</a></span>';
	}
	
	protected function get_content(){
		if(!$this->attributes['displayExcerpt']) {
			return;
		}
		$post_id = $this->query->post->ID;
		
		$excerpt = $this->trim_words(get_post_field(
			'post_excerpt',
			$post_id,
			'display'
		));
		
		if(empty($excerpt)) {
			$excerpt = $this->trim_words(get_the_content());
		}
		
		if(!$excerpt) {
			$excerpt = '';
		}
		
		echo '<div class="sb-content">';
		echo wp_kses_post($excerpt);
		echo '</div>';
		
	}
	
	private function trim_words($content){
		return apply_filters('the_excerpt',
			wp_trim_words(
				preg_replace(
					array(
						'/\<figcaption>.*\<\/figcaption>/',
						'/\[caption.*\[\/caption\]/',
					),
					'',
					$content
				),
				$this->attributes['excerptLength']
			)
		);
	}
	
	protected function get_read_more_button(){
		if(!$this->attributes['showMoreButtonEnable']) {
			return;
		}
		echo '<a class="sb-read-more" href="'.esc_url(get_permalink()).'">'.
		     esc_html($this->attributes['showMoreButtonTitle']).
		     '</a>';
		
	}
}
