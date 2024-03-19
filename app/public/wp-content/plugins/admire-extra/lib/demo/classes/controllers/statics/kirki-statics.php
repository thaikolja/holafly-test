<?php
// Demos url
            $url = esc_url('https://admiretheme.com/demos/');
			$theme = wp_get_theme();
			if ( 'admire' !== $theme->template ) {
			$data = array(
			
			'sktadmiredefault-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'sktadmiredefault-demo/sample-data.xml',
                    'theme_settings' => $url . 'sktadmiredefault-demo/sktadmire-export.json',
                    'widgets_file' => $url . 'sktadmiredefault-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'sktadmiredefaultgb-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'sktadmiredefaultgb-demo/sample-data.xml',
                    'theme_settings' => $url . 'sktadmiredefaultgb-demo/sktadmire-export.json',
                    'widgets_file' => $url . 'sktadmiredefaultgb-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),
													
                        ),
                    'recommended' => array(),
                    ),
                ),

                'extreme-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'extreme-demo/sample-data.xml',
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1170',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                        ),
                    'recommended' => array(),
                    ),
                ),
				'specialist-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'specialist-demo/sample-data.xml',
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1170',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                        ),
                    'recommended' => array(),
                    ),
                ),
				'woman-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'woman-demo/sample-data.xml',
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1170',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                        ),
                    'recommended' => array(),
                    ),
                ),
				'taxi-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'taxi-demo/sample-data.xml',
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1170',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                        ),
                    'recommended' => array(),
                    ),
                ),
				'weddingcards-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'weddingcards-demo/sample-data.xml',
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1170',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                        ),
                    'recommended' => array(),
                    ),
                ),
            );	
			}else{	
			$data = array(
				'default-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'default-demo/sample-data.xml',
                    'theme_settings' => $url . 'default-demo/admire-export.json',
                    'widgets_file' => $url . 'default-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'defaultgb-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'defaultgb-demo/sample-data.xml',
                    'theme_settings' => $url . 'defaultgb-demo/admiregb-export.json',
                    'widgets_file' => $url . 'defaultgb-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'solarenergy-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'solarenergy-demo/sample-data.xml',
                    'theme_settings' => $url . 'solarenergy-demo/solarenergy-export.json',
                    'widgets_file' => $url . 'solarenergy-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'golf-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'golf-demo/sample-data.xml',
                    'theme_settings' => $url . 'golf-demo/golf-export.json',
                    'widgets_file' => $url . 'golf-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'holi-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'holi-demo/sample-data.xml',
                    'theme_settings' => $url . 'holi-demo/holi-export.json',
                    'widgets_file' => $url . 'holi-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'countdown-timer-for-elementor',
                                'init' => 'countdown-timer-for-elementor/countdown-timer-for-elementor.php',
                                'name' => 'Countdown Timer for Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'electrician-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'electrician-demo/sample-data.xml',
                    'theme_settings' => $url . 'electrician-demo/electrician-export.json',
                    'widgets_file' => $url . 'electrician-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'nature-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'nature-demo/sample-data.xml',
                    'theme_settings' => $url . 'nature-demo/nature-export.json',
                    'widgets_file' => $url . 'nature-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'architect-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'architect-demo/sample-data.xml',
                    'theme_settings' => $url . 'architect-demo/architect-export.json',
                    'widgets_file' => $url . 'architect-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'webdesigner-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'webdesigner-demo/sample-data.xml',
                    'theme_settings' => $url . 'webdesigner-demo/webdesigner-export.json',
                    'widgets_file' => $url . 'webdesigner-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'interior-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'interior-demo/sample-data.xml',
                    'theme_settings' => $url . 'interior-demo/interior-export.json',
                    'widgets_file' => $url . 'interior-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'tshirt-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'tshirt-demo/sample-data.xml',
                    'theme_settings' => $url . 'tshirt-demo/tshirt-export.json',
                    'widgets_file' => $url . 'tshirt-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'salon-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'salon-demo/sample-data.xml',
                    'theme_settings' => $url . 'salon-demo/salon-export.json',
                    'widgets_file' => $url . 'salon-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'ayurveda-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'ayurveda-demo/sample-data.xml',
                    'theme_settings' => $url . 'ayurveda-demo/ayurveda-export.json',
                    'widgets_file' => $url . 'ayurveda-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'responsive-youtube-vimeo-popup',
                                'init' => 'responsive-youtube-vimeo-popup/responsive-youtube-vimeo-popup.php',
                                'name' => 'WP Video Popup',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            )								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'podcast-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'podcast-demo/sample-data.xml',
                    'theme_settings' => $url . 'podcast-demo/podcast-export.json',
                    'widgets_file' => $url . 'podcast-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            )								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'senator-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'senator-demo/sample-data.xml',
                    'theme_settings' => $url . 'senator-demo/senator-export.json',
                    'widgets_file' => $url . 'senator-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'shoes-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'shoes-demo/sample-data.xml',
                    'theme_settings' => $url . 'shoes-demo/shoes-export.json',
                    'widgets_file' => $url . 'shoes-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'skincare-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'skincare-demo/sample-data.xml',
                    'theme_settings' => $url . 'skincare-demo/skincare-export.json',
                    'widgets_file' => $url . 'skincare-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'responsive-youtube-vimeo-popup',
                                'init' => 'responsive-youtube-vimeo-popup/responsive-youtube-vimeo-popup.php',
                                'name' => 'WP Video Popup',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            )								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'insurance-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'insurance-demo/sample-data.xml',
                    'theme_settings' => $url . 'insurance-demo/insurance-export.json',
                    'widgets_file' => $url . 'insurance-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            )								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'sandwich-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'sandwich-demo/sample-data.xml',
                    'theme_settings' => $url . 'sandwich-demo/sandwich-export.json',
                    'widgets_file' => $url . 'sandwich-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            )								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'plants-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'plants-demo/sample-data.xml',
                    'theme_settings' => $url . 'plants-demo/plants-export.json',
                    'widgets_file' => $url . 'plants-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'christmas-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'christmas-demo/sample-data.xml',
                    'theme_settings' => $url . 'christmas-demo/christmas-export.json',
                    'widgets_file' => $url . 'christmas-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'countdown-timer-for-elementor',
                                'init' => 'countdown-timer-for-elementor/countdown-timer-for-elementor.php',
                                'name' => 'Countdown Timer for Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'wp-snow-effect',
                                'init' => 'wp-snow-effect/wp-snow-effect.php',
                                'name' => 'WP Snow Effect',
                            ),		
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'doctor-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'doctor-demo/sample-data.xml',
                    'theme_settings' => $url . 'doctor-demo/doctor-export.json',
                    'widgets_file' => $url . 'doctor-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'responsive-youtube-vimeo-popup',
                                'init' => 'responsive-youtube-vimeo-popup/responsive-youtube-vimeo-popup.php',
                                'name' => 'WP Video Popup',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'coachpress-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'coachpress-demo/sample-data.xml',
                    'theme_settings' => $url . 'coachpress-demo/coachpress-export.json',
                    'widgets_file' => $url . 'coachpress-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'shopping-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'shopping-demo/sample-data.xml',
                    'theme_settings' => $url . 'shopping-demo/shopping-export.json',
                    'widgets_file' => $url . 'shopping-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'widget-countdown',
                                'init' => 'widget-countdown/wpdevart-countdown.php',
                                'name' => 'Countdown Timer – Widget Countdown',
                            ),		
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'consulting-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'consulting-demo/sample-data.xml',
                    'theme_settings' => $url . 'consulting-demo/consulting-export.json',
                    'widgets_file' => $url . 'consulting-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'responsive-youtube-vimeo-popup',
                                'init' => 'responsive-youtube-vimeo-popup/responsive-youtube-vimeo-popup.php',
                                'name' => 'WP Video Popup',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'infotech-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'infotech-demo/sample-data.xml',
                    'theme_settings' => $url . 'infotech-demo/infotech-export.json',
                    'widgets_file' => $url . 'infotech-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
 				'itcompany-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'itcompany-demo/sample-data.xml',
                    'theme_settings' => $url . 'itcompany-demo/itcompany-export.json',
                    'widgets_file' => $url . 'itcompany-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'renovation-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'renovation-demo/sample-data.xml',
                    'theme_settings' => $url . 'renovation-demo/renovation-export.json',
                    'widgets_file' => $url . 'renovation-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'construction-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'construction-demo/sample-data.xml',
                    'theme_settings' => $url . 'construction-demo/construction-export.json',
                    'widgets_file' => $url . 'construction-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'hotel-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'hotel-demo/sample-data.xml',
                    'theme_settings' => $url . 'hotel-demo/hotel-export.json',
                    'widgets_file' => $url . 'hotel-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'fitness-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'fitness-demo/sample-data.xml',
                    'theme_settings' => $url . 'fitness-demo/fitness-export.json',
                    'widgets_file' => $url . 'fitness-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'charity-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'charity-demo/sample-data.xml',
                    'theme_settings' => $url . 'charity-demo/charity-export.json',
                    'widgets_file' => $url . 'charity-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'naturegb-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'naturegb-demo/sample-data.xml',
                    'theme_settings' => $url . 'naturegb-demo/naturegb-export.json',
                    'widgets_file' => $url . 'naturegb-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'extremegb-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'extremegb-demo/sample-data.xml',
                    'theme_settings' => $url . 'extremegb-demo/extremegb-export.json',
                    'widgets_file' => $url . 'extremegb-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),                            								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'taoism-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'taoism-demo/sample-data.xml',
                    'theme_settings' => $url . 'taoism-demo/taoism-export.json',
                    'widgets_file' => $url . 'taoism-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'immigration-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'immigration-demo/sample-data.xml',
                    'theme_settings' => $url . 'immigration-demo/immigration-export.json',
                    'widgets_file' => $url . 'immigration-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'accounting-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'accounting-demo/sample-data.xml',
                    'theme_settings' => $url . 'accounting-demo/accounting-export.json',
                    'widgets_file' => $url . 'accounting-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'specialistadm-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'specialistadm-demo/sample-data.xml',
                    'theme_settings' => $url . 'specialistadm-demo/specialistadm-export.json',
                    'widgets_file' => $url . 'specialistadm-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'womanadm-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'womanadm-demo/sample-data.xml',
                    'theme_settings' => $url . 'womanadm-demo/womanadm-export.json',
                    'widgets_file' => $url . 'womanadm-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'taxiadm-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'taxiadm-demo/sample-data.xml',
                    'theme_settings' => $url . 'taxiadm-demo/taxiadm-export.json',
                    'widgets_file' => $url . 'taxiadm-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'waterpurifier-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'waterpurifier-demo/sample-data.xml',
                    'theme_settings' => $url . 'waterpurifier-demo/waterpurifier-export.json',
                    'widgets_file' => $url . 'waterpurifier-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'sushi-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'sushi-demo/sample-data.xml',
                    'theme_settings' => $url . 'sushi-demo/sushi-export.json',
                    'widgets_file' => $url . 'sushi-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'sportshoes-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'sportshoes-demo/sample-data.xml',
                    'theme_settings' => $url . 'sportshoes-demo/sportshoes-export.json',
                    'widgets_file' => $url . 'sportshoes-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'spa-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'spa-demo/sample-data.xml',
                    'theme_settings' => $url . 'spa-demo/spa-export.json',
                    'widgets_file' => $url . 'spa-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'solarenergy-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'solarenergy-demo/sample-data.xml',
                    'theme_settings' => $url . 'solarenergy-demo/solarenergy-export.json',
                    'widgets_file' => $url . 'solarenergy-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'skincare-demo' => array(
                    'categories' => array('Gutenberg'),
                    'xml_file' => $url . 'skincare-demo/sample-data.xml',
                    'theme_settings' => $url . 'skincare-demo/skincare-export.json',
                    'widgets_file' => $url . 'skincare-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'skt-blocks',
                                'init' => 'skt-blocks/skt-blocks.php',
                                'name' => 'SKT Blocks',
                            ),
                            array(
                                'slug' => 'responsive-youtube-vimeo-popup',
                                'init' => 'responsive-youtube-vimeo-popup/responsive-youtube-vimeo-popup.php',
                                'name' => 'WP Video Popup',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            )								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'resort-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'resort-demo/sample-data.xml',
                    'theme_settings' => $url . 'resort-demo/resort-export.json',
                    'widgets_file' => $url . 'resort-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'parking-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'parking-demo/sample-data.xml',
                    'theme_settings' => $url . 'parking-demo/parking-export.json',
                    'widgets_file' => $url . 'parking-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                        ),
                    'recommended' => array(),
                    ),
                ),
				'palmhealing-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'palmhealing-demo/sample-data.xml',
                    'theme_settings' => $url . 'palmhealing-demo/palmhealing-export.json',
                    'widgets_file' => $url . 'palmhealing-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'geyser-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'geyser-demo/sample-data.xml',
                    'theme_settings' => $url . 'geyser-demo/geyser-export.json',
                    'widgets_file' => $url . 'geyser-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'fruits-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'fruits-demo/sample-data.xml',
                    'theme_settings' => $url . 'fruits-demo/fruits-export.json',
                    'widgets_file' => $url . 'fruits-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'ecology-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'ecology-demo/sample-data.xml',
                    'theme_settings' => $url . 'ecology-demo/ecology-export.json',
                    'widgets_file' => $url . 'ecology-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								
                            array(
                                'slug' => 'woocommerce',
                                'init' => 'woocommerce/woocommerce.php',
                                'name' => 'WooCommerce',
                            ),								
													
                        ),
                    'recommended' => array(),
                    ),
                ),
				'eauto-demo' => array(
                    'categories' => array('Elementor'),
                    'xml_file' => $url . 'eauto-demo/sample-data.xml',
                    'theme_settings' => $url . 'eauto-demo/eauto-export.json',
                    'widgets_file' => $url . 'eauto-demo/widgets.wie',					
                    'home_title' => 'Home',
                    'blog_title' => 'Blog',
                    'posts_to_show' => '6',
                    'elementor_width' => '1200',
					'is_shop' => true,
                    'required_plugins' => array(
                        'free' => array(
                            array(
                                'slug' => 'admire-extra',
                                'init' => 'admire-extra/admire-extra.php',
                                'name' => 'Admire Extra',
                            ),
                            array(
                                'slug' => 'elementor',
                                'init' => 'elementor/elementor.php',
                                'name' => 'Elementor',
                            ),
                            array(
                                'slug' => 'contact-form-7',
                                'init' => 'contact-form-7/wp-contact-form-7.php',
                                'name' => 'Contact Form 7',
                            ),								

                        ),
                    'recommended' => array(),
                    ),
                ),
				
            );			            
			}	
?>