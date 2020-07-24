<?php
/**
 * WooCommerce Modules: ET_Builder_Module_Woocommerce_Upsells class
 *
 * The ET_Builder_Module_Woocommerce_Upsells Class is responsible for rendering the
 * Upsells markup using the WooCommerce template.
 *
 * @package Divi\Builder
 *
 * @since   ??
 */

/**
 * Class representing WooCommerce Upsells component.
 */
class ET_Builder_Module_Woocommerce_Upsells extends ET_Builder_Module {
	/**
	 * Holds Prop values across static methods.
	 *
	 * @var array
	 */
	public static $static_props;

	/**
	 * Initialize.
	 */
	public function init() {
		$this->name   = esc_html__( 'Woo Upsell', 'et_builder' );
		$this->plural = esc_html__( 'Woo Upsells', 'et_builder' );

		// Use `et_pb_wc_{module}` for all WooCommerce modules.
		$this->slug       = 'et_pb_wc_upsells';
		$this->vb_support = 'on';

		$this->main_css_element = '%%order_class%%';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'overlay' => esc_html__( 'Overlay', 'et_builder' ),
					'image'   => esc_html__( 'Image', 'et_builder' ),
					// Avoid Text suffix by manually defining the `star` toggle slug.
					'star'    => esc_html__( 'Star Rating', 'et_builder' ),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'          => array(
				'title'         => array(
					'label'       => esc_html__( 'Title', 'et_builder' ),
					'css'         => array(
						'main'      => '%%order_class%% section.products > h1, %%order_class%% section.products > h2, %%order_class%% section.products > h3, %%order_class%% section.products > h4, %%order_class%% section.products > h5, %%order_class%% section.products > h6',
						'important' => 'all',
					),
					'font_size'   => array(
						'default' => '26px',
					),
					'line_height' => array(
						'default' => '1',
					),
				),
				'rating'        => array(
					'label'            => esc_html__( 'Star Rating', 'et_builder' ),
					'css'              => array(
						'main'                 => '%%order_class%% ul.products li.product .star-rating',
						'color'                => '%%order_class%% li.product .star-rating > span:before',
						'letter_spacing_hover' => '%%order_class%% ul.products li.product:hover .star-rating',
					),
					'font_size'        => array(
						'default' => 14,
					),
					'hide_font'        => true,
					'hide_line_height' => true,
					'hide_text_shadow' => true,
					'toggle_slug'      => 'star',
				),
				'product_title' => array(
					'label'       => esc_html__( 'Product Title', 'et_builder' ),
					'css'         => array(
						'main'      => "{$this->main_css_element} ul.products li.product h3, {$this->main_css_element} ul.products li.product h1, {$this->main_css_element} ul.products li.product h2, {$this->main_css_element} ul.products li.product h4, {$this->main_css_element} ul.products li.product h5, {$this->main_css_element} ul.products li.product h6",
						'important' => 'all',
					),
					'font_size'   => array(
						'default' => '1em',
					),
					'line_height' => array(
						'default' => '1',
					),
				),
				'price'         => array(
					'label'       => esc_html__( 'Price', 'et_builder' ),
					'css'         => array(
						'main' => "{$this->main_css_element} ul.products li.product .price, {$this->main_css_element} ul.products li.product .price .amount",
					),
					'font_size'   => array(
						'default' => '14px',
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
						'default'        => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
				),
				'sale_badge'    => array(
					'label'           => esc_html__( 'Sale Badge', 'et_builder' ),
					'css'             => array(
						'main'      => "{$this->main_css_element} ul.products li.product .onsale",
						'important' => array( 'line-height', 'font', 'text-shadow' ),
					),
					'hide_text_align' => true,
					'line_height'     => array(
						'default' => '1.7em',
					),
					'font_size'       => array(
						'default' => '20px',
					),
					'letter_spacing'  => array(
						'default' => '0px',
					),
				),
				'sale_price'    => array(
					'label'           => esc_html__( 'Sale Price', 'et_builder' ),
					'css'             => array(
						'main' => "{$this->main_css_element} ul.products li.product .price ins .amount",
					),
					'hide_text_align' => true,
					'font'            => array(
						'default' => '|700|||||||',
					),
					'font_size'       => array(
						'default' => '14px',
					),
					'line_height'     => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
						'default'        => '1.7em',
					),
				),
			),
			'borders'        => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => '%%order_class%%.et_pb_wc_upsells .product',
							'border_styles' => '%%order_class%%.et_pb_wc_upsells .product',
						),
					),
				),
				'image'   => array(
					'css'          => array(
						'main'      => array(
							'border_radii'  => '%%order_class%%.et_pb_module .et_shop_image > img, %%order_class%%.et_pb_module .et_shop_image',
							'border_styles' => '%%order_class%%.et_pb_module .et_shop_image > img',
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Image', 'et_builder' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'image',
				),
			),
			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main' => '%%order_class%% .product',
					),
				),
				'image'   => array(
					'label'             => esc_html__( 'Image Box Shadow', 'et_builder' ),
					'option_category'   => 'layout',
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'image',
					'css'               => array(
						'main'    => '%%order_class%% .et_shop_image',
						'overlay' => 'inset',
					),
					'default_on_fronts' => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'main'      => '%%order_class%%',
					// Needed to overwrite last module margin-bottom styling.
					'important' => array( 'custom_margin' ),
				),
			),
			'text'           => array(
				'css' => array(
					'text_shadow' => implode(
						', ',
						array(
							// Title.
							"{$this->main_css_element} ul.products h3",
							"{$this->main_css_element} ul.products  h1",
							"{$this->main_css_element} ul.products  h2",
							"{$this->main_css_element} ul.products  h4",
							"{$this->main_css_element} ul.products  h5",
							"{$this->main_css_element} ul.products  h6",
							// Price.
							"{$this->main_css_element} ul.products .price",
							"{$this->main_css_element} ul.products .price .amount",

						)
					),
				),
			),
			'filters'        => array(
				'child_filters_target' => array(
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'image',
				),
			),
			'image'          => array(
				'css' => array(
					'main' => '%%order_class%% .et_shop_image',
				),
			),
			'button'         => false,
		);

		$this->custom_css_fields = array(
			'product'   => array(
				'label'    => esc_html__( 'Product', 'et_builder' ),
				'selector' => 'li.product',
			),
			'onsale'    => array(
				'label'    => esc_html__( 'Onsale', 'et_builder' ),
				'selector' => 'li.product .onsale',
			),
			'image'     => array(
				'label'    => esc_html__( 'Image', 'et_builder' ),
				'selector' => '.et_shop_image',
			),
			'overlay'   => array(
				'label'    => esc_html__( 'Overlay', 'et_builder' ),
				'selector' => '.et_overlay',
			),
			'title'     => array(
				'label'    => esc_html__( 'Title', 'et_builder' ),
				'selector' => ET_Builder_Module_Helper_Woocommerce_Modules::get_title_selector(),
			),
			'rating'    => array(
				'label'    => esc_html__( 'Star Rating', 'et_builder' ),
				'selector' => '.star-rating',
			),
			'price'     => array(
				'label'    => esc_html__( 'Price', 'et_builder' ),
				'selector' => 'li.product .price',
			),
			'price_old' => array(
				'label'    => esc_html__( 'Old Price', 'et_builder' ),
				'selector' => 'li.product .price del span.amount',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( '7X03vBPYJ1o' ),
				'name' => esc_html__( 'Divi WooCommerce Modules', 'et_builder' ),
			),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_fields() {
		$post_id = $this->get_the_ID();
		$fields  = array(
			'product'             => ET_Builder_Module_Helper_Woocommerce_Modules::get_field(
				'product',
				array(
					'default'          => 'product' === $this->get_post_type() ? 'current' : 'latest',
					'computed_affects' => array(
						'__upsells',
					),
				)
			),
			'product_filter'      => ET_Builder_Module_Helper_Woocommerce_Modules::get_field(
				'product_filter',
				array(
					'computed_affects' => array(
						'__upsells',
					),
				)
			),
			'posts_number'        => ET_Builder_Module_Helper_Woocommerce_Modules::get_field(
				'posts_number',
				array(
					'default'          => ET_Builder_Module_Helper_Woocommerce_Modules::get_columns_posts_default_number_by_post_id( $post_id ),
					'computed_affects' => array(
						'__upsells',
					),
				)
			),
			'columns_number'      => ET_Builder_Module_Helper_Woocommerce_Modules::get_field(
				'columns_number',
				array(
					'default'          => ET_Builder_Module_Helper_Woocommerce_Modules::get_columns_posts_default_number_by_post_id( $post_id ),
					'computed_affects' => array(
						'__upsells',
					),
				)
			),
			'orderby'             => ET_Builder_Module_Helper_Woocommerce_Modules::get_field(
				'orderby',
				array(
					'options'          => array(
						'default'    => esc_html__( 'Random Order', 'et_builder' ),
						'menu_order' => esc_html__( 'Sort by Menu Order', 'et_builder' ),
						'popularity' => esc_html__( 'Sort By Popularity', 'et_builder' ),
						'date'       => esc_html__( 'Sort By Date: Oldest To Newest', 'et_builder' ),
						'date-desc'  => esc_html__( 'Sort By Date: Newest To Oldest', 'et_builder' ),
						'price'      => esc_html__( 'Sort By Price: Low To High', 'et_builder' ),
						'price-desc' => esc_html__( 'Sort By Price: High To Low', 'et_builder' ),
					),
					'computed_affects' => array(
						'__upsells',
					),
				)
			),
			'icon_hover_color'    => array(
				'label'          => esc_html__( 'Overlay Icon Color', 'et_builder' ),
				'description'    => esc_html__( 'Pick a color to use for the icon that appears when hovering over a product.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'overlay',
				'mobile_options' => true,
			),
			'hover_overlay_color' => array(
				'label'          => esc_html__( 'Overlay Background Color', 'et_builder' ),
				'description'    => esc_html__( 'Here you can define a custom color for the overlay', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'overlay',
				'mobile_options' => true,
			),
			'hover_icon'          => array(
				'label'           => esc_html__( 'Overlay Icon', 'et_builder' ),
				'description'     => esc_html__( 'Here you can define a custom icon for the overlay', 'et_builder' ),
				'type'            => 'select_icon',
				'option_category' => 'configuration',
				'class'           => array( 'et-pb-font-icon' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
				'mobile_options'  => true,
			),
			'__upsells'           => array(
				'type'                => 'computed',
				'computed_callback'   => array(
					'ET_Builder_Module_Woocommerce_Upsells',
					'get_upsells',
				),
				'computed_depends_on' => array(
					'product',
					'product_filter',
					'posts_number',
					'columns_number',
					'orderby',
				),
				'computed_minimum'    => array(
					'product',
				),
			),
		);

		return $fields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['rating_letter_spacing'] = array(
			'width'          => '%%order_class%% .star-rating',
			'letter-spacing' => '%%order_class%% .star-rating',
		);

		return $fields;
	}

	/**
	 * Gets the Upsells Products.
	 *
	 * Used as a callback to the __upsells computed prop.
	 *
	 * @param array $args             Arguments from Computed Prop AJAX call.
	 * @param array $conditional_tags Conditional Tags.
	 * @param array $current_page     Current page args.
	 *
	 * @return string
	 */
	public static function get_upsells( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		self::$static_props = $args;

		add_filter(
			'woocommerce_upsell_display_args',
			array(
				'ET_Builder_Module_Woocommerce_Upsells',
				'set_upsell_display_args',
			)
		);

		if ( isset( $args['orderby'] ) ) {
			$orderby = $args['orderby'];

			if ( in_array( $orderby, array( 'price', 'date' ), true ) ) {
				/*
				 * For the list of all allowed Orderby values, refer
				 *
				 * @see wc_products_array_orderby
				 */
				$args['order'] = 'asc';
			}
		}

		$output = et_builder_wc_render_module_template( 'woocommerce_upsell_display', $args );

		remove_filter(
			'woocommerce_upsell_display_args',
			array(
				'ET_Builder_Module_Woocommerce_Upsells',
				'set_upsell_display_args',
			)
		);

		return $output;
	}

	/**
	 * Returns the User selected Posts per page, columns and Order by values to WooCommerce.
	 *
	 * @param array $args Documented at
	 *                    {@see woocommerce_upsell_display()}.
	 *
	 * @return array
	 */
	public static function set_upsell_display_args( $args ) {
		$selected_args = self::get_selected_upsell_display_args();

		return wp_parse_args( $selected_args, $args );
	}

	/**
	 * Gets the User set Posts per page, columns and Order by values.
	 *
	 * The static variable used in this method is set by
	 *
	 * @see ET_Builder_Module_Woocommerce_Upsells::get_upsells()
	 *
	 * @return array
	 */
	public static function get_selected_upsell_display_args() {
		$selected_args                   = array();
		$selected_args['posts_per_page'] = et_()->array_get(
			self::$static_props,
			'posts_number',
			''
		);
		$selected_args['columns']        = et_()->array_get(
			self::$static_props,
			'columns_number',
			''
		);
		$selected_args['orderby']        = et_()->array_get(
			self::$static_props,
			'orderby',
			''
		);

		$selected_args = array_filter( $selected_args, 'strlen' );

		return $selected_args;
	}

	/**
	 * Renders the module output.
	 *
	 * @param  array  $attrs       List of attributes.
	 * @param  string $content     Content being processed.
	 * @param  string $render_slug Slug of module that is used for rendering output.
	 *
	 * @return string
	 */
	public function render( $attrs, $content = null, $render_slug ) {
		ET_Builder_Module_Helper_Woocommerce_Modules::process_background_layout_data( $render_slug, $this );
		ET_Builder_Module_Helper_Woocommerce_Modules::add_star_rating_style(
			$render_slug,
			$this->props,
			'%%order_class%% ul.products li.product .star-rating',
			'%%order_class%% ul.products li.product:hover .star-rating'
		);

		$sale_badge_color_hover    = $this->get_hover_value( 'sale_badge_color' );
		$sale_badge_color_values   = et_pb_responsive_options()->get_property_values( $this->props, 'sale_badge_color' );
		$icon_hover_color_values   = et_pb_responsive_options()->get_property_values( $this->props, 'icon_hover_color' );
		$hover_overlay_color_value = et_pb_responsive_options()->get_property_values( $this->props, 'hover_overlay_color' );

		// Sale Badge Color.
		et_pb_responsive_options()->generate_responsive_css( $sale_badge_color_values, '%%order_class%% span.onsale', 'background-color', $render_slug, ' !important;', 'color' );

		if ( et_builder_is_hover_enabled( 'sale_badge_color', $this->props ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%%:hover span.onsale',
					'declaration' => sprintf(
						'background-color: %1$s !important;',
						esc_html( $sale_badge_color_hover )
					),
				)
			);
		}

		// Icon Hover Color.
		et_pb_responsive_options()->generate_responsive_css( $icon_hover_color_values, '%%order_class%% .et_overlay:before', 'color', $render_slug, ' !important;', 'color' );

		// Hover Overlay Color.
		et_pb_responsive_options()->generate_responsive_css(
			$hover_overlay_color_value,
			'%%order_class%% .et_overlay',
			array(
				'background-color',
				'border-color',
			),
			$render_slug,
			' !important;',
			'color'
		);

		// Images: Add CSS Filters and Mix Blend Mode rules (if set).
		if ( array_key_exists( 'image', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['image'] ) ) {
			$this->add_classname(
				$this->generate_css_filters(
					$render_slug,
					'child_',
					self::$data_utils->array_get( $this->advanced_fields['image']['css'], 'main', '%%order_class%%' )
				)
			);
		}

		$this->add_classname( $this->get_text_orientation_classname() );

		$output = self::get_upsells( $this->props );

		// Render empty string if no output is generated to avoid unwanted vertical space.
		if ( '' === $output ) {
			return '';
		}

		add_filter(
			"et_builder_module_{$render_slug}_outer_wrapper_attrs",
			array(
				'ET_Builder_Module_Helper_Woocommerce_Modules',
				'output_data_icon_attrs',
			),
			10,
			2
		);

		$output = $this->_render_module_wrapper( $output, $render_slug );

		remove_filter(
			"et_builder_module_{$render_slug}_outer_wrapper_attrs",
			array(
				'ET_Builder_Module_Helper_Woocommerce_Modules',
				'output_data_icon_attrs',
			),
			10
		);

		return $output;
	}
}

new ET_Builder_Module_Woocommerce_Upsells();
