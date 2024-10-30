<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @version       1.0.0
 * @package       JLT_Elementor_Image_Feed
 * @license       Copyright JLT_Elementor_Image_Feed
 */

if ( ! function_exists( 'jltelimf_option' ) ) {
	/**
	 * Get setting database option
	 *
	 * @param string $section default section name jltelimf_general .
	 * @param string $key .
	 * @param string $default .
	 *
	 * @return string
	 */
	function jltelimf_option( $section = 'jltelimf_general', $key = '', $default = '' ) {
		$settings = get_option( $section );

		return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
	}
}

if ( ! function_exists( 'jltelimf_exclude_pages' ) ) {
	/**
	 * Get exclude pages setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltelimf_exclude_pages() {
		return jltelimf_option( 'jltelimf_triggers', 'exclude_pages', array() );
	}
}

if ( ! function_exists( 'jltelimf_exclude_pages_except' ) ) {
	/**
	 * Get exclude pages except setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltelimf_exclude_pages_except() {
		return jltelimf_option( 'jltelimf_triggers', 'exclude_pages_except', array() );
	}
}