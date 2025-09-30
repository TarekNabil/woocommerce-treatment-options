<?php
class Treatment_Options_Shortcode {
    public function __construct() {
        add_shortcode('treatment_options', [$this, 'render_treatment_options']);
    }

    public function render_treatment_options($atts) {
        global $product;

        if (!$product || !is_a($product, 'WC_Product')) {
            return '';
        }

        $treatment_options = get_post_meta($product->get_id(), '_treatment_options', true);

        if (empty($treatment_options)) {
            return '<p>No treatment options available.</p>';
        }
        $output = '<ul class="treatment-options">';
            foreach ($treatment_options as $option) {
                $option = Treatment_Options_Helper::get_option($option);
                $output .= '<li class="treatment-option">';
                $output .= '<img src="' . esc_url($option['icon_url']) . '" alt="' . esc_attr($option['label']) . '" />';
                $output .= '<span>' . esc_html($option['label']) . '</span>';
                $output .= '</li>';
            }
        $output .= '</ul>';

        

        return $output;
    }
}

new Treatment_Options_Shortcode();
?>