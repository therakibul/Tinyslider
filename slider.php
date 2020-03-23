<?php
/*
 * Plugin Name:       Slider
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       slider
 * Domain Path:       /languages
*/
    function shortcode_for_tslider($attributes, $content){
        $default = [
            "width" => "",
            "height" => "",
            "id" => ""
        ];
        $atts = shortcode_atts($default, $attributes);
        $content = do_shortcode($content);
        $shortcode_output = <<<EOD
            <div class="slider">
                {$content}
            </div>
EOD;
        return $shortcode_output;
    }

    add_shortcode("tslider", "shortcode_for_tslider");

    function shortcode_for_tslide($attributes){
        $default = [
            "caption" => "",
            "id" => ""
        ];
        $atts = shortcode_atts($default, $attributes);
        $image_src = wp_get_attachment_image_src($atts["id"], "large");
        $shortcode_output = <<<EOD
            <div>
                <p>
                    <img src="{$image_src[0]}">
                </p>
                <p>
                    {$atts["caption"]}
                </p>
            </div>
EOD;
        return $shortcode_output;
    }
    add_shortcode("tslide", "shortcode_for_tslide");

    function tiny_assets(){
        wp_enqueue_style("tiny-css", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css");
        wp_enqueue_script("tiny-js", "//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js", null, time(), true);
        wp_enqueue_script("slider-js", plugin_dir_url(__FILE__)."assets/js/slider.js", array("jquery"), time(), true);

    }
    add_action("wp_enqueue_scripts", "tiny_assets");
?>