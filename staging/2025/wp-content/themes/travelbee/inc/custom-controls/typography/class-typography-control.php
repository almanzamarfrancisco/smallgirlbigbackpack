<?php
/**
 * Travelbee Customizer Typography Control
 *
 * @package Travelbee
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! class_exists( 'Travelbee_Typography_Control' ) ) {
    
    class Travelbee_Typography_Control extends WP_Customize_Control {
    
    	public $tooltip = '';
    	public $js_vars = array();
    	public $output = array();
    	public $option_type = 'theme_mod';
    	public $type = 'travelbee-typography';
    
    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function to_json() {
    		parent::to_json();
    
    		if ( isset( $this->default ) ) {
    			$this->json['default'] = $this->default;
    		} else {
    			$this->json['default'] = $this->setting->default;
    		}
    		$this->json['js_vars'] = $this->js_vars;
    		$this->json['output']  = $this->output;
    		$this->json['value']   = $this->value();
    		$this->json['choices'] = $this->choices;
    		$this->json['link']    = $this->get_link();
    		$this->json['tooltip'] = $this->tooltip;
    		$this->json['id']      = $this->id;
    		$this->json['l10n']    = apply_filters( 'travelbee_il8n_strings', array(
    			'on'                 => esc_attr__( 'ON', 'travelbee' ),
    			'off'                => esc_attr__( 'OFF', 'travelbee' ),
    			'all'                => esc_attr__( 'All', 'travelbee' ),
    			'cyrillic'           => esc_attr__( 'Cyrillic', 'travelbee' ),
    			'cyrillic-ext'       => esc_attr__( 'Cyrillic Extended', 'travelbee' ),
    			'devanagari'         => esc_attr__( 'Devanagari', 'travelbee' ),
    			'greek'              => esc_attr__( 'Greek', 'travelbee' ),
    			'greek-ext'          => esc_attr__( 'Greek Extended', 'travelbee' ),
    			'khmer'              => esc_attr__( 'Khmer', 'travelbee' ),
    			'latin'              => esc_attr__( 'Latin', 'travelbee' ),
    			'latin-ext'          => esc_attr__( 'Latin Extended', 'travelbee' ),
    			'vietnamese'         => esc_attr__( 'Vietnamese', 'travelbee' ),
    			'hebrew'             => esc_attr__( 'Hebrew', 'travelbee' ),
    			'arabic'             => esc_attr__( 'Arabic', 'travelbee' ),
    			'bengali'            => esc_attr__( 'Bengali', 'travelbee' ),
    			'gujarati'           => esc_attr__( 'Gujarati', 'travelbee' ),
    			'tamil'              => esc_attr__( 'Tamil', 'travelbee' ),
    			'telugu'             => esc_attr__( 'Telugu', 'travelbee' ),
    			'thai'               => esc_attr__( 'Thai', 'travelbee' ),
    			'serif'              => _x( 'Serif', 'font style', 'travelbee' ),
    			'sans-serif'         => _x( 'Sans Serif', 'font style', 'travelbee' ),
    			'monospace'          => _x( 'Monospace', 'font style', 'travelbee' ),
    			'font-family'        => esc_attr__( 'Font Family', 'travelbee' ),
    			'font-size'          => esc_attr__( 'Font Size', 'travelbee' ),
    			'font-weight'        => esc_attr__( 'Font Weight', 'travelbee' ),
    			'line-height'        => esc_attr__( 'Line Height', 'travelbee' ),
    			'font-style'         => esc_attr__( 'Font Style', 'travelbee' ),
    			'letter-spacing'     => esc_attr__( 'Letter Spacing', 'travelbee' ),
    			'text-align'         => esc_attr__( 'Text Align', 'travelbee' ),
    			'text-transform'     => esc_attr__( 'Text Transform', 'travelbee' ),
    			'none'               => esc_attr__( 'None', 'travelbee' ),
    			'uppercase'          => esc_attr__( 'Uppercase', 'travelbee' ),
    			'lowercase'          => esc_attr__( 'Lowercase', 'travelbee' ),
    			'top'                => esc_attr__( 'Top', 'travelbee' ),
    			'bottom'             => esc_attr__( 'Bottom', 'travelbee' ),
    			'left'               => esc_attr__( 'Left', 'travelbee' ),
    			'right'              => esc_attr__( 'Right', 'travelbee' ),
    			'center'             => esc_attr__( 'Center', 'travelbee' ),
    			'justify'            => esc_attr__( 'Justify', 'travelbee' ),
    			'color'              => esc_attr__( 'Color', 'travelbee' ),
    			'select-font-family' => esc_attr__( 'Select a font-family', 'travelbee' ),
    			'variant'            => esc_attr__( 'Variant', 'travelbee' ),
    			'style'              => esc_attr__( 'Style', 'travelbee' ),
    			'size'               => esc_attr__( 'Size', 'travelbee' ),
    			'height'             => esc_attr__( 'Height', 'travelbee' ),
    			'spacing'            => esc_attr__( 'Spacing', 'travelbee' ),
    			'ultra-light'        => esc_attr__( 'Ultra-Light 100', 'travelbee' ),
    			'ultra-light-italic' => esc_attr__( 'Ultra-Light 100 Italic', 'travelbee' ),
    			'light'              => esc_attr__( 'Light 200', 'travelbee' ),
    			'light-italic'       => esc_attr__( 'Light 200 Italic', 'travelbee' ),
    			'book'               => esc_attr__( 'Book 300', 'travelbee' ),
    			'book-italic'        => esc_attr__( 'Book 300 Italic', 'travelbee' ),
    			'regular'            => esc_attr__( 'Normal 400', 'travelbee' ),
    			'italic'             => esc_attr__( 'Normal 400 Italic', 'travelbee' ),
    			'medium'             => esc_attr__( 'Medium 500', 'travelbee' ),
    			'medium-italic'      => esc_attr__( 'Medium 500 Italic', 'travelbee' ),
    			'semi-bold'          => esc_attr__( 'Semi-Bold 600', 'travelbee' ),
    			'semi-bold-italic'   => esc_attr__( 'Semi-Bold 600 Italic', 'travelbee' ),
    			'bold'               => esc_attr__( 'Bold 700', 'travelbee' ),
    			'bold-italic'        => esc_attr__( 'Bold 700 Italic', 'travelbee' ),
    			'extra-bold'         => esc_attr__( 'Extra-Bold 800', 'travelbee' ),
    			'extra-bold-italic'  => esc_attr__( 'Extra-Bold 800 Italic', 'travelbee' ),
    			'ultra-bold'         => esc_attr__( 'Ultra-Bold 900', 'travelbee' ),
    			'ultra-bold-italic'  => esc_attr__( 'Ultra-Bold 900 Italic', 'travelbee' ),
    			'invalid-value'      => esc_attr__( 'Invalid Value', 'travelbee' ),
    		) );
    
    		$defaults = array( 'font-family'=> false );
    
    		$this->json['default'] = wp_parse_args( $this->json['default'], $defaults );
    	}
    
    	/**
    	 * Enqueue scripts and styles.
    	 *
    	 * @access public
    	 * @return void
    	 */
    	public function enqueue() {
    		wp_enqueue_style( 'travelbee-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.css', null );
            
            wp_enqueue_script( 'jquery-ui-core' );
    		wp_enqueue_script( 'jquery-ui-tooltip' );
    		wp_enqueue_script( 'jquery-stepper-min-js' );
    		wp_enqueue_script( 'travelbee-selectize', get_template_directory_uri() . '/inc/js/selectize.js', array( 'jquery' ), false, true );
    		wp_enqueue_script( 'travelbee-typography', get_template_directory_uri() . '/inc/custom-controls/typography/typography.js', array( 'jquery', 'travelbee-selectize' ), false, true );
    
    		$google_fonts   = Travelbee_Fonts::get_google_fonts();
    		$standard_fonts = Travelbee_Fonts::get_standard_fonts();
    		$all_variants   = Travelbee_Fonts::get_all_variants();
    
    		$standard_fonts_final = array();
    		foreach ( $standard_fonts as $key => $value ) {
    			$standard_fonts_final[] = array(
    				'family'      => $value['stack'],
    				'label'       => $value['label'],
    				'is_standard' => true,
    				'variants'    => array(
    					array(
    						'id'    => 'regular',
    						'label' => $all_variants['regular'],
    					),
    					array(
    						'id'    => 'italic',
    						'label' => $all_variants['italic'],
    					),
    					array(
    						'id'    => '700',
    						'label' => $all_variants['700'],
    					),
    					array(
    						'id'    => '700italic',
    						'label' => $all_variants['700italic'],
    					),
    				),
    			);
    		}
    
    		$google_fonts_final = array();
    
    		if ( is_array( $google_fonts ) ) {
    			foreach ( $google_fonts as $family => $args ) {
    				$label    = ( isset( $args['label'] ) ) ? $args['label'] : $family;
    				$variants = ( isset( $args['variants'] ) ) ? $args['variants'] : array( 'regular', '700' );
    
    				$available_variants = array();
    				foreach ( $variants as $variant ) {
    					if ( array_key_exists( $variant, $all_variants ) ) {
    						$available_variants[] = array( 'id' => $variant, 'label' => $all_variants[ $variant ] );
    					}
    				}
    
    				$google_fonts_final[] = array(
    					'family'   => $family,
    					'label'    => $label,
    					'variants' => $available_variants
    				);
    			}
    		}
    
    		$final = array_merge( $standard_fonts_final, $google_fonts_final );
    		wp_localize_script( 'travelbee-typography', 'all_fonts', $final );
    	}
    
    	/**
    	 * An Underscore (JS) template for this control's content (but not its container).
    	 *
    	 * Class variables for this control class are available in the `data` JS object;
    	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
    	 *
    	 * I put this in a separate file because PhpStorm didn't like it and it fucked with my formatting.
    	 *
    	 * @see    WP_Customize_Control::print_template()
    	 *
    	 * @access protected
    	 * @return void
    	 */
    	protected function content_template(){ ?>
    		<# if ( data.tooltip ) { #>
                <a href="#" class="tooltip hint--left" data-hint="{{ data.tooltip }}"><span class='dashicons dashicons-info'></span></a>
            <# } #>
            
            <label class="customizer-text">
                <# if ( data.label ) { #>
                    <span class="customize-control-title">{{{ data.label }}}</span>
                <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
            </label>
            
            <div class="wrapper">
                <# if ( data.default['font-family'] ) { #>
                    <# if ( '' == data.value['font-family'] ) { data.value['font-family'] = data.default['font-family']; } #>
                    <# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>
                    <div class="font-family">
                        <h5>{{ data.l10n['font-family'] }}</h5>
                        <select id="travelbee-typography-font-family-{{{ data.id }}}" placeholder="{{ data.l10n['select-font-family'] }}"></select>
                    </div>
                    <div class="variant travelbee-variant-wrapper">
                        <h5>{{ data.l10n['style'] }}</h5>
                        <select class="variant" id="travelbee-typography-variant-{{{ data.id }}}"></select>
                    </div>
                <# } #>   
                
            </div>
            <?php
		}
		
		protected function render_content(){
			
		}
    }
}