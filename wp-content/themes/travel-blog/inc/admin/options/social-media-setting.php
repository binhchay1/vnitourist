<?php
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Social Media Setting', 'travel-blog' ),
	'id'     => 'social-media',
	'icon'   => 'el el-group',
	'fields' => array(
		array(
			'id'    => 'facebook_url',
			'type'  => 'text',
			'title' => esc_html__( 'Facebook URL', 'travel-blog' ),
		),
		array(
			'id'    => 'twitter_url',
			'type'  => 'text',
			'title' => esc_html__( 'Twitter URL', 'travel-blog' ),
		),
		array(
			'id'    => 'instagram_url',
			'type'  => 'text',
			'title' => esc_html__( 'Instagram URL', 'travel-blog' ),
		),
		array(
			'id'    => 'pinterest_url',
			'type'  => 'text',
			'title' => esc_html__( 'Pinterest URL', 'travel-blog' ),
		),
		array(
			'id'    => 'bloglovin_url',
			'type'  => 'text',
			'title' => esc_html__( 'Bloglovin URL', 'travel-blog' ),
		),
		array(
			'id'    => 'google_url',
			'type'  => 'text',
			'title' => esc_html__( 'Google Plus URL', 'travel-blog' ),
		),
		array(
			'id'    => 'tumblr_url',
			'type'  => 'text',
			'title' => esc_html__( 'Tumblr URL', 'travel-blog' ),
		),
		array(
			'id'    => 'youtube_url',
			'type'  => 'text',
			'title' => esc_html__( 'Youtube URL', 'travel-blog' ),
		),
		array(
			'id'    => 'dribbble_url',
			'type'  => 'text',
			'title' => esc_html__( 'Dribbble URL', 'travel-blog' ),
		),
		array(
			'id'    => 'linkedin_url',
			'type'  => 'text',
			'title' => esc_html__( 'Linkedin URL', 'travel-blog' ),
		),
		array(
			'id'    => 'rss_url',
			'type'  => 'text',
			'title' => esc_html__( 'RSS Link', 'travel-blog' ),
		),
	)
) );