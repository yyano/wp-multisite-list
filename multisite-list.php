<?php

/*
  Plugin Name: Multisite List
  Plugin URI: 
  Description: List of Multisite blogs.
  Version: 1.0
  Author: YANO Yasuhiro
  Author URI: google.com/+YANOYasuhiro
  License: GPLv2
 */

/*
  Copyright (C) 2014 YANO Yasuhiro

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

class WP_Widget_MultiSiteList extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'Widget_MultiSiteList', 
			'description' => __( "List of Multisite blogs." )
		);
		parent::__construct( 'MultiSiteList', 
                        _x( 'Multisite List', 'Multisite List widget' ), 
                        $widget_ops );
	
		
	}

	function form( $instance ) {
            echo "no option.<br />";
	}

	function update( $new_instance, $old_instance ) {
		
	}
	
	function widget( $args, $instance ) {

            if( is_multisite() ){
                //Multisite
                $mySites = ( wp_get_sites( $args ) );
                echo '<ul>';
                foreach ( $mySites as $blog ) {
                    switch_to_blog( $blog['blog_id'] );
                    printf('%s<a href="%s">%s</a>%s'."\r\n", 
                            '<li>', home_url(), get_option('blogname'), '</li>');
                    restore_current_blog();
                }
                echo '</ul>';
            } else {
                //not Multisite
                printf('<a href="%s">%s</a>',
                            home_url(), get_option('blogname') );
            }
	}

}
//$mslWidget = new mslist_Widget;

function WP_Widget_MultiSiteListInit(){
	register_widget('WP_Widget_MultiSiteList');
}
add_action('widgets_init', 'WP_Widget_MultiSiteListInit');