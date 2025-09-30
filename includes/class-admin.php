<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class WooCommerce_Treatment_Options_Admin {

    public function __construct() {
        add_action( 'woocommerce_product_options_general_product_data', array( $this, 'add_treatment_options_field' ) );
        add_action( 'woocommerce_process_product_meta', array( $this, 'save_treatment_options_field' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
    }

    public function add_treatment_options_field() {
        global $post;
        
        $options = Treatment_Options_Helper::get_all_options();
        $selected_options = get_post_meta( $post->ID, '_treatment_options', true );
        $selected_options = is_array( $selected_options ) ? $selected_options : array();

        echo '<div class="options_group treatment-options-group">';
        echo '<p class="form-field treatment-options-field">';
        echo '<label for="treatment_options">' . __( 'Treatment Options', 'woocommerce-treatment-options' ) . '</label>';
        echo '<div class="treatment-options-wrapper">';
        
        foreach ( $options as $key => $option_data ) {
            printf(
                '<label class="treatment-option-label"><input type="checkbox" name="_treatment_options[]" value="%s" %s /> <img src="%s" alt="" class="treatment-option-icon" style="width:20px;height:20px;vertical-align:middle;margin-right:5px;margin-left:10px;" /> <span>%s</span></label>',
                esc_attr( $key ),
                checked( in_array( $key, $selected_options ), true, false ),
                esc_url( $option_data['icon_url'] ),
                esc_html( $option_data['label'] )
            );
        }
        
        echo '</div>';
        echo '</p>';
        echo '</div>';
    }

    public function save_treatment_options_field( $post_id ) {
        if ( ! current_user_can( 'edit_product', $post_id ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        $treatment_options = isset( $_POST['_treatment_options'] ) ? array_map( 'sanitize_text_field', $_POST['_treatment_options'] ) : array();
        
        // Validate that all selected options exist
        $valid_options = array_keys( Treatment_Options_Helper::get_all_options() );
        $treatment_options = array_intersect( $treatment_options, $valid_options );
        
        update_post_meta( $post_id, '_treatment_options', $treatment_options );
    }

    public function enqueue_admin_scripts( $hook ) {
        global $post_type;
        
        if ( 'product' === $post_type && ( 'post.php' === $hook || 'post-new.php' === $hook ) ) {
            
            wp_enqueue_style( 
                'treatment-options-admin', 
                plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/admin.css', 
                array(), 
                '1.0.0' 
            );
        }
    }
}
?>