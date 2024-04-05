<?php 

namespace Service_Management\Classes\Helpers;
class DB_Init 
{

    public $file;
    
    /**
     * __construct
     *
     * @param  mixed $file
     * @return void
     */
    public function __construct( $file ) {
        
        $this->file = $file;

    }
    
    /**
     * init
     *
     * @return void
     */
    public function init() 
    {

        register_activation_hook( $this->file, array( $this, 'activate_custom_settings_table' ) );
        register_activation_hook( $this->file, array( $this, 'service_management_quotes_global_predefined_tasks' ) );
        register_activation_hook( $this->file, array( $this, 'service_management_quotes_local_predefined_tasks'));
        register_activation_hook( $this->file, array( $this, 'add_default_settings_data' ) );
        register_activation_hook( $this->file, array( $this, 'service_management_clients_table' ) );
        register_activation_hook( $this->file, array( $this, 'service_management_quotes' ) );
        register_activation_hook( $this->file, array( $this, 'service_management_invoices' ) );
        register_activation_hook( $this->file, array( $this, 'create_plugin_folders' ) );

    }
        
    /**
     * activate_custom_settings_table
     *
     * @return void
     */
    public function activate_custom_settings_table() 
    {

        global $wpdb;
        $table_name = $wpdb->prefix ."service_management_settings";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            ID varchar(1) NOT NULL,
            company_name varchar(150) NOT NULL,
            company_contact_name varchar(150) NOT NULL,
            company_tel_no varchar(25) NOT NULL,
            company_address varchar(500) NOT NULL,
            company_website varchar(150) NOT NULL,
            company_email varchar(150) NOT NULL,
            company_billing_details varchar(750) NOT NULL,
            company_logo_url varchar(750) NOT NULL,
            company_logo_filename varchar(750) NOT NULL,
            updated_at varchar(250) NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * add_default_settings_data
     *
     * @return void
     */
    public function add_default_settings_data()
    {

        global $wpdb;
        $table_name = $wpdb->prefix . "service_management_settings";
        $wpdb->insert(
            $table_name,
            array(
                'ID' => '1',
            )
        );

    }
    
    /**
     * service_management_clients_table
     *
     * @return void
     */
    public function service_management_clients_table()
    {

        global $wpdb;
        $table_name = $wpdb->prefix . "service_management_clients";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            ID int(11) NOT NULL AUTO_INCREMENT,
            client_company_name varchar(750) NOT NULL,
            client_first_name varchar(50) NOT NULL,
            client_last_name varchar(50) NOT NULL,
            client_tel_no varchar(50) NOT NULL,
            client_website_link varchar(250) NOT NULL,
            client_email varchar(50) NOT NULL,
            client_address varchar(750) NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * service_management_quotes_global_predefined_tasks
     *
     * @return void
     */
    public function service_management_quotes_global_predefined_tasks()
    {

        global $wpdb;
        $table_name = $wpdb->prefix . "service_management_quotes_global_predefined_tasks";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            ID int(11) NOT NULL AUTO_INCREMENT,
            quote_id varchar(50) NOT NULL,
            task_description varchar(50) NOT NULL,
            task_amount varchar(50) NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * service_management_quotes_local_predefined_tasks
     *
     * @return void
     */
    public function service_management_quotes_local_predefined_tasks()
    {

        global $wpdb;
        $table_name = $wpdb->prefix . "service_management_quotes_local_predefined_tasks";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            ID int(11) NOT NULL AUTO_INCREMENT,
            quote_id varchar(50) NOT NULL,
            edited varchar(10) NOT NULL,
            task_description varchar(50) NOT NULL,
            task_amount varchar(50) NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * service_management_quotes
     *
     * @return void
     */
    public function service_management_quotes()
    {

        global $wpdb;
        $table_name = $wpdb->prefix . "service_management_quotes";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            ID int(11) NOT NULL,
            client_id int(50) NOT NULL,
            client_company_name varchar(750) NOT NULL,
            client_quote_fname varchar(150) NOT NULL,
            client_quote_lname varchar(150) NOT NULL,
            predefined_tasks varchar(5000) NOT NULL,
            quote_total varchar(50) NOT NULL,
            budget varchar(50) NOT NULL,
            quote_accepted varchar(10) NOT NULL,
            date_added varchar(50) NOT NULL,
            currency varchar(10) NOT NULL,
            invoice_1 int(50) NOT NULL,
            invoice_2 int(50) NOT NULL,
            invoice_3 int(50) NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * service_management_invoices
     *
     * @return void
     */
    public function service_management_invoices()
    {

        global $wpdb;
        $table_name = $wpdb->prefix . "service_management_invoices";
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            ID int(11) NOT NULL,
            client_id int(50) NOT NULL,
            quote_id int(50) NOT NULL,
            currency varchar (10) NOT NULL,
            client_company_name varchar(750) NOT NULL,
            client_quote_fname varchar(150) NOT NULL,
            client_quote_lname varchar(150) NOT NULL,
            predefined_tasks varchar(5000) NOT NULL,
            invoice_total varchar(50) NOT NULL,
            invoice_paid varchar(50) NOT NULL,
            date_paid varchar(50) NOT NULL,
            budget varchar(50) NOT NULL,
            PRIMARY KEY (ID)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function create_plugin_folders()
    {
        $path = $_SERVER['DOCUMENT_ROOT'];
        $logo_upload_path = $path . '/wp-content/uploads/service_management/';

        if (is_dir($logo_upload_path)) {
            echo '';
        } else {
            mkdir($logo_upload_path, 0755, true);
        }
    }
}

