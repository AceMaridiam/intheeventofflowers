<?php

global $wp_customize;

if ( isset( $wp_customize ) ) {
	
	/* Add additional options to Theme Customizer */
	function perfetta_init_customizer( $wp_customize ) {
		
		// Add new settings sections
	    $wp_customize->add_section(
	    'perfetta_font_options',
	    array(
	        'title'     => __('Font options', 'perfetta'),
	        'priority'  => 200
	    	)
	    );
	    
	    $wp_customize->add_section(
	    'perfetta_layout_options',
	    array(
	        'title'     => __('Layout & Features', 'perfetta'),
	        'priority'  => 300
	    	)
	    );
	    
	    // Add new settings
	    $wp_customize->add_setting(
	    	'perfetta_logo',
	    	array(
	    		'default' => '',
	    		'capability' => 'edit_theme_options',
	    		'sanitize_callback' => 'esc_url_raw'
	    	)
	    );
	    
	    $wp_customize->add_setting( 
	    	'perfetta_primary_color', 
	    	array( 
	    		'default' => '#e83a34', 
	    		'capability' => 'edit_theme_options',
	    		'transport' => 'postMessage',
	    		'sanitize_callback' => 'sanitize_hex_color'
	    	)
	    );
	    
	    $wp_customize->add_setting( 
	    	'perfetta_footer_color', 
	    	array( 
	    		'default' => '#fff', 
	    		'capability' => 'edit_theme_options',
	    		'transport' => 'postMessage',
	    		'sanitize_callback' => 'sanitize_hex_color'
	    	)
	    );
	    
		$wp_customize->add_setting(
			'perfetta_font',
			array(
			    'default'   => 'google',
			    'capability' => 'edit_theme_options',
			    'sanitize_callback' => 'perfetta_sanitize_font'
			)
		);
		
		$wp_customize->add_setting(
		    'perfetta_google_font',
		    array(
		        'default'   => '//fonts.googleapis.com/css?family=Cookie',
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw'
		    )
		);
		
		$wp_customize->add_setting(
			'perfetta_body_font',
			array(
			    'default'   => 'google',
			    'capability' => 'edit_theme_options',
			    'sanitize_callback' => 'perfetta_sanitize_font'
			)
		);
			
		$wp_customize->add_setting(
		    'perfetta_body_google_font',
		    array(
		        'default'   => '//fonts.googleapis.com/css?family=Raleway:300,400,700',
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw'
		    )
		);
		
		$wp_customize->add_setting(
			'perfetta_bottom_column',
			array( 
				'default'   => '2',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'perfetta_sanitize_bottom_column'
			)
		);
		
		$wp_customize->add_setting(
			'perfetta_top_color',
			array( 
				'default'   => 'light',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'perfetta_sanitize_bg_color'
			)
		);
		
		$wp_customize->add_setting(
			'perfetta_bottom_color',
			array( 
				'default'   => 'dark',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'perfetta_sanitize_bg_color'
			)
		);
		
		$wp_customize->add_setting(
			'perfetta_search_area',
			array( 
				'default'   => '0',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		
		$wp_customize->add_setting(
			'perfetta_scroll_reveal',
			array( 
				'default'   => '1',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		
		$wp_customize->add_setting(
			'perfetta_show_author_avatar',
			array( 
				'default'   => '0',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		
		$wp_customize->add_setting(
			'perfetta_date_format',
			array( 
				'default'   => 'default',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'perfetta_sanitize_date_format'
			)
		);
		
		$wp_customize->add_setting(
            'perfetta_word_break',
            array(
                'default'   => '0',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        
        $wp_customize->add_setting(
            'perfetta_social_icons_footer',
            array(
                'default'   => '1',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
		
		// Add control for the settings
		$wp_customize->add_control(
			new WP_Customize_Image_Control( 
				$wp_customize, 
				'perfetta_logo', 
				array(
					'label'      => __('Logo image', 'perfetta'),
					'section'    => 'title_tagline',
					'settings'   => 'perfetta_logo'
				) 
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 
				'perfetta_primary_color', 
				array( 
					'label' => __('Primary Color', 'perfetta'), 
					'section' => 'colors', 
					'settings' => 'perfetta_primary_color'
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 
				'perfetta_footer_color', 
				array( 
					'label' => __('Footer Color', 'perfetta'), 
					'section' => 'colors', 
					'settings' => 'perfetta_footer_color'
				)
			)
		);
		
		$wp_customize->add_control(
		    'perfetta_font',
		    array(
		        'section'  => 'perfetta_font_options',
		        'label'    => __('Header Font', 'perfetta'),
		        'type'     => 'select',
		        'choices'  => array(
		        	'google'    		=> 'Google Font',
		        	'verdana'   		=> 'Verdana',
		        	'georgia'    		=> 'Georgia',
		        	'arial'      		=> 'Arial',
		        	'impact'     		=> 'Impact',
		        	'tahoma'     		=> 'Tahoma',
		            'times'      		=> 'Times New Roman',		            
		            'comic sans ms'     => 'Comic Sans MS',
		            'courier new'   	=> 'Courier New',
		            'helvetica'  		=> 'Helvetica'
		        )
		   	 )
		);
	
		$wp_customize->add_control(
		    'perfetta_google_font',
		    array(
		        'section'  => 'perfetta_font_options',
		        'label'    => __('Google Font URL for Header', 'perfetta'),
		        'type'     => 'text',
		        'active_callback' => 'perfetta_show_font_field'
	    	)
		);
			
		$wp_customize->add_control(
		    'perfetta_body_font',
		    array(
		        'section'  => 'perfetta_font_options',
		        'label'    => __('Body Font', 'perfetta'),
		        'type'     => 'select',
		        'choices'  => array(
		        	'google'    		=> 'Google Font',
		        	'verdana'   		=> 'Verdana',
		        	'georgia'    		=> 'Georgia',
		        	'arial'      		=> 'Arial',
		        	'impact'     		=> 'Impact',
		        	'tahoma'     		=> 'Tahoma',
		            'times'      		=> 'Times New Roman',		            
		            'comic sans ms'     => 'Comic Sans MS',
		            'courier new'   	=> 'Courier New',
		            'helvetica'  		=> 'Helvetica'
		        )
		   	 )
		);	
		
		$wp_customize->add_control(
		    'perfetta_body_google_font',
		    array(
		        'section'  => 'perfetta_font_options',
		        'label'    => __('Google Font URL for the Body', 'perfetta'),
		        'type'     => 'text',
		        'active_callback' => 'perfetta_show_body_font_field'
	    	)
		);
		
		$wp_customize->add_control(
		    'perfetta_bottom_column',
		    array(
		        'section'  => 'perfetta_layout_options',
		        'label'    => __('Amount of bottom columns', 'perfetta'),
		        'type'     => 'select',
		        'choices'  => array(
		            '1'     => __('1 Column', 'perfetta'),
		            '2'     => __('2 Columns', 'perfetta'),
		            '3'     => __('3 Columns', 'perfetta')
		        ),
		        'priority' => 0
		    )
		);
		
		$wp_customize->add_control(
		    'perfetta_top_color',
		    array(
		        'section'  => 'perfetta_layout_options',
		        'label'    => __('Color of the top', 'perfetta'),
		        'type'     => 'select',
		        'choices'  => array(
		            'dark'     => __('Dark background', 'perfetta'),
		            'light'     => __('Light background', 'perfetta')
		        ),
		        'priority' => 1
		    )
		);
		
		$wp_customize->add_control(
		    'perfetta_bottom_color',
		    array(
		        'section'  => 'perfetta_layout_options',
		        'label'    => __('Color of the bottom', 'perfetta'),
		        'type'     => 'select',
		        'choices'  => array(
		            'dark'     => __('Dark background', 'perfetta'),
		            'light'     => __('Light background', 'perfetta')
		        ),
		        'priority' => 2
		    )
		);
		
		$wp_customize->add_control(
		    'perfetta_date_format',
		    array(
		        'section'  => 'perfetta_layout_options',
		        'label'    => __('Date format', 'perfetta'),
		        'type'     => 'select',
		        'choices'  => array(
		            'default'     => __('Default theme format', 'perfetta'),
		            'wordpress'     => __('WordPress Date Format', 'perfetta')
		        ),
		        'priority' => 3
		    )
		);
		
		$wp_customize->add_control(
		    'perfetta_search_area',
		    array(
		        'section'  => 'perfetta_layout_options',
		        'label'    => __('Show search area', 'perfetta'),
		        'type'     => 'checkbox',
		        'priority' => 4
		    )
		);
		
		$wp_customize->add_control(
		    'perfetta_scroll_reveal',
		    array(
		        'section'  => 'perfetta_layout_options',
		        'label'    => __('Use Scroll Reveal', 'perfetta'),
		        'type'     => 'checkbox',
		        'priority' => 5
		    )
		);
		
		$wp_customize->add_control(
		    'perfetta_show_author_avatar',
		    array(
		        'section'  => 'perfetta_layout_options',
		        'label'    => __('Show author avatar', 'perfetta'),
		        'type'     => 'checkbox',
		        'priority' => 6
		    )
		);
		
		$wp_customize->add_control(
            'perfetta_word_break',
            array(
                'section'  => 'perfetta_layout_options',
                'label'    => __('Enable word-break', 'perfetta'),
                'type'     => 'checkbox',
                'priority' => 7
            )
        );
        
        $wp_customize->add_control(
            'perfetta_social_icons_footer',
            array(
                'section'  => 'perfetta_layout_options',
                'label'    => __('Show social icons at footer', 'perfetta'),
                'type'     => 'checkbox',
                'priority' => 8
            )
        );
	}
	
	add_action( 'customize_register', 'perfetta_init_customizer' );
}
/*
 * Active callback functions
 */
function perfetta_show_font_field($control) {
    $option = $control->manager->get_setting('perfetta_font');
    return $option->value() == 'google';
}

function perfetta_show_body_font_field($control) {
    $option = $control->manager->get_setting('perfetta_body_font');
    return $option->value() == 'google';
}

/*
 * Sanitization functions
 */

function perfetta_sanitize_bottom_column($value) {
	if($value === '1' || $value === '2' || $value === '3') {
		return $value;
	}
	return null;	
}

function perfetta_sanitize_bg_color($value) {
	if($value === 'light' || $value === 'dark') {
		return $value;
	}
	return null;
}

function perfetta_sanitize_font($value) {
	$fonts = array(
		'google', 
		'verdana', 
		'georgia', 
		'arial', 
		'impact', 
		'tahoma', 
		'times',
		'comic sans ms',
		'courier new',
		'helvetica'
	);
	
	if(in_array($value, $fonts)) {
		return $value;
	}
	
	return null;
}

function perfetta_sanitize_date_format($value) {
	if($value === 'default' || $value === 'wordpress') {
		return $value;
	}
	return null;
}

// Add CSS styles generated from GK Cusotmizer settings
function perfetta_customizer_css() {
	$google = esc_attr(get_theme_mod('perfetta_google_font', '//fonts.googleapis.com/css?family=Cookie'));
	$fname = array();
	preg_match('@family=(.+)$@is', $google, $fname);
	$font_family = "'" . str_replace('+', ' ', preg_replace('@:.+@', '', preg_replace('@&.+@', '', $fname[1]))) . "'";
	
	$body_google = esc_attr(get_theme_mod('perfetta_body_google_font', '//fonts.googleapis.com/css?family=Raleway:300,400,700'));
	$body_fname = array();
	preg_match('@family=(.+)$@is', $body_google, $body_fname);
	$body_font_family = "'" . str_replace('+', ' ', preg_replace('@:.+@', '', preg_replace('@&.+@', '', $body_fname[1]))) . "'";
    
    if (get_theme_mod('perfetta_font') == 'google') {
    	$perfetta_font = $font_family;
    } else {
    	$perfetta_font = esc_attr(get_theme_mod('perfetta_font'));
    }
    
    if (get_theme_mod('perfetta_body_font') == 'google') {
    	$body_perfetta_font = $body_font_family;
    } else {
    	$body_perfetta_font = esc_attr(get_theme_mod('perfetta_body_font'));
    }
    
    $primary_color = esc_attr(get_theme_mod('perfetta_primary_color', '#e83a34'));
    $footer_color = esc_attr(get_theme_mod('perfetta_footer_color', '#fff'));
    
    ?>   
    <style type="text/css">
    	body { font-family: <?php echo $body_perfetta_font; ?> }
        .site-title { font-family: <?php echo $perfetta_font; ?> }
    
    	<?php if(get_theme_mod('perfetta_word_break', '1') == '1') : ?>
        body {
            -ms-word-break: break-all;
            word-break: break-all;
            word-break: break-word;
            -webkit-hyphens: auto;
            -moz-hyphens: auto;
            -ms-hyphens: auto;
            hyphens: auto;
        }
        <?php endif; ?>
    	
        a,
        blockquote:before,
        button,
        input[type="submit"],
        input[type="button"],
        input[type="reset"],
        .nav-menu .current_page_item > a,
        .nav-menu .current_page_ancestor > a,
        .nav-menu .current-menu-item > a,
        .nav-menu .current-menu-ancestor > a,
        .entry-title.sticky span:before,
        .entry-title a:hover,
        .entry-summary .readon,
        .author-description .author-title,
        .comment-author .fn,
        .comment-author .url,
        .comment-reply-link,
        .comment-reply-login,
        .social-menu li:active,
        .social-menu li:focus,
        .social-menu li:hover,
        #gk-copyrights a,
        .nav-menu > li > a:active,
        .nav-menu > li > a:focus,
        .nav-menu > li > a:hover,
        body .footer-menu li > a:active,
        body .footer-menu li > a:focus,
        body .footer-menu li > a:hover {
        	color: <?php echo $primary_color; ?>;
        }
        button,
        input[type="submit"],
        input[type="button"],
        input[type="reset"],
        .entry-summary .readon {
        	border: 1px solid <?php echo $primary_color; ?>;
        }
        ul.nav-menu ul a:hover,
        .nav-menu ul ul a:hover,
        #content > article > aside > time,
        .paging-navigation .nav-links,
        .paging-navigation a:active,
        .paging-navigation a:focus,
        .paging-navigation a:hover {
        	background-color: <?php echo $primary_color; ?>;
        }
        #content > article >aside:after {
        	border-left: 8px solid <?php echo $primary_color; ?>;
        }
        #gk-copyrights,
        .social-menu li,
        .social-menu li > a,
        body .footer-menu li,
        body .footer-menu li > a {
        	color: <?php echo $footer_color; ?>;
        }
    </style>
    <?php   
    
    $width = '';
    if ( get_theme_mod('perfetta_bottom_column', '2') == '1') { $width = '100%'; }
    elseif ( get_theme_mod('perfetta_bottom_column', '2') == '2') { $width = '50%'; }
    else { $width = '33%'; }
	 ?>
    <style type="text/css">
        #gk-top .widget,
        #gk-footer .widget { width: <?php echo $width ?>; }
    </style> 
    <?php 
}

add_action( 'wp_head', 'perfetta_customizer_css' );

function perfetta_customize_register($wp_customize) {
	if ( $wp_customize->is_preview() && ! is_admin() ) {
		add_action( 'wp_footer', 'perfetta_customize_preview', 21);
    }
}

add_action( 'customize_register', 'perfetta_customize_register' );

function perfetta_customize_preview() {
    ?>
    <script>
    (function($){
    	wp.customize('perfetta_primary_color', function(value) {
    	    value.bind( function( to ) {
    	    	to = to ? to : '#e83a34';
    	    	// set colors:
    	    	var new_css = 'a, blockquote:before, button, input[type="submit"], input[type="button"], input[type="reset"], .nav-menu .current_page_item > a, .nav-menu .current_page_ancestor > a, .nav-menu .current-menu-item > a, .nav-menu .current-menu-ancestor > a, .entry-title.sticky span:before, .entry-title a:hover, .entry-summary .readon, .author-description .author-title, .comment-author .fn, .comment-author .url, .comment-reply-link, .comment-reply-login, .social-menu li:active, .social-menu li:focus, .social-menu li:hover, #gk-copyrights a, .nav-menu > li > a:active, .nav-menu > li > a:focus, .nav-menu > li > a:hover { color: '+to+'; } button, input[type="submit"], input[type="button"], input[type="reset"], .entry-summary .readon { border: 1px solid '+to+'; } ul.nav-menu ul a:hover, .nav-menu ul ul a:hover, #content > article > aside > time, .paging-navigation .nav-links, .paging-navigation a:active, .paging-navigation a:focus, .paging-navigation a:hover { background-color: '+to+'; } #content > article >aside:after { border-left: 8px solid '+to+'; }';
    	    	
    	    	if($(document).find('#perfetta-new-css-1').length) {
    	    		$(document).find('#perfetta-new-css-1').remove();
    	    	}
    	    	
    	    	$(document).find('head').append($('<style id="perfetta-new-css-1">' + new_css + '</style>'));
    	    });
    	});
    	
    	wp.customize('perfetta_footer_color', function(value) {
    	    value.bind( function( to ) {
    	    	to = to ? to : '#fff'
    	    	// set colors:
    	    	var new_css = '#gk-copyrights, .social-menu li, .social-menu li > a { color: '+to+'; }';
    	    	
    	    	if($(document).find('#perfetta-new-css-2').length) {
    	    		$(document).find('#perfetta-new-css-2').remove();
    	    	}
    	    	
    	    	$(document).find('head').append($('<style id="perfetta-new-css-2">' + new_css + '</style>'));
    	    });
    	});
    })(jQuery);
    </script>
    <?php
}

// EOF
