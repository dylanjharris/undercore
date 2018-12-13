<?php


/*----------------------------------------------djh Dec 13, 2018
  Get editor_color_palette from Theme Settings
----------------------------------------------*/
if ( ! function_exists('undercore_gutenberg_editor_color_palette') ) {
    function undercore_gutenberg_editor_color_palette() {
    	$editor_color_palette = array(
		    array(
		        'name' => __( 'Primary Color', 'undercore' ),
		        'slug' => 'primary',
		        'color' => '#1779ba',
		    ),
		    array(
		        'name' => __( 'Secondary Color', 'undercore' ),
		        'slug' => 'secondary',
		        'color' => '#767676',
		    ),
		    array(
		        'name' => __( 'Success Color', 'undercore' ),
		        'slug' => 'success',
		        'color' => '#3adb76',
		    ),
		    array(
		        'name' => __( 'Warning color', 'undercore' ),
		        'slug' => 'warning',
		        'color' => '#ffae00',
		    ),
		    array(
		        'name' => __( 'Alert color', 'undercore' ),
		        'slug' => 'alert',
		        'color' => '#cc4b37',
		    )
		);
    	return $editor_color_palette;
    }
}