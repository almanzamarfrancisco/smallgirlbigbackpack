<?php
/**
 * Class to Build the Advanced Form Radio Block.
 *
 * @package Kadence Blocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Kadence_Blocks_Radio_Block extends Kadence_Blocks_Advanced_Form_Input_Block {

	/**
	 * Instance of this class
	 *
	 * @var null
	 */
	private static $instance = null;

	/**
	 * Block name within this namespace.
	 *
	 * @var string
	 */
	protected $block_name = 'radio';


	/**
	 * Instance Control
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Builds CSS for block.
	 *
	 * @param array  $attributes the blocks attributes.
	 * @param string $css the css class for blocks.
	 * @param string $unique_id the blocks attr ID.
	 * @param string $unique_style_id the blocks alternate ID for queries.
	 */
	public function build_css( $attributes, $css, $unique_id, $unique_style_id ) {
		$css->set_style_id( 'kb-' . $this->block_name . $unique_style_id );
		$css->set_selector( '.wp-block-kadence-advanced-form .kb-field' . $unique_style_id );

		$css->render_responsive_range( $attributes, 'maxWidth', 'max-width', 'maxWidthUnit' );
		$css->render_responsive_range( $attributes, 'minWidth', 'min-width', 'minWidthUnit' );

		return $css->css_output();
	}

	/**
	 * Return dynamically generated HTML for block
	 *
	 * @param $attributes
	 * @param $unique_id
	 * @param $content
	 * @param WP_Block $block_instance The instance of the WP_Block class that represents the block being rendered.
	 *
	 * @return mixed
	 */
	public function build_html( $attributes, $unique_id, $content, $block_instance ) {
		$type = 'radio';
		$is_required = $this->is_required( $attributes );
		$outer_classes = array( 'kb-adv-form-field', 'kb-field' . $unique_id );
		if ( ! empty( $attributes['className'] ) ) {
			$outer_classes[] = $attributes['className'];
		}
		$wrapper_args = array(
			'class' => implode( ' ', $outer_classes ),
		);
		$wrapper_attributes = get_block_wrapper_attributes( $wrapper_args );
		$inner_content  = '';

		$radio_label = $attributes;
		$radio_label['inputName'] = 'rb' . $unique_id;

		$inner_content .= '<fieldset class="kb-radio-check-item-wrap" id="' . $this->field_name( $radio_label ) . '" data-type="radio" data-required="' . $is_required . '" ' . $this->additional_fieldset_attributes( $attributes ) . '>';
		$inner_content      .= $this->field_legend( $radio_label );
		$inner_content      .= $this->field_aria_label( $attributes );
		foreach ( $attributes['options'] as $key => $option ) {
			$id         = 'field' . $unique_id . '_' . $key;
			$is_checked_from_param = ! empty( $option['value'] ) && $option['value'] && $option['value'] == $this->get_default( $attributes );
			$is_checked_from_editor = ! empty( $option['selected'] );
			$is_checked = $is_checked_from_editor || $is_checked_from_param;

			$inner_content .= '<div class="kb-radio-check-item">';
			$inner_content .= '<input class="kb-radio-style" type="radio" ' . $this->aria_described_by( $attributes ) . ' id="' . $id . '" name="' . $this->field_name( $attributes ) . '" ' . ( $is_checked ? "checked" : "" ) . ' value="' . $this->get_option_value( $option ) . '" >';

			$inner_content .= '<label for="' . $id . '">' . $option['label'] . '</label>';

			$description   = array(
				'uniqueID' => $id,
				'label'    => ! empty( $attributes['description'] ) ? ' ' . $attributes['description'] : '',
			);
			$inner_content .= $this->field_label( $description );

			$inner_content .= '</div>';
		}

		$inner_content .= '</fieldset>';

		$inner_content .= $this->field_help_text( $attributes );

		$content = sprintf( '<div %1$s>%2$s</div>', $wrapper_attributes, $inner_content );
		return $content;
	}
}

Kadence_Blocks_Radio_Block::get_instance();
