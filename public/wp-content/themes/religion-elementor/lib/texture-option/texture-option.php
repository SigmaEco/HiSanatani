<?php
include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
class religion_elementor_theme_option{
function __construct(){
add_action( 'admin_enqueue_scripts', array($this,'admin_scripts'));
add_action('admin_menu', array($this,'menu_tab'));

    // AJAX.
    add_action( 'wp_ajax_th_activeplugin',array($this,'th_activeplugin') );
    add_action( 'wp_ajax_default_home',array($this, 'default_home') );
}
function menu_tab() {
    $menu_title = esc_html__('Religion Elementor Options', 'religion-elementor');
    add_theme_page( esc_html__( 'Religion Elementor', 'religion-elementor' ), $menu_title, 'edit_theme_options', 'texture_started',array($this,'tab_page'));

}


/**
* Enqueue scripts for admin page only: Theme info page
*/
function admin_scripts( $hook ) {
if ($hook === 'appearance_page_texture_started'  ) {
wp_enqueue_style( 'religion-elementor-started-css', get_template_directory_uri() . '/lib/texture-option/assets/css/started.css' );
wp_enqueue_script( 'religion-elementor-admin-load', get_template_directory_uri() . '/lib/texture-option/assets/js/texture-options.js', array('jquery', 'updates' ), true );

$data = apply_filters(
                    'th_option_localize_vars',
                    array(
                        'oneClickDemo' =>esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import' )),

                        )
                );
    wp_localize_script( 'religion-elementor-admin-load', 'THAdmin', $data); 


} else {

    wp_enqueue_style( 'religion-elementor-notify-css', get_template_directory_uri() . '/lib/religion-elementor-option/assets/css/notify.css' );  

}
}
function tab_constant(){
    $themedata = wp_get_theme();
    $tab_array = array();
    $tab_array['header'] = array('theme_brand' => __('wptexture','religion-elementor'),
    'theme_brand_url' => esc_url($themedata->get( 'AuthorURI' )),
    'welcome'=>sprintf(esc_html__('Welcome To %1s Theme', 'religion-elementor'), esc_html($themedata->get( 'Name' ),'religion-elementor'), $themedata->get( 'Version' ) ),
    'welcome_desc' => esc_html($themedata->get( 'Name' ).' is an eCommerce WordPress theme specially made for shopping websites.', 'religion-elementor' ),
    'v'=> 'Version '.$themedata->get( 'Version' )
    );
    return $tab_array;
}


function tab_page() {
    $text_array = $this->tab_constant();
    $theme_header =$text_array['header'];
    include('tab-html.php' ); 
}


// Home Page Setup

function default_home() {
$pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'frontpage.php'
));
  $post_id = isset($pages[0]->ID)?$pages[0]->ID:false;
if(empty($pages)){
      $post_id = wp_insert_post(array (
       'post_type' => 'page',
       'post_title' => __('Home Page','religion-elementor'),
       'post_content' => '',
       'post_status' => 'publish',
       'comment_status' => 'closed',   // if you prefer
       'ping_status' => 'closed',      // if you prefer
       'page_template' =>'frontpage.php', //Sets the template for the page.
    ));
  }
      if($post_id){
        update_option( 'page_on_front', $post_id );
        update_option( 'show_on_front', 'page' );
    }
    wp_die(); // this is required to terminate immediately and return a proper response
}


function _check_homepage_setup(){

    $fid =  get_option( 'page_on_front');

    $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'frontpage.php'
));
   $post_id = isset($pages[0]->ID)?$pages[0]->ID:false;


  return ($fid == $post_id)?true:false;
}
     /*
          * Plugin install
          * Active plugin
          * Setup Homepage
          */
        public function th_activeplugin(){
      if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) {
        wp_send_json_error(
          array(
            'success' => false,
            'message' => __( 'No plugin specified', 'religion-elementor' ),
          )
        );
      }

      $plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : '';

      $activate = activate_plugin( $plugin_init);

      if ( is_wp_error( $activate ) ) {
        wp_send_json_error(
          array(
            'success' => false,
            'message' => $activate->get_error_message(),
          )
        );
      }

      wp_send_json_success(
        array(
          'success' => true,
          'message' => __( 'Plugin Successfully Activated', 'religion-elementor' ),
        )
      );

        }
        


