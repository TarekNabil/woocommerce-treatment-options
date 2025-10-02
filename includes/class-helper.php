<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Treatment_Options_Helper {

    /**
     * Get all available treatment options with their icons
     * @return array
     */
    public static function get_all_options() {
        /*
        40 degree machine wash
        30 degrees machine wash
        Hand wash
        Cool water
        Dry clean only
        Tumble dry low and remove while slightly damp
        Do not tumble dry
        Dry flat
        Iron at low temperature
        Iron on reverse side
        Warm iron or line dry
        Do not bleach
        Do not wring
         */
        return array(
            'machine_wash_60' => array(
            'label' => __( '60° Machine Wash', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/60-degrees-machine-wash-grey.svg'
            ),  
            'machine_wash_40' => array(
            'label' => __( '40° Machine Wash', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/40-degrees-machine-wash-grey.svg'
            ),
            'machine_wash_30' => array(
            'label' => __( '30° Machine Wash', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/30-degrees-machine-wash-grey.svg'
            ),
            'hand_wash' => array(
            'label' => __( 'Hand Wash', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Hand-wash-grey.svg'
            ),
            'cool_water' => array(
            'label' => __( 'Cool Water', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Cool-water-grey.svg'
            ),
            'dry_clean' => array(
            'label' => __( 'Dry Clean', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Dry-clean-grey.svg'
            ),
            'dry_clean_only' => array(
            'label' => __( 'Dry Clean Only', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Dry-clean-only-grey.svg'
            ),
            'tumble_dry_on_low_setting' => array(
            'label' => __( 'Tumble Dry on Low Setting', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Tumble-dry-on-low-setting-grey.svg'
            ),
            'tumble_dry_low' => array(
            'label' => __( 'Tumble Dry Low, Remove While Slightly Damp', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Tumbl-dry-on-low-setting-and-remove-while-slightly-damp2-grey.svg'
            ),
            'no_tumble_dry' => array(
            'label' => __( 'Do Not Tumble Dry', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Do-not-tumble-dry-grey.svg'
            ),
            'professional_dry_clean' => array(
            'label' => __( 'Professional Dry Clean any solvent except trichloroethylene', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Professional-dry-clean-any-solvent-except-trichloroethylene-grey.svg'
            ),
            'dry_flat' => array(
            'label' => __( 'Dry Flat', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Dry-flat-grey.svg'
            ),
            'iron_low' => array(
            'label' => __( 'Iron at Low Temperature', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Iron-at-low-temperature-grey.svg'
            ),
            'iron_medium' => array(
            'label' => __( 'Iron at Medium Temperature', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Iron-at-medium-temperature-grey.svg'
            ),
            'iron_reverse' => array(
            'label' => __( 'Iron on Reverse Side', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Iron-on-reverse-side-grey.svg'
            ),
            'iron_reverse' => array(
            'label' => __( 'Iron on Reverse Side', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Iron-on-reverse-side-grey.svg'
            ),
            'warm_iron_line_dry' => array(
            'label' => __( 'Warm Iron or Line Dry', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Warm-iron-or-line-dry-grey.svg'
            ),
            'no_bleach' => array(
            'label' => __( 'Do Not Bleach', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Do-not-bleach-grey.svg'
            ),
            'no_wring' => array(
            'label' => __( 'Do Not Wring', 'woocommerce-treatment-options' ),
            'icon_url' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/icons/Do-not-wring-grey.svg'
            ),

           
        );
    }

    /**
     * Get selected options for a product
     * @param int $product_id
     * @return array
     */
    public static function get_product_options( $product_id ) {
        $selected_options = get_post_meta( $product_id, '_treatment_options', true );
        $selected_options = is_array( $selected_options ) ? $selected_options : array();
        
        $all_options = self::get_all_options();
        $product_options = array();
        
        foreach ( $selected_options as $key ) {
            if ( isset( $all_options[ $key ] ) ) {
                $product_options[ $key ] = $all_options[ $key ];
            }
        }
        
        return $product_options;
    }

    /**
     * Get option data by key
     * @param string $key
     * @return array|null
     */
    public static function get_option( $key ) {
        $all_options = self::get_all_options();
        return isset( $all_options[ $key ] ) ? $all_options[ $key ] : null;
    }
}
?>