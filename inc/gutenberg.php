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
		        'name'  => __( 'Warning color', 'undercore' ),
		        'slug'  => 'warning',
		        'color' => '#ffae00',
		    ),
		    array(
		        'name'  => __( 'Alert color', 'undercore' ),
		        'slug'  => 'alert',
		        'color' => '#cc4b37',
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


















