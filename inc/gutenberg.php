<?php


/*----------------------------------------------djh Dec 13, 2018
  NOTES
  https://www.advancedcustomfields.com/blog/acf-5-8-introducing-acf-blocks-for-gutenberg/
----------------------------------------------*/


/*----------------------------------------------djh Dec 13, 2018
  Get editor_color_palette from Theme Settings
----------------------------------------------*/
if ( ! function_exists('undercore_gutenberg_editor_color_palette') ) {
    function undercore_gutenberg_editor_color_palette() {
    	// start with Foundation defaults
    	$editor_color_palette = array(
		    array(
		        'name'  => __( 'Primary Color', 'undercore' ),
		        'slug'  => 'primary',
		        'color' => '#1779ba',
		    ),
		    array(
		        'name'  => __( 'Secondary Color', 'undercore' ),
		        'slug'  => 'secondary',
		        'color' => '#767676',
		    ),
		    array(
		        'name'  => __( 'Success Color', 'undercore' ),
		        'slug'  => 'success',
		        'color' => '#3adb76',
		    ),
		    array(
		        'name'  => __( 'Warning Color', 'undercore' ),
		        'slug'  => 'warning',
		        'color' => '#ffae00',
		    ),
		    array(
		        'name'  => __( 'Alert Color', 'undercore' ),
		        'slug'  => 'alert',
		        'color' => '#cc4b37',
		    ),
		    array(
		        'name'  => __( 'Simple White', 'undercore' ),
		        'slug'  => 'white',
		        'color' => '#ffffff',
		    ),
		    array(
		        'name'  => __( 'Simple Black', 'undercore' ),
		        'slug'  => 'black',
		        'color' => '#000000',
		    )
		);
    	// get custom color palette settings (if they exist)
		if ( get_option( 'options_uc_editor_color_palette' ) ) { 
			// flush the array
			$editor_color_palette = array();
			// get custom color settings as an array of textarea lines
			$custom_colors = preg_split("/\r\n|\n|\r/", get_option( 'options_uc_editor_color_palette' ));
			// recreate array with color settings
			if ( is_array($custom_colors) ) {
				foreach ($custom_colors as $num => $row) {
					if ( strpos($row, ' : ') === false ) {
						continue;
					}
					$color_data = explode(' : ', $row);
					$color_hex  = substr($color_data[0], -6);

					// if this is not a hex value, skip the row
					if ( ! ctype_xdigit( $color_hex ) && ! strlen( $color_hex ) == 6 ) {
					    continue;
					}

					$color_hex  = '#' . substr($color_data[0], -6);
					$color_slug = substr_replace($color_data[0],"", -7);
					$color_label= trim($color_data[1]);
					$editor_color_palette[] = array(
				        'name'  => __( $color_label, 'undercore' ),
				        'slug'  => $color_slug,
				        'color' => $color_hex
					);
				}
			}
		}
    	return $editor_color_palette;
    }
}



/*----------------------------------------------djh Dec 13, 2018
  Get editor_font_sizes from Theme Settings
----------------------------------------------*/
if ( ! function_exists('undercore_gutenberg_editor_font_sizes') ) {
    function undercore_gutenberg_editor_font_sizes() {
    	// start with defaults
    	$editor_font_sizes = array(
		    array(
		        'name' => __( 'small', 'undercore' ),
		        'shortName' => __( 'S', 'undercore' ),
		        'size' => 13,
		        'slug' => 'small'
		    ),
		    array(
		        'name' => __( 'regular', 'undercore' ),
		        'shortName' => __( 'M (H4)', 'undercore' ),
		        'size' => 16,
		        'slug' => 'regular'
		    ),
		    array(
		        'name' => __( 'large', 'undercore' ),
		        'shortName' => __( 'L (H3)', 'undercore' ),
		        'size' => 20,
		        'slug' => 'large'
		    ),
		    array(
		        'name' => __( 'h2', 'undercore' ),
		        'shortName' => __( 'H2', 'undercore' ),
		        'size' => 26,
		        'slug' => 'h2'
		    ),
		    array(
		        'name' => __( 'h1', 'undercore' ),
		        'shortName' => __( 'H1', 'undercore' ),
		        'size' => 33,
		        'slug' => 'h1'
		    ),
		    array(
		        'name' => __( 'hero', 'undercore' ),
		        'shortName' => __( 'Hero', 'undercore' ),
		        'size' => 42,
		        'slug' => 'hero'
		    )
		);

    	// get custom color palette settings (if they exist)
		if ( get_option( 'options_uc_editor_font_sizes' ) ) { 
			// flush the array
			$editor_font_sizes = array();
			// get custom color settings as an array of textarea lines
			$custom_font_sizes = preg_split("/\r\n|\n|\r/", get_option( 'options_uc_editor_font_sizes' ));
			// recreate array with color settings
			if ( is_array( $custom_font_sizes ) ) {
				foreach ($custom_font_sizes as $num => $row) {
					$font_size_data = explode(',', trim($row));
					// if there are more or fewer than 4 pieces, skip it
					if ( count( $font_size_data ) !== 4 ) {
						continue;
					}

					$fs_name      = preg_replace('/[^\w-]/', '', $font_size_data[0]);
					$fs_shortName = esc_html($font_size_data[1]);
					$fs_size      = intval($font_size_data[2]);
					$fs_slug      = preg_replace('/[^\w-]/', '', $font_size_data[3]);

					$editor_font_sizes[] = array(
				        'name' => __( $fs_name, 'undercore' ),
				        'shortName' => __( $fs_shortName, 'undercore' ),
				        'size' => $fs_size,
				        'slug' => $fs_slug
					);

				}
			}
		}
    	return $editor_font_sizes;
    }
}
























