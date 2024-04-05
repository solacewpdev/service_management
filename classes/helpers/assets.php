<?php
namespace Service_Management\Classes\Helpers;

class Assets
{
    public $file;
        
    /**
     * __construct
     *
     * @param  mixed $file
     * @return void
     */
    public function __construct( $file )
    { 
        $this->file = $file;
    }
    
    /**
     * init
     *
     * @return void
     */
    public function init()  
    {
        add_action('admin_enqueue_scripts', array( $this, 'service_management_backend_styles') );
    }    
    /**
     * service_management_backend_styles
     *
     * @return void
     */
    public function service_management_backend_styles() 
    {
        wp_enqueue_style(' prefix-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css' );
        wp_enqueue_style(' admin-style', plugins_url('/service_management/assets/css/admin.css') );
        wp_enqueue_style(' admin-datatables', plugins_url('/service_management/assets/css/dataTables.bootstrap4.css') );
        wp_enqueue_style(' jquery-ui', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css' );
        wp_enqueue_style(' mdb', 'https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css' );
        wp_enqueue_style(' select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
        wp_enqueue_style(' datatables-css', 'https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css' );

        wp_enqueue_script( 'jquery-ui-js', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js', array('jquery'), '', true );
        wp_enqueue_script( 'mdb-js', 'https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js', array('jquery'), '', true );
        wp_enqueue_script( 'select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '', true );
        wp_enqueue_script( 'datatables-js', 'https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js', array('jquery'), '', true );
        wp_enqueue_script( 'bs-js', plugins_url('/service_management/assets/js/bootstrap.bundle.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'admin-script', plugins_url('/service_management/assets/js/admin-js.min.js') );
        wp_enqueue_script( 'jquery-easing', plugins_url('/service_management/assets/js/jquery.easing.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'backend_js', plugins_url('/service_management/assets/js/backend.js'), array('jquery'), '', true );
    }
}
