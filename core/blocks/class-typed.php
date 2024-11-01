<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;

class Typed extends Basic {

	/** <code>
	 * Block Attributes
	 * </code>
	 *
	 * @var array{
	 *    strings: string,
	 *    prefixText: string,
	 *    suffixText: string,
	 *    typeSpeed: string,
	 *    startDelay: string,
	 *    backSpeed: string,
	 *    smartBackspace: string,
	 *    backDelay: string,
	 *    loop: string,
	 *    loopCount: string,
	 *    showCursor: string,
	 *    cursorChar: string,
	 *    fadeOut: string,
	 *    fadeOutDelay: string,
	 * }
	 */
	protected array $attributes = array();

	protected function render(){
		$className = array(
			'sb-content-alignment-'.$this->attributes['contentAlignment'],
		);

		$this->dataSettings = array(
			'strings'        => $this->attributes['strings'],
			'typeSpeed'      => $this->attributes['typeSpeed'],
			'startDelay'     => $this->attributes['startDelay'],
			'backSpeed'      => $this->attributes['backSpeed'],
			'smartBackspace' => $this->attributes['smartBackspace'],
			'backDelay'      => $this->attributes['backDelay'],
			'loop'           => boolval($this->attributes['loop']),
			'loopCount'      => intval($this->attributes['loopCount']),
			'showCursor'     => $this->attributes['showCursor'],
			'cursorChar'     => $this->attributes['cursorChar'],
			'fadeOut'        => $this->attributes['fadeOut'],
			'fadeOutDelay'   => $this->attributes['backDelay'],
		);

		$typingHtmlTag = apply_filters('sb/blocks/typed/html/tag', 'span');

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-typing-effect-strings',
			'typography' => $this->attributes['stringTypography']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .typed-cursor',
			'typography' => $this->attributes['stringTypography']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-typing-effect-prefix',
			'typography' => $this->attributes['prefixTypography']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-typing-effect-suffix',
			'typography' => $this->attributes['suffixTypography']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-typing-effect-strings',
			'name'     => 'color',
			'value'    => $this->attributes['stringColor']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .typed-cursor',
			'name'     => 'color',
			'value'    => $this->attributes['stringColor']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-typing-effect-prefix',
			'name'     => 'color',
			'value'    => $this->attributes['prefixColor']
		));

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-typing-effect-suffix',
			'name'     => 'color',
			'value'    => $this->attributes['suffixColor']
		));

		$this->add_render_attribute('holder', 'class', 'sb-typing-effect-holder');
		$this->add_render_attribute('prefix', 'class', 'sb-typing-effect-prefix');
		$this->add_render_attribute('strings', 'class', 'sb-typing-effect-strings');
		$this->add_render_attribute('suffix', 'class', 'sb-typing-effect-suffix');

		$this->add_render_attribute('wrapper', 'class', $className);

		return '<div '.$this->get_render_attribute_string('wrapper').'>'. // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		       sprintf('<%1$s %2$s> </%1$s>',
			       $typingHtmlTag,
			       $this->get_render_attribute_string('holder'),
		       ).
		       ((!empty(trim($this->attributes['prefixText']))) ?
			       sprintf('<%1$s %2$s>%3$s</%1$s>',
				       $typingHtmlTag,
				       $this->get_render_attribute_string('prefix'),
				       esc_html($this->attributes['prefixText'])
			       ) : '').
		       sprintf('<%1$s %2$s></%1$s>',
			       $typingHtmlTag,
			       $this->get_render_attribute_string('strings'),
		       ).
		       ((!empty(trim($this->attributes['suffixText']))) ?
			       sprintf('<%1$s %2$s>%3$s</%1$s>',
				       $typingHtmlTag,
				       $this->get_render_attribute_string('suffix'),
				       esc_html($this->attributes['suffixText'])
			       ) : '').
		       '</div>';
	}
}


