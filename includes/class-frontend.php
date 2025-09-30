<?php
class Frontend {
    public function __construct() {
        //just in case we want to display treatment options on single product page
        // add_action('woocommerce_single_product_summary', array($this, 'display_treatment_options'), 25);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
    }

    public function display_treatment_options() {
        global $product;

        $treatment_options = get_post_meta($product->get_id(), '_treatment_options', true);

        if (!empty($treatment_options)) {
            echo '<ul class="treatment-options">';
            foreach ($treatment_options as $option) {
            $option = Treatment_Options_Helper::get_option($option);
            echo '<li class="treatment-option">';
            echo '<img src="' . esc_url($option['icon_url']) . '" alt="' . esc_attr($option['label']) . '" />';
            echo '<span>' . esc_html($option['label']) . '</span>';
            echo '</li>';
            }
            echo '</ul>';
        }
    }
    public function enqueue_frontend_scripts() {
        wp_enqueue_style('wto-frontend-css', WTO_PLUGIN_URL . 'assets/css/frontend.css');
    }
}
?>