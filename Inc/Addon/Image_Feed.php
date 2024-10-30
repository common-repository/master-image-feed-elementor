<?php
namespace JLTELIMF\Inc\Addon;

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \Elementor\Icons_Manager;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;    
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Scheme_Color;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 08/06/2020
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Master Instagram Addons for Elementor Class
 */


 class Image_Feed extends Widget_Base {

	public function get_name(){
		return "jltelimf";
	}

	public function get_title(){
        return esc_html__( 'Instagram Image Feed', 'master-image-feed-elementor' );
	}

	public function get_icon() {
		return 'ma-el-icon eicon-instagram-gallery';
	}

	public function get_categories() {
		return [ 'general', 'master-addons' ];
	}

	public function get_keywords() {
		return [
            'instagram',
            'instagram feed',
            'ma instagram feed',
            'instagram gallery',
            'ma instagram gallery',
            'social media',
            'social feed',
            'ma social feed',
            'instagram embed',
            'ma',
            'master addons',
            'instagram post',
            'instagram like',
            'instagram comments',
            'instagram video',
        ];
	}

    public function get_custom_help_url(){
        return 'http://master-addons.com/demos/instagram-feed';
    }

    public function get_style_depends(){
        return [
            'fancybox',
            'font-awesome-5-all',
            'font-awesome-4-shim',
            'master-instagram-style'
        ];
    }

    public function get_script_depends() {
        return [
            'jquery-slick',
            'isotope',
            'fancybox',
            'imagesloaded',
            'font-awesome-4-shim',
            'elementor-waypoints',
			'master-instagram-script'
        ];
    }

	protected function _register_controls() {

		//Instagram Settings
		$this->start_controls_section(
			'jltma_instafeed_display',
			[
				'label' => esc_html__( 'Instagram Account Settings', 'master-image-feed-elementor' ),
			]
		);

        $this->add_control(
            'jltma_instafeed_access_token',
            [
                'label' => esc_html__('Access Token', 'master-image-feed-elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('36409282899.8f4c5bf.2b5a056d124f4b83aa8bd90824d229d9', 'master-image-feed-elementor'),
                'description' => '<a href="https://www.jetseotools.com/instagram-access-token/" class="jtlma-btn" target="_blank">Get Access Token</a>', 'master-image-feed-elementor',
            ]
        );


        $this->end_controls_section();


        // Feed Settings
        $this->start_controls_section(
            'jltma_instafeed_settings_feed_section',
            [
                'label' => esc_html__('Feed Settings', 'master-image-feed-elementor'),
            ]
        );


        $this->add_responsive_control(
            'jltma_instafeed_image_count',
            [
                'label'                 => esc_html__('Show Items', 'master-image-feed-elementor'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 8 ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
            ]
        );

        $this->add_control(
            'jltma_instafeed_sort_by',
            [
                'label' => esc_html__('Sort By', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent-posts',
                'options' => [
                    'recent-posts' => esc_html__('Recent Posts', 'master-image-feed-elementor'),
                    'old-posts' => esc_html__('Old Posts', 'master-image-feed-elementor'),
                    'most-liked' => esc_html__('Most Likes', 'master-image-feed-elementor'),
                    'less-liked' => esc_html__('Less Likes', 'master-image-feed-elementor'),
                    'most-commented' => esc_html__('Most Commented', 'master-image-feed-elementor'),
                    'less-commented' => esc_html__('Less Commented', 'master-image-feed-elementor'),
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_image_size',
            [
                'label' => esc_html__('Image Size', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'default' => 'low_resolution',
                'options' => [
                    'thumbnail' => esc_html__('Thumbnail (150x150)', 'master-image-feed-elementor'),
                    'low_resolution' => esc_html__('Low Resolution (320x320)', 'master-image-feed-elementor'),
                    'standard_resolution' => esc_html__('Standard Resolution (640x640)', 'master-image-feed-elementor'),
                ],
                'style_transfer' => true,
            ]
        );


        $this->add_control(
            'jltma_instafeed_force_square',
            [
                'label' => esc_html__('Force Square Image?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'jltma_instafeed_sq_image_size',
            [
                'label' => esc_html__('Image Dimension (px)', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-square-img .jltma-instafeed-item .jltma-instafeed-img,
                    {{WRAPPER}} .jltma-instafeed-square-img .jltma-instafeed-item .jltma-instafeed-card-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
                'condition' => [
                    'jltma_instafeed_force_square' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();



        /**
         * Content Tab: Display Settings
         */
        $this->start_controls_section(
            'jltma_instafeed_section_display_settings',
            [
                'label'                 => esc_html__( 'Display Settings', 'master-image-feed-elementor' ),
            ]
        );

        $this->add_control(
            'jltma_instafeed_layout',
            [
                'label'                 => esc_html__( 'Layout', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'grid',
                'options'               => [
                   'grid'           => esc_html__( 'Grid', 'master-image-feed-elementor' ),
                   'card'           => esc_html__( 'Card Style', 'master-image-feed-elementor' )
                ],
                'frontend_available'    => true,
            ]
        );

        $this->add_responsive_control(
            'jltma_instafeed_cols',
            [
                'label'                 => esc_html__( 'Columns', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => '4',
                'tablet_default'        => '3',
                'mobile_default'        => '2',
                'options'               => [
                    '1'              => esc_html__( '1 Column', 'master-image-feed-elementor' ),
                    '2'              => esc_html__( '2 Columns', 'master-image-feed-elementor' ),
                    '3'              => esc_html__( '3 Columns', 'master-image-feed-elementor' ),
                    '4'              => esc_html__( '4 Columns', 'master-image-feed-elementor' ),
                    '5'              => esc_html__( '5 Columns', 'master-image-feed-elementor' ),
                    '6'              => esc_html__( '6 Columns', 'master-image-feed-elementor' ),
                    '7'              => esc_html__( '7 Columns', 'master-image-feed-elementor' ),
                    '8'              => esc_html__( '8 Columns', 'master-image-feed-elementor' )
                ],
                'selectors'             => [
                    '{{WRAPPER}} .jltelimf .jltma-instafeed-item' => 'width: calc( 100% / {{VALUE}} )',
                ],
                'condition'             => [
                    'jltma_instafeed_layout'       => ['grid', 'card']
                ],
            ]
        );


        $this->add_control(
            'jltma_instafeed_view_style',
            [
                'label' => esc_html__('Hover Style', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'default' => 'hover-info',
                'options' => [
                    'hover-info'        => esc_html__('Default Hover', 'master-image-feed-elementor'),
                    'btm-push-hover'    => esc_html__('Bottom Push Hover', 'master-image-feed-elementor')
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'jltma_instafeed_pagin_heading',
            [
                'label' => esc_html__('Pagination', 'master-image-feed-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );



        $this->add_control(
            'jltma_instafeed_caption_heading',
            [
                'label' => __('Other Settings', 'master-image-feed-elementor'),
                'type' => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'jltma_instafeed_show_likes',
            [
                'label' => esc_html__('Show Like?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'jltma_instafeed_date',
            [
                'label' => esc_html__('Display Date', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'jltma_instafeed_show_comments',
            [
                'label' => esc_html__('Show Comments?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'jltma_instafeed_show_caption',
            [
                'label' => esc_html__('Show Caption?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'jltma_instafeed_view_style!' => 'btm-push-hover',
                ],
                'style_transfer' => true,
            ]
        );



        $this->add_control(
            'jltma_instafeed_user_info',
            [
                'label' => esc_html__( 'User Info', 'master-image-feed-elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
            ]
        );
        $this->add_control(
            'jltma_instafeed_show_user_picture',
            [
                'label' => esc_html__('Show Profile Picture?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'jltma_instafeed_show_username',
            [
                'label' => esc_html__('Show Username?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'jltma_instafeed_show_insta_icon',
            [
                'label' => esc_html__('Show Instagram Icon?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'jltma_instafeed_show_user_postdate',
            [
                'label' => esc_html__('Show Post Date?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
                'style_transfer' => true,
            ]
        );




        $this->add_control(
            'jltma_instafeed_show_link',
            [
                'label' => esc_html__('Image Link?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'No',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'jltma_instafeed_link_target',
            [
                'label' => esc_html__('Open in new tab?', 'master-image-feed-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => '_blank',
                'default' => '_blank',
                'condition' => [
                    'jltma_instafeed_show_link' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_profile_link',
            [
                'label'                 => esc_html__( 'Show Link to Instagram Profile?', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => esc_html__( 'Yes', 'master-image-feed-elementor' ),
                'label_off'             => esc_html__( 'No', 'master-image-feed-elementor' ),
                'return_value'          => 'yes',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'jltma_instafeed_link_title',
            [
                'label'                 => esc_html__( 'Link Title', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => esc_html__( 'Follow Us @ Instagram', 'master-image-feed-elementor' ),
                'condition'             => [
                    'jltma_instafeed_profile_link' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_insta_profile_url',
            [
                'label'                 => esc_html__( 'Instagram Profile URL', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::URL,
                'placeholder'           => 'https://instagram.com/master-addons',
                'default'               => [
                    'url'           => '#',
                ],
                'condition'             => [
                    'jltma_instafeed_profile_link' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_title_icon',
            [
                'label'					=> esc_html__( 'Title Icon', 'master-image-feed-elementor' ),
                'type'					=> Controls_Manager::ICONS,
                'fa4compatibility'		=> 'jltma_instafeed_insta_title_icon',
                'recommended'			=> [
                    'fa-brands' => [
                        'instagram',
                    ],
                    'fa-solid' => [
                        'user-check',
                        'user-plus',
                    ],
                ],
                'default'				=> [
                    'value' => 'fab fa-instagram',
                    'library' => 'fa-brands',
                ],
                'condition'             => [
                    'jltma_instafeed_profile_link' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_title_icon_position',
            [
                'label'                 => esc_html__( 'Icon Position', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'before_title'   => esc_html__( 'Before Title', 'master-image-feed-elementor' ),
                   'after_title'    => esc_html__( 'After Title', 'master-image-feed-elementor' ),
                ],
                'default'               => 'before_title',
                'condition'             => [
                    'jltma_instafeed_profile_link' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();








        /**
         * Style Tab: Layout Style
         */
        $this->start_controls_section(
            'jltma_instafeed_styles_layout',
            [
                'label' => esc_html__('Layout Style', 'master-image-feed-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'jltma_instafeed_columns_gap',
            [
                'label'                 => esc_html__( 'Columns Gap', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units'            => [ 'px', '%' ],
                'range'                 => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .jltelimf .jltma-instafeed-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .jltma-instafeed-item .jltma-instafeed-item' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'jltma_instafeed_rows_gap',
            [
                'label'                 => esc_html__( 'Rows Gap', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'size_units'            => [ 'px', '%' ],
                'range'                 => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'tablet_default'        => [
                    'unit' => 'px',
                ],
                'mobile_default'        => [
                    'unit' => 'px',
                ],
                'selectors'             => [
                    '{{WRAPPER}} .jltelimf .jltma-instafeed-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );


        $this->add_control(
            'jltma_instafeed_container_box_bg',
            [
                'label' => esc_html__('Container Background', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltelimf' => 'background: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'jltma_instafeed_container_padding',
            [
                'label'                 => esc_html__( 'Padding', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', 'em', '%'],
                'selectors'         => [
                    '{{WRAPPER}} .jltelimf' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_container_margin',
            [
                'label'                 => esc_html__( 'Margin', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', 'em', '%'],
                'selectors'         => [
                    '{{WRAPPER}} .jltelimf' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();



        /**
         * Style Tab: Layout Style
         */
        $this->start_controls_section(
            'jltma_instafeed_item_styles',
            [
                'label' => esc_html__('Instagram Item Style', 'master-image-feed-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'jltma_instafeed_layout'       => ['grid', 'card']
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_item_box_bg',
            [
                'label' => esc_html__('Item Background', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instagram-item, {{WRAPPER}} .jltma-instafeed-item-inner' => 'background: {{VALUE}}',
                ],
            ]
        );



        $this->add_control(
            'jltma_instafeed_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'master-image-feed-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-item, {{WRAPPER}} .jltma-instafeed-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'jltma_instafeed_item_border',
                'label' => esc_html__('Border', 'master-image-feed-elementor'),
                'selector' => '{{WRAPPER}} .jltma-instafeed-item-inner',
            ]
        );


        $this->add_control(
            'jltma_instafeed_item_padding',
            [
                'label'                 => esc_html__( 'Padding', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', 'em', '%'],
                'selectors'         => [
                    '{{WRAPPER}} .jltma-instafeed-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_item_margin',
            [
                'label'                 => esc_html__( 'Margin', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => ['px', 'em', '%'],
                'selectors'         => [
                    '{{WRAPPER}} .jltma-instafeed-item-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'jltma_instafeed_item_card_header_bg_color',
            [
                'label' => esc_html__('Card Header BG', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-card header' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
            ]
        );
        $this->add_control(
            'jltma_instafeed_item_card_footer_bg_color',
            [
                'label' => esc_html__('Card Footer BG', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-card footer' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
            ]
        );


        $this->add_control(
            'jltma_instafeed_item_username_color',
            [
                'label' => esc_html__('Username Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-username' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
            ]
        );


        $this->add_control(
            'jltma_instafeed_item_username_hover_color',
            [
                'label' => esc_html__('Username Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-username:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_layout' => ['card'],
                ],
            ]
        );


        $this->add_control(
            'jltma_instafeed_item_like_color',
            [
                'label' => esc_html__('Likes Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-post-likes' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_show_likes' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_item_like_hover_color',
            [
                'label' => esc_html__('Likes Hover Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-post-likes:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_show_likes' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'jltma_instafeed_item_comment_color',
            [
                'label' => esc_html__('Comments Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-post-comments' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_show_comments' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_item_comment_hover_color',
            [
                'label' => esc_html__('Comments Hover Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-post-comments:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_show_comments' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_item_date_color',
            [
                'label' => esc_html__('Date Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-post-time' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_date' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'jltma_instafeed_item_insta_icon_color',
            [
                'label' => esc_html__('Instagram Icon Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-item.jltma-lightbox .jltma-instafeed-icon i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_show_insta_icon' => 'yes',
                    'jltma_instafeed_layout' => ['card']
                ],
            ]
        );

        $this->add_control(
            'jltma_instafeed_item_date_hover_color',
            [
                'label' => esc_html__('Date Hover Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-instafeed-post-time:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'jltma_instafeed_date' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'jltma_instafeed_item_caption_color',
            [
                'label' => esc_html__('Caption Color', 'master-image-feed-elementor'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jltma-insta-caption p, {{WRAPPER}} .jltma-instafeed-caption-text' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'jltma_instafeed_show_caption' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();



        /**
        * Style Tab: Images
        */
        $this->start_controls_section(
            'jltma_instafeed_section_image_style',
            [
                'label'                 => esc_html__( 'Images', 'master-image-feed-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'jltma_instafeed_image_tabs_style' );

        $this->start_controls_tab(
            'jltma_instafeed_image_tab_normal',
            [
                'label'                 => esc_html__( 'Normal', 'master-image-feed-elementor' ),
            ]
        );

        $this->add_control(
            'jltma_instafeed_image_grayscale',
            [
                'label'                 => esc_html__( 'Grayscale Image', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => esc_html__( 'Yes', 'master-image-feed-elementor' ),
                'label_off'             => esc_html__( 'No', 'master-image-feed-elementor' ),
                'return_value'          => 'yes',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'jltma_instafeed_image_border',
                'label'                 => esc_html__( 'Border', 'master-image-feed-elementor' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .jltelimf .jltma-instafeed-item .jltma-instafeed-img',
            ]
        );

        $this->add_control(
            'jltma_instafeed_image_border_radius',
            [
                'label'                 => esc_html__( 'Border Radius', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .jltelimf-gray img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'jltma_instafeed_image_hover',
            [
                'label'                 => esc_html__( 'Hover', 'master-image-feed-elementor' ),
            ]
        );

        $this->add_control(
            'jltma_instafeed_image_grayscale_hover',
            [
                'label'                 => esc_html__( 'Grayscale Image', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => esc_html__( 'Yes', 'master-image-feed-elementor' ),
                'label_off'             => esc_html__( 'No', 'master-image-feed-elementor' ),
                'return_value'          => 'yes',
            ]
        );

        $this->add_control(
            'jltma_instafeed_image_border_color_hover',
            [
                'label'                 => esc_html__( 'Border Color', 'master-image-feed-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .jltelimf-hover-gray img:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


    }


    protected function jltma_instagram_link_title(){
        $settings = $this->get_settings();

        // Profile Icon
        if ( ! isset( $settings['jltma_instafeed_title_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['jltma_instafeed_title_icon'] = 'fa fa-instagram';
        }

        $has_icon = ! empty( $settings['jltma_instafeed_title_icon'] );

        if ( $has_icon ) {
            $this->add_render_attribute( 'i', 'class', $settings['jltma_instafeed_title_icon'] );
            $this->add_render_attribute( 'i', 'aria-hidden', 'true' );
        }

        if ( ! $has_icon && ! empty( $settings['title_icon']['value'] ) ) {
            $has_icon = true;
        }
        $migrated = isset( $settings['__fa4_migrated']['title_icon'] );
        $is_new = ! isset( $settings['jltma_instafeed_title_icon'] ) && Icons_Manager::is_migration_allowed();


        if ( $settings['jltma_instafeed_profile_link'] == 'yes' && $settings['jltma_instafeed_link_title'] ) { ?>
            <span class="jltelimf-title-wrap">
                <a <?php echo $this->get_render_attribute_string( 'jltma_instagram_profile_link' ); ?>>
                    <span class="jltelimf-title">
                        <?php if ( $settings['jltma_instafeed_title_icon_position'] == 'before_title' && $has_icon ) { ?>
                            <span <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
                                <?php if ( $is_new || $migrated ) {
                                    Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] );
                                } elseif ( ! empty( $settings['jltma_instafeed_title_icon'] ) ) { ?>
                                    <i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
                                <?php } ?>
                            </span>
                        <?php } ?>

                        <?php echo esc_attr( $settings[ 'jltma_instafeed_link_title' ] ); ?>

                        <?php if ( $settings['jltma_instafeed_title_icon_position'] == 'after_title' && $has_icon ) { ?>
                            <span <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
                                <?php if ( $is_new || $migrated ) {
                                    Icons_Manager::render_icon( $settings['jltma_instafeed_insta_title_icon'], [ 'aria-hidden' => 'true' ] );
                                } elseif ( ! empty( $settings['jltma_instafeed_title_icon'] ) ) {
                                    ?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
                                } ?>
                            </span>
                        <?php } ?>
                    </span>
                </a>
            </span>
        <?php }
    }


    public function jltma_instafeed_render_items( $settings ){

        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'jltma_instafeed_load_more_action') {
            // check ajax referer
            check_ajax_referer('master-addons-elementor', 'security');

            // init vars
            $page = $_REQUEST['page'];
            parse_str($_REQUEST['settings'], $settings);
        } else {
            // init vars
            $page = 0;
            $settings = $this->get_settings();
        }

        $key = 'jltma_instafeed_' . str_replace('.', '_', $settings['jltma_instafeed_access_token']);
        $html = '';

        if (get_transient($key) === false) {

            // Show Feed by Username/Tags
            $instagram_data = wp_remote_retrieve_body(wp_remote_get('https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $settings['jltma_instafeed_access_token'] ));
            //     $instagram_data = wp_remote_retrieve_body('https://api.instagram.com/v1/tags/' . $settings['jltma_instafeed_tags'] . '/media/recent?access_token=' . $settings['jltma_instafeed_access_token'] );

            set_transient($key, $instagram_data, 1800);
        } else {
            $instagram_data = get_transient($key);
        }

        $instagram_data = json_decode($instagram_data, true);


        if (empty($instagram_data['data'])) {
            return;
        }

        if (empty( $settings['jltma_instafeed_image_count']['size'] )) {
            return;
        }

        switch ($settings['jltma_instafeed_sort_by']) {
            case 'recent-posts':
                usort($instagram_data['data'], function($a, $b) {
                    return $a['created_time'] < $b['created_time'];
                });
                break;

            case 'old-posts':
                usort($instagram_data['data'], function($a, $b) {
                    return $a['created_time'] > $b['created_time'];
                });
                break;

            case 'most-liked':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['likes']['count'] <= $b['likes']['count'];
                });
                break;

            case 'less-liked':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['likes']['count'] >= $b['likes']['count'];
                });
                break;

            case 'most-commented':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['comments']['count'] <= $b['comments']['count'];
                });
                break;

            case 'less-commented':
                usort($instagram_data['data'], function ($a, $b) {
                    return $a['comments']['count'] >= $b['comments']['count'];
                });
                break;
        }


        // Profile URL Link
        if ( ! empty( $settings['jltma_instafeed_insta_profile_url']['url'] ) ) {
            $this->add_render_attribute( 'jltma_instagram_profile_link', [
                'class'	=>  'jltma-insta-profile-link',
                'href'	=> esc_url_raw($settings['jltma_instafeed_insta_profile_url']['url'] ),
            ]);
        }

        if( $settings['jltma_instafeed_insta_profile_url']['is_external'] ) {
            $this->add_render_attribute( 'jltma_instagram_profile_link', 'target', '_blank' );
        }

        if( $settings['jltma_instafeed_insta_profile_url']['nofollow'] ) {
            $this->add_render_attribute( 'jltma_instagram_profile_link', 'rel', 'nofollow' );
        }

        $this->add_render_attribute('jltma_insta_inner', 'class', [ 'jltma-instafeed-item-inner' ] );

        if ($items = $instagram_data['data']) {
            $items = array_splice($items, ($page *  $settings['jltma_instafeed_image_count']['size']),  $settings['jltma_instafeed_image_count']['size']);

            foreach ($items as $k=>$item) {

                if ('yes' === $settings['jltma_instafeed_show_link']) {
                    $target = ( '_blank' ==$settings['jltma_instafeed_link_target']) ? 'target=_blank' : 'target=_self';
                } else {
                    $item['link'] = '#';
                    $target = '';
                } ?>




            <?php
            // Grid View
            if( $settings['jltma_instafeed_layout'] == 'grid' ) { ?>

                <a
                    href="<?php echo esc_url( $item['link'] );?>"
                    <?php echo esc_attr($target); ?>
                    class="jltma-instafeed-item">

                    <div <?php echo $this->get_render_attribute_string( 'jltma_insta_inner' ); ?>>
                        <img class="jltma-instafeed-img"

                            src="<?php echo esc_url( $item['images'][$settings['jltma_instafeed_image_size']]['url']);?>" width="<?php echo esc_attr( $item['images'][$settings['jltma_instafeed_image_size']]['width']);?>" height="<?php echo esc_attr( $item['images'][$settings['jltma_instafeed_image_size']]['height']);?>">


                        <div class="jltma-instafeed-item-details">
                            <div class="jltma-instafeed-meta">
                                <?php if ($settings['jltma_instafeed_show_likes'] == 'yes') { ?>
                                    <span class="jltma-instafeed-post-likes">
                                        <i class="far fa-heart" aria-hidden="true"></i>
                                        <?php echo $item['likes']['count'];?>
                                    </span>
                                <?php } ?>

                                <?php if ($settings['jltma_instafeed_show_comments'] =="yes") { ?>
                                    <span class="jltma-instafeed-post-comments">
                                        <i class="far fa-comments" aria-hidden="true"></i>
                                        <?php echo $item['comments']['count'];?>
                                    </span>
                                <?php } ?>

                                <?php if ($settings['jltma_instafeed_date'] =="yes") { ?>
                                    <span class="jltma-instafeed-post-time">
                                    <i class="far fa-clock" aria-hidden="true"></i>
                                        <?php echo esc_html( date('d M, Y', preg_replace('/[^\d]/','', $item['created_time'])) );?>
                                    </span>
                                <?php } ?>

                                <?php if ($settings['jltma_instafeed_view_style'] == 'hover-info' && $settings['jltma_instafeed_show_caption']=='yes' && !empty($item['caption']['text'])) { ?>
                                    <div class="jltma-insta-caption">
                                        <p class="jltma-instafeed-caption-text">
                                            <?php echo substr($item['caption']['text'], 0, 60);?>
                                        </p>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    </div> <!-- .jltma-instafeed-item-inner -->

                </a>

            <?php }

            // Card Style
            if ('card' == $settings['jltma_instafeed_layout'] ){ ?>

                <div class="jltma-instafeed-item">
                    <div <?php echo $this->get_render_attribute_string( 'jltma_insta_inner' ); ?>>

                        <header class="jltma-instafeed-item-header media">

                            <div class="jltma-instafeed-item-user clearfix media-left mr-3 mb-4 float-left">
                                <a href="//www.instagram.com/<?php echo esc_attr( $item['user']['username']);?>">
                                    <img src="<?php echo esc_url( $item['user']['profile_picture']);?>" alt="<?php echo esc_attr( $item['user']['username'] );?>" class="jltma-instafeed-avatar-img rounded-circle align-self-center">
                                </a>
                            </div>

                            <div class="media-body">
                                <a href="//www.instagram.com/<?php echo esc_attr( $item['user']['username']);?>" <?php echo esc_attr($target);?>>
                                    <span class="jltma-instafeed-username jltma-insta-user-meta">
                                        <?php echo esc_html( $item['user']['full_name'] );?>
                                    </span>
                                </a>

                                <?php if ($settings['jltma_instafeed_date'] =='yes') { ?>
                                    <span class="jltma-instafeed-post-time jltma-insta-user-meta">
                                        <i class="far fa-clock" aria-hidden="true"></i>
                                        <?php echo esc_html( date('d M, Y', preg_replace('/[^\d]/','', $item['created_time'])) );?>
                                    </span>
                                <?php } ?>
                            </div>

                            <?php //if ($settings['jltma_instafeed_show_insta_icon'] == 'yes') { ?>
                                <div class="jltma-instafeed-icon float-right align-self-center">
                                    <i class="fab fa-instagram" aria-hidden="true"></i>
                                </div>
                            <?php //} ?>
                        </header>

                        <a href="<?php echo esc_url( $item['link'] );?>" <?php echo esc_attr($target);?> class="jltma-instafeed-item-content">
                            <img class="jltma-instafeed-card-img" src="<?php echo esc_url( $item['images'][$settings['jltma_instafeed_image_size']]['url']);?>">
                        </a>

                        <footer class="jltma-instafeed-item-footer">
                            <div class="clearfix">

                                <?php if ($settings['jltma_instafeed_show_likes'] == 'yes') { ?>
                                    <span class="jltma-instafeed-post-likes">
                                        <i class="far fa-heart" aria-hidden="true"></i>
                                        <?php echo esc_html( $item['likes']['count'] );?>
                                    </span>

                                <?php }
                                if ($settings['jltma_instafeed_show_comments'] =="yes") { ?>

                                    <span class="jltma-instafeed-post-comments">
                                        <i class="far fa-comments" aria-hidden="true"></i>
                                        <?php echo esc_html( $item['comments']['count'] );?>
                                    </span>

                                <?php } ?>
                            </div>

                            <?php if ( $settings['jltma_instafeed_show_caption'] =="yes" && !empty($item['caption']['text'])) { ?>
                                <p class="jltma-instafeed-caption-text">
                                    <?php echo substr($item['caption']['text'], 0, 60);?>...
                                </p>
                            <?php } ?>
                        </footer>
                    </div>
                </div>
            <?php } // end of Card View


            }
        }

        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'jltma_instafeed_load_more_action') {
            wp_send_json([
                'num_pages' => ceil(count($instagram_data['data']) / $settings['jltma_instafeed_image_count']['size'] ),
                'html' => $html
            ]);
        }

        return $html;
    }

    protected function jltma_instafeed_caption(){
        $settings = $this->get_settings();

        if ( $settings['jltma_instafeed_show_caption']=='yes' && !empty($item['caption']['text'])) { ?>
            <div class="jltma-instafeed-caption">
                <div class="jltma-instafeed-caption-inner">
                    <div class="jltma-instafeed-meta">
                        <p class="jltma-instafeed-caption-text">
                            <?php echo substr($item['caption']['text'], 0, 60);?>
                        </p>
                    </div>
                </div>
            </div>

        <?php }
    }


	protected function render() {
        $settings = $this->get_settings_for_display();
        $id       = 'jltma-instagram-' . $this->get_id();
        $insta_layout = $settings['jltma_instafeed_layout'];


        // Grayscale Image
        if ( $settings['jltma_instafeed_image_grayscale'] == 'yes' ) {
            $this->add_render_attribute( 'jltma_instagram', 'class', 'jltelimf-gray' );
        }

        if ( $settings['jltma_instafeed_image_grayscale_hover'] == 'yes' ) {
            $this->add_render_attribute( 'jltma_instagram', 'class', 'jltelimf-hover-gray' );
        }


        $this->add_render_attribute(
            [
                'jltma_instagram' => [
                    'id'    => esc_attr( $id ),
                    'class' => implode(' ', [
                        'jltelimf',
                        ($settings['jltma_instafeed_force_square'] == 'yes') ? "jltma-instafeed-square-img" : "",
                        'jltma-instafeed-' . $settings['jltma_instafeed_layout'],
                        'jltma-instafeed-' . $insta_layout . '-' . $settings['jltma_instafeed_view_style']
                    ]),
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            "container_id"         => esc_attr( $this->get_id()),
                            "layout"               => esc_attr($insta_layout)
                        ]))
                    ]
                ]
            ]
        ); ?>

            <div <?php echo ( $this->get_render_attribute_string( 'jltma_instagram' ) ); ?>>
                <?php
                $this->jltma_instagram_link_title();
                $this->jltma_instafeed_render_items( $settings );?>
            </div>
            <div class="clearfix"></div>

            <?php

    }



}