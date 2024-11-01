<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use DateTime;
use DateTimeInterface;
use SoloBlocks\CSS_Vars;

class Countdown extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *     date: string,
	 *     showMonths: bool,
	 *     showDays: bool,
	 *     showHours: bool,
	 *     showMinutes: bool,
	 *     showSeconds: bool,
	 *     initialOpen: bool,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){
		
		$className = array(
			'sb-content-alignment-'.$this->attributes['contentAlignment'],
		);
		
		if(empty($this->attributes['date'])) {
			$datetime = new DateTime('now', wp_timezone());
			$datetime->modify('+30 Days');
			
			$this->attributes['date'] = $datetime->format(DateTimeInterface::ATOM);
		}
		
		$this->dataSettings = array(
			'until'  => $this->attributes['date'],
			'format' => ($this->attributes['showMonths'] ? 'O' : '').
			            ($this->attributes['showDays'] ? 'D' : '').
			            ($this->attributes['showHours'] ? 'H' : '').
			            ($this->attributes['showMinutes'] ? 'M' : '').
			            ($this->attributes['showSeconds'] ? 'S' : ''),
			'label'  => array(
				'years'   => esc_html__('Years', 'solo-blocks'),
				'months'  => esc_html__('Months', 'solo-blocks'),
				'weeks'   => esc_html__('Weeks', 'solo-blocks'),
				'days'    => esc_html__('Days', 'solo-blocks'),
				'hours'   => esc_html__('Hours', 'solo-blocks'),
				'minutes' => esc_html__('Minutes', 'solo-blocks'),
				'seconds' => esc_html__('Seconds', 'solo-blocks'),
			),
			'label1' => array(
				'years'   => esc_html__('Year', 'solo-blocks'),
				'months'  => esc_html__('Month', 'solo-blocks'),
				'weeks'   => esc_html__('Week', 'solo-blocks'),
				'days'    => esc_html__('Day', 'solo-blocks'),
				'hours'   => esc_html__('Hour', 'solo-blocks'),
				'minutes' => esc_html__('Minute', 'solo-blocks'),
				'seconds' => esc_html__('Second', 'solo-blocks'),
			)
		);
		
		CSS_Vars::add(
			$this->selector.' .countdown-section',
			array(
				'--item_spacing' => $this->attributes['itemSpacing'].'px'
			)
		);
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .countdown-amount',
			'typography' => $this->attributes['digitsTypography']
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector.' .countdown-amount',
			'name'     => 'color',
			'value'    => $this->attributes['digitsColor']
		));
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .countdown-period',
			'typography' => $this->attributes['descriptionTypography']
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector.' .countdown-period',
			'name'     => 'color',
			'value'    => $this->attributes['descriptionColor']
		));
		
		$this->add_render_attribute('wrapper', 'class', $className);
		?>
		<div <?php $this->print_render_attribute_string('wrapper') ?>></div>
		<?php
	}
}