function plugin_install_button($plugin){
            $button = '<div class="rcp theme_link th-row">';
            $button .= ' <div class="th-column"><img src="'.esc_url( $plugin['thumb'] ).'" /> </div>';
            $button .= '<div class="th-column">';

            $button .= '<div class="title-plugin">
            <h4>'.esc_html( $plugin['plugin_name'] ). ' </h4><a class="plugin-detail thickbox open-plugin-details-modal" href="'.esc_url( $plugin['detail_link'] ).'">'.esc_html__( 'Details & Version', 'religion-elementor' ).'</a>
            </div>';
             $button .='<button data-activated="Activated" data-msg="Activating" data-init="'.esc_attr($plugin['plugin_init']).'" data-slug="'.esc_attr( $plugin['slug'] ).'" class="button '.esc_attr( $plugin['button_class'] ).'">'.esc_html($plugin['button_txt']).'</button>';
            $button .= '</div></div>';

            echo $button;
}

/**
 * Include Welcome page content
 */
 public  function plugin_install($rplugins = 'recommend-plugins'){
       $recommend_plugins = get_theme_support( $rplugins );
       if ( is_array( $recommend_plugins ) && isset( $recommend_plugins[0] ) ){
        $pluginArr =array();
        foreach($recommend_plugins[0] as $slug=>$plugin){

            $plugin_init = $plugin['active_filename'];
            $status = is_dir( WP_PLUGIN_DIR . '/' . $slug );

            $button_class = 'install-now button '.$slug;

             if ( is_plugin_active( $plugin_init ) ) {
                   $button_class = 'button disabled '.$slug;
                   $button_txt = esc_html__( 'Activated', 'religion-elementor' );
                   $detail_link = $install_url = '';
                }

            if ( ! is_plugin_active( $plugin_init ) ){
                    $button_txt = esc_html__( 'Install Now', 'religion-elementor' );
                    if ( ! $status ) {
                        $install_url = wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'install-plugin',
                                    'plugin' => $slug
                                ),
                                network_admin_url( 'update.php' )
                            ),
                            'install-plugin_'.$slug
                        );

                    } else {
                        $install_url = add_query_arg(array(
                            'action' => 'activate',
                            'plugin' => rawurlencode( $plugin_init ),
                            'plugin_status' => 'all',
                            'paged' => '1',
                            '_wpnonce' => wp_create_nonce('activate-plugin_' . $plugin_init ),
                        ), network_admin_url('plugins.php'));
                        $button_class = 'activate-now button-primary '.$slug;
                        $button_txt = esc_html__( 'Activate Now', 'religion-elementor' );
                    }
                }
                $detail_link = add_query_arg(
                        array(
                            'tab' => 'plugin-information',
                            'plugin' => $slug,
                            'TB_iframe' => 'true',
                            'width' => '772',
                            'height' => '500',
                        ),
                        network_admin_url( 'plugin-install.php' )
                    );

                    $pluginArr['plugin_name'] =  $plugin['name'];
                    $pluginArr['slug']= $slug;
                    $pluginArr['thumb']= "https://ps.w.org/". $slug."/assets/".$plugin['img'];
                    $pluginArr['plugin_init']= $plugin_init;
                    $pluginArr['detail_link']= $detail_link;
                    $pluginArr['button_txt']= $button_txt;
                    $pluginArr['button_class']= $button_class;

                   $this->plugin_install_button($pluginArr);
        }
    } // plugin check
}

    
} // class end
$boj = new religion_elementor_theme_option(); ?>