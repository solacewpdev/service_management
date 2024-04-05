<?php 
namespace Service_Management\Classes;
/**
 * This file is a misc helper file for all the "loose" functionalities 
 * without proper categorization in the plugin.
 */

class Misc
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_plugin_menu'));

        // Register our plugin settings
        add_action('admin_init', array($this, 'register_plugin_settings'));

    }

    /**
     * add_plugin_menu
     *
     * @return void
     */
    public function add_plugin_menu()
    {
        // Add main menu page
        add_menu_page(
            'service-management',
            'Service Management',
            'manage_options',
            'service-management',
            array($this, 'main_dashboard_page'),
            'dashicons-money-alt', // Menu icon
            99                         // Menu position
        );

        // Add subpages
        add_submenu_page(
            'service-management',
            'Plugin Notices',
            'Plugin Notices',
            'manage_options',
            'sm-plugin-notices',
            array($this, 'render_plugin_notices_page')
        );

        // Add subpages
        add_submenu_page(
            'service-management',
            'Settings',
            'Settings',
            'manage_options',
            'sm-company-settings',
            array($this, 'render_company_settings_page')
        );

        add_submenu_page(
            'service-management',
            'Add_Clients',
            '- Add Clients',
            'manage_options',
            'sm-add-clients',
            array($this, 'render_add_clients_main_page')
        );

        add_submenu_page(
            'service-management',
            'Update Client',
            '- Update Client',
            'manage_options',
            'sm-update-client',
            array($this, 'render_update_client_main_page')
        );

        add_submenu_page(
            'service-management',
            'Manage Clients',
            'Manage Clients',
            'manage_options',
            'sm-manage-clients',
            array($this, 'render_manage_clients_main_page')
        );

        add_submenu_page(
            'service-management',
            'delete-client',
            '- Delete Client',
            'manage_options',
            'sm-delete-client',
            array($this, 'render_delete_client_main_page')
        );

        add_submenu_page(
            'service-management',
            'Process Predefined Tasks',
            'Process Predefined Tasks',
            'manage_options',
            'sm-process-predefined-tasks',
            array($this, 'render_process_predefined_tasks_main_page')
        );

        add_submenu_page(
            'service-management',
            'Update Predefined Task',
            '- Update Predefined Task',
            'manage_options',
            'sm-update-predefined-task',
            array($this, 'render_update_predefined_task_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Predefined Task',
            '- Delete Predefined Task',
            'manage_options',
            'sm-delete-predefined-task',
            array($this, 'render_delete_predefined_task_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Predefined Task',
            '- Create Predefined Task',
            'manage_options',
            'sm-create-predefined-task',
            array($this, 'render_create_predefined_task_main_page')
        );

        add_submenu_page(
            'service-management',
            'View Predefined Tasks',
            '- View Predefined Tasks',
            'manage_options',
            'sm-view-predefined-tasks',
            array($this, 'render_view_predefined_tasks_main_page')
        );

        add_submenu_page(
            'service-management',
            'Global Predefined Tasks',
            '- Global Predefined Tasks',
            'manage_options',
            'sm-global-predefined-tasks',
            array($this, 'render_global_predefined_tasks_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Quote Screen 1',
            '- Create Quote Screen 1',
            'manage_options',
            'sm-create-quote-screen1',
            array($this, 'render_create_quote_screen1_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Quote Screen2',
            '- Create Quote Screen2',
            'manage_options',
            'sm-create-quote-screen2',
            array($this, 'render_create_quote_screen2_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Quote Screen 3',
            '- Create Quote Screen 3',
            'manage_options',
            'sm-create-quote-screen3',
            array($this, 'render_create_quote_screen3_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Quote Screen 4',
            '- Create Quote Screen 4',
            'manage_options',
            'sm-create-quote-screen4',
            array($this, 'render_create_quote_screen4_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Quote Screen 5',
            '- Create Quote Screen 5',
            'manage_options',
            'sm-create-quote-screen5',
            array($this, 'render_create_quote_screen5_main_page')
        );

        add_submenu_page(
            'service-management',
            'Manage Quote',
            '- Manage Quote',
            'manage_options',
            'sm-manage-quote',
            array($this, 'render_manage_quote_main_page')
        );

        add_submenu_page(
            'service-management',
            'Edit Quote Screen1',
            '- Edit Quote Screen1',
            'manage_options',
            'sm-edit-quote-screen1',
            array($this, 'render_edit_quote_screen1_main_page')
        );

        add_submenu_page(
            'service-management',
            'Edit Quote Screen2',
            '- Edit Quote Screen2',
            'manage_options',
            'sm-edit-quote-screen2',
            array($this, 'render_edit_quote_screen2_main_page')
        );

        add_submenu_page(
            'service-management',
            'Edit Quote Screen3',
            '- Edit Quote Screen3',
            'manage_options',
            'sm-edit-quote-screen3',
            array($this, 'render_edit_quote_screen3_main_page')
        );

        add_submenu_page(
            'service-management',
            'Edit Quote Screen4',
            '- Edit Quote Screen4',
            'manage_options',
            'sm-edit-quote-screen4',
            array($this, 'render_edit_quote_screen4_main_page')
        );

        add_submenu_page(
            'service-management',
            'Edit Quote Screen5',
            '- Edit Quote Screen5',
            'manage_options',
            'sm-edit-quote-screen5',
            array($this, 'render_edit_quote_screen5_main_page')
        );

        add_submenu_page(
            'service-management',
            'Update Task Edit Quote Mode',
            '- Update Task Edit Quote Mode',
            'manage_options',
            'sm-update-task-edit-quote-mode',
            array($this, 'render_update_task_edit_quote_mode_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Task Edit Quote Mode',
            '- Delete Task Edit Quote Mode',
            'manage_options',
            'sm-delete-task-edit-quote-mode',
            array($this, 'render_delete_task_edit_quote_mode_main_page')
        );

        add_submenu_page(
            'service-management',
            'Update Global Task Edit Quote Mode',
            '- Update Global Task Edit Quote Mode',
            'manage_options',
            'sm-update-global-task-edit-quote-mode',
            array($this, 'render_update_global_task_edit_quote_mode_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Global Task Edit Quote Mode',
            '- Delete Global Task Edit Quote Mode',
            'manage_options',
            'sm-delete-global-task-edit-quote-mode',
            array($this, 'render_delete_global_task_edit_quote_mode_main_page')
        );

        add_submenu_page(
            'service-management',
            'Client Management Search Quotes',
            '- Client Management Search Quotes',
            'manage_options',
            'sm-cm-search-quotes',
            array($this, 'render_client_management_search_quotes_main_page')
        );

        add_submenu_page(
            'service-management',
            'Accepting Quotes Screen1',
            '- Accepting Quotes Screen1',
            'manage_options',
            'sm-accepting-quotes-screen1',
            array($this, 'render_accepting_quotes_screen1_main_page')
        );

        add_submenu_page(
            'service-management',
            'Accepting Quotes Screen1',
            '- Accepting Quotes Screen1',
            'manage_options',
            'sm-create-invoices-screen1',
            array($this, 'render_creating_invoices_screen1_main_page')
        );

        add_submenu_page(
            'service-management',
            'CM Search Invoices',
            '- CM Search Invoices',
            'manage_options',
            'sm-cm-search-invoices',
            array($this, 'render_client_management_search_invoices_main_page')
        );

        add_submenu_page(
            'service-management',
            'Download Quote',
            '- Download Quote',
            'manage_options',
            'sm-download-quote',
            array($this, 'render_download_quote_main_page')
        );

        add_submenu_page(
            'service-management',
            'Search Quotes',
            '- Search Quotes',
            'manage_options',
            'sm-search-quotes',
            array($this, 'render_search_quotes_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Quote',
            '- Delete Quote',
            'manage_options',
            'sm-delete-quote',
            array($this, 'render_delete_quote_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Quote Step 2',
            '- Delete Quote Step 2',
            'manage_options',
            'sm-delete-quote-step2',
            array($this, 'render_delete_quote_step2_main_page')
        );

        add_submenu_page(
            'service-management',
            'invoices Overview',
            'Invoices Overview',
            'manage_options',
            'sm-invoices',
            array($this, 'render_invoices_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Invoice',
            '- Create Invoice',
            'manage_options',
            'sm-create-invoice',
            array($this, 'render_create_invoice_main_page')
        );

        add_submenu_page(
            'service-management',
            'Create Invoice Step 2',
            '- Create Invoice Step 2',
            'manage_options',
            'sm-create-invoice-step2',
            array($this, 'render_create_invoice_step2_main_page')
        );

        add_submenu_page(
            'service-management',
            'Save Invoice',
            '- Save Invoice',
            'manage_options',
            'sm-save-invoice',
            array($this, 'render_save_invoice_main_page')
        );

        add_submenu_page(
            'service-management',
            'search-invoice',
            '- Search Invoice',
            'manage_options',
            'sm-search-invoice',
            array($this, 'render_search_invoice_main_page')
        );

        add_submenu_page(
            'service-management',
            'Download Invoice',
            '- Download Invoice',
            'manage_options',
            'sm-download-invoice',
            array($this, 'render_download_invoice_main_page')
        );

        add_submenu_page(
            'service-management',
            'statements',
            'Statements Overview',
            'manage_options',
            'sm-statements',
            array($this, 'render_statements_main_page')
        );

        add_submenu_page(
            'service-management',
            'create-statement',
            '- Create Statement',
            'manage_options',
            'sm-create-statement',
            array($this, 'render_create_statement_main_page')
        );

        add_submenu_page(
            'service-management',
            'search-statement',
            '- Search Statement',
            'manage_options',
            'sm-search-statement',
            array($this, 'render_search_statement_main_page')
        );

        add_submenu_page(
            'service-management',
            'Clients Management',
            'Clients Management',
            'manage_options',
            'sm-clients-management',
            array($this, 'render_clients_management_main_page')
        );

        add_submenu_page(
            'service-management',
            'Update Global Predefined Tasks',
            'Update Global Predefined Tasks',
            'manage_options',
            'sm-update-global-predefined-tasks',
            array($this, 'render_update_global_predefined_tasks_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Global Predefined Tasks',
            'Delete Global Predefined Tasks',
            'manage_options',
            'sm-delete-global-predefined-tasks',
            array($this, 'render_delete_global_predefined_tasks_main_page')
        );

        add_submenu_page(
            'service-management',
            'Manage Invoices',
            'Manage Invoices',
            'manage_options',
            'sm-manage-invoices',
            array($this, 'render_manage_invoices_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Invoices',
            'Delete Invoices',
            'manage_options',
            'sm-delete-invoices',
            array($this, 'render_delete_invoices_main_page')
        );

        add_submenu_page(
            'service-management',
            'Quote Creation Step 1A ',
            'Quote Creation Step 1A ',
            'manage_options',
            'sm-quote-creation-1a',
            array($this, 'render_quote_creation_1a_main_page')
        );

        add_submenu_page(
            'service-management',
            'Quote Creation Step 1B ',
            'Quote Creation Step 1B ',
            'manage_options',
            'sm-quote-creation-1b',
            array($this, 'render_quote_creation_1b_main_page')
        );

        add_submenu_page(
            'service-management',
            'Quote Creation Step 1C ',
            'Quote Creation Step 1C ',
            'manage_options',
            'sm-quote-creation-1c',
            array($this, 'render_quote_creation_1c_main_page')
        );

        add_submenu_page(
            'service-management',
            'Globals ',
            'Globals ',
            'manage_options',
            'sm-globals',
            array($this, 'render_globals_main_page')
        );

        add_submenu_page(
            'service-management',
            'Update Globals ',
            'Update Globals ',
            'manage_options',
            'sm-update-globals',
            array($this, 'render_update_globals_main_page')
        );

        add_submenu_page(
            'service-management',
            'Delete Globals ',
            'Delete Globals ',
            'manage_options',
            'sm-delete-globals',
            array($this, 'render_delete_globals_main_page')
        );

        add_submenu_page(
            'service-management',
            'Contact Developers ',
            'Contact Developers ',
            'manage_options',
            'sm-contact-developers',
            array($this, 'render_contact_developers_main_page')
        );

        add_submenu_page(
            'service-management',
            'Tutorial Add Clients ',
            'Tutorial Add Clients ',
            'manage_options',
            'sm-tute-add-clients',
            array($this, 'render_tute_add_clients_main_page')
        );

        add_submenu_page(
            'service-management',
            'Tutorial Manage Clients ',
            'Tutorial Manage Clients ',
            'manage_options',
            'sm-tute-manage-clients',
            array($this, 'render_tute_manage_clients_main_page')
        );

        add_submenu_page(
            'service-management',
            'Tutorial Quote Creation ',
            'Tutorial Quote Creation ',
            'manage_options',
            'sm-tute-quote-creation',
            array($this, 'render_tute_quote_creation_main_page')
        );

        add_submenu_page(
            'service-management',
            'Tutorial Search Quotes',
            'Tutorial Search Quotes',
            'manage_options',
            'sm-tute-search-quotes',
            array($this, 'render_tute_search_quotes_main_page')
        );

        add_submenu_page(
            'service-management',
            'Tutorial Create Invoice',
            'Tutorial Create Invoice',
            'manage_options',
            'sm-tute-create-invoices',
            array($this, 'render_tute_create_invoice_main_page')
        );

        add_submenu_page(
            'service-management',
            'Tutorial Search Invoice',
            'Tutorial Search Invoice',
            'manage_options',
            'sm-tute-search-invoices',
            array($this, 'render_tute_search_invoice_main_page')
        );

    }

    public function register_plugin_settings()
    {
        // Register your plugin settings here using the `register_setting` function
        // Example:
        // register_setting('my-plugin-settings-group', 'my_plugin_option');
    }

    /**
     * main_dashboard_page
     *
     * @return void
     */
    public function main_dashboard_page()
    {
        // Render your main plugin settings page here
        // Example:
        require plugin_dir_path(__DIR__) . 'classes/plugin_notices.php';
    }
    
    /**
     * render_plugin_notices_page
     *
     * @return void
     */
    public function render_plugin_notices_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/plugin_notices.php';
    }

    /**
     * render_company_settings_page
     *
     * @return void
     */
    public function render_company_settings_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/company-settings.php';
    }

    /**
     * render_add_clients_main_page
     *
     * @return void
     */
    public function render_add_clients_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/add_client.php';
    }

    /**
     * render_manage_clients_main_page
     *
     * @return void
     */
    public function render_manage_clients_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/manage_clients.php';
    }

    /**
     * render_update_client_main_page
     *
     * @return void
     */
    public function render_update_client_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/update_client.php';
    }

    /**
     * render_delete_client_main_page
     *
     * @return void
     */
    public function render_delete_client_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_client.php';
    }
    
    /**
     * render_process_predefined_tasks_main_page
     *
     * @return void
     */
    public function render_process_predefined_tasks_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/process_predefined_tasks.php';
    }
    
    /**
     * render_update_predefined_task_main_page
     *
     * @return void
     */
    public function render_update_predefined_task_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/update-predefined-task.php';
    }
    
    /**
     * render_delete_predefined_task_main_page
     *
     * @return void
     */
    public function render_delete_predefined_task_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_predefined_task.php';
    }
    
    /**
     * render_create_predefined_task_main_page
     *
     * @return void
     */
    public function render_create_predefined_task_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_predefined_task.php';
    }
    
    /**
     * render_view_predefined_tasks_main_page
     *
     * @return void
     */
    public function render_view_predefined_tasks_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/view_predefined_tasks.php';
    }
    
    /**
     * render_global_predefined_tasks_main_page
     *
     * @return void
     */
    public function render_global_predefined_tasks_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/global_predefined_tasks.php';
    }
    
    /**
     * render_create_quote_screen1_main_page
     *
     * @return void
     */
    public function render_create_quote_screen1_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_quote_screen1.php';
    }
    
    /**
     * render_create_quote_screen2_main_page
     *
     * @return void
     */
    public function render_create_quote_screen2_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_quote_screen2.php';
    }
    
    /**
     * render_create_quote_screen3_main_page
     *
     * @return void
     */
    public function render_create_quote_screen3_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_quote_screen3.php';
    }
    
    /**
     * render_create_quote_screen4_main_page
     *
     * @return void
     */
    public function render_create_quote_screen4_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_quote_screen4.php';
    }
    
    /**
     * render_create_quote_screen5_main_page
     *
     * @return void
     */
    public function render_create_quote_screen5_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_quote_screen5.php';
    }
    
    /**
     * render_manage_quote_main_page
     *
     * @return void
     */
    public function render_manage_quote_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/manage_quote.php';
    }
    
    /**
     * render_edit_quote_screen1_main_page
     *
     * @return void
     */
    public function render_edit_quote_screen1_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/edit_quote_screen1.php';
    }
    
    /**
     * render_edit_quote_screen2_main_page
     *
     * @return void
     */
    public function render_edit_quote_screen2_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/edit_quote_screen2.php';
    }
    
    /**
     * render_edit_quote_screen3_main_page
     *
     * @return void
     */
    public function render_edit_quote_screen3_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/edit_quote_screen3.php';
    }
    
    /**
     * render_edit_quote_screen4_main_page
     *
     * @return void
     */
    public function render_edit_quote_screen4_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/edit_quote_screen4.php';
    }
    
    /**
     * render_edit_quote_screen5_main_page
     *
     * @return void
     */
    public function render_edit_quote_screen5_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/edit_quote_screen5.php';
    }
    
    /**
     * render_update_task_edit_quote_mode_main_page
     *
     * @return void
     */
    public function render_update_task_edit_quote_mode_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/update_predefined_task_edit_quote_mode.php';
    }
    
    /**
     * render_delete_task_edit_quote_mode_main_page
     *
     * @return void
     */
    public function render_delete_task_edit_quote_mode_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_predefined_task_edit_quote_mode.php';
    }
    
    /**
     * render_delete_global_task_edit_quote_mode_main_page
     *
     * @return void
     */
    public function render_delete_global_task_edit_quote_mode_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_global_predefined_tasks_edit_quote_mode.php';
    }
    
    /**
     * render_client_management_search_quotes_main_page
     *
     * @return void
     */
    public function render_client_management_search_quotes_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/client_management_search_quotes.php';
    }
    
    /**
     * render_update_global_task_edit_quote_mode_main_page
     *
     * @return void
     */
    public function render_update_global_task_edit_quote_mode_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/update_global_predefined_tasks_edit_quote_mode.php';
    }
    
    /**
     * render_accepting_quotes_screen1_main_page
     *
     * @return void
     */
    public function render_accepting_quotes_screen1_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/accepting_quotes_screen1.php';
    }
    
    /**
     * render_creating_invoices_screen1_main_page
     *
     * @return void
     */
    public function render_creating_invoices_screen1_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/creating_invoices_screen1.php';
    }
    
    /**
     * render_client_management_search_invoices_main_page
     *
     * @return void
     */
    public function render_client_management_search_invoices_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/client_management_search_invoices.php';
    }
    
    /**
     * render_download_quote_main_page
     *
     * @return void
     */
    public function render_download_quote_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/download_quote.php';
    }
    
    /**
     * render_search_quotes_main_page
     *
     * @return void
     */
    public function render_search_quotes_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/search_quotes.php';
    }
    
    /**
     * render_delete_quote_main_page
     *
     * @return void
     */
    public function render_delete_quote_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_quote.php';
    }
    
    /**
     * render_delete_quote_step2_main_page
     *
     * @return void
     */
    public function render_delete_quote_step2_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_quote_step2.php';
    }
    
    /**
     * render_invoices_main_page
     *
     * @return void
     */
    public function render_invoices_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/invoices.php';
    }
    
    /**
     * render_create_invoice_main_page
     *
     * @return void
     */
    public function render_create_invoice_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_invoice.php';
    }
    
    /**
     * render_create_invoice_step2_main_page
     *
     * @return void
     */
    public function render_create_invoice_step2_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_invoice_step2.php';
    }
    
    /**
     * render_save_invoice_main_page
     *
     * @return void
     */
    public function render_save_invoice_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/save_invoice.php';
    }
    
    /**
     * render_search_invoice_main_page
     *
     * @return void
     */
    public function render_search_invoice_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/search_invoice.php';
    }
    
    /**
     * render_download_invoice_main_page
     *
     * @return void
     */
    public function render_download_invoice_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/download_invoice.php';
    }
    
    /**
     * render_statements_main_page
     *
     * @return void
     */
    public function render_statements_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/statements.php';
    }
    
    /**
     * render_create_statement_main_page
     *
     * @return void
     */
    public function render_create_statement_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_statement.php';
    }
    
    /**
     * render_search_statement_main_page
     *
     * @return void
     */
    public function render_search_statement_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/search_statement.php';
    }
    
    /**
     * render_create_statement_pdf_main_page
     *
     * @return void
     */
    public function render_create_statement_pdf_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/create_statement_pdf.php';
    }
    
    /**
     * render_clients_management_main_page
     *
     * @return void
     */
    public function render_clients_management_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/clients_management.php';
    }
    
    /**
     * render_update_global_predefined_tasks_main_page
     *
     * @return void
     */
    public function render_update_global_predefined_tasks_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/update-global-predefined-tasks.php';
    }
    
    /**
     * render_delete_global_predefined_tasks_main_page
     *
     * @return void
     */
    public function render_delete_global_predefined_tasks_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_global_predefined_tasks.php';
    }
    
    /**
     * render_manage_invoices_main_page
     *
     * @return void
     */
    public function render_manage_invoices_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/manage-invoices.php';
    }
    
    /**
     * render_delete_invoices_main_page
     *
     * @return void
     */
    public function render_delete_invoices_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_invoices.php';
    }

    /**
     * render_quote_creation_1a_main_page
     *
     * @return void
     */
    public function render_quote_creation_1a_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/quote_creation_1a.php';
    }

    /**
     * render_quote_creation_1b_main_page
     *
     * @return void
     */
    public function render_quote_creation_1b_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/quote_creation_1b.php';
    }

    /**
     * render_quote_creation_1c_main_page
     *
     * @return void
     */
    public function render_quote_creation_1c_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/quote_creation_1c.php';
    }

    /**
     * render_globals_main_page
     *
     * @return void
     */
    public function render_globals_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/globals.php';
    }

    /**
     * render_update_globals_main_page
     *
     * @return void
     */
    public function render_update_globals_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/update_globals.php';
    }

    /**
     * render_delete_globals_main_page
     *
     * @return void
     */
    public function render_delete_globals_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/delete_globals.php';
    }

    /**
     * render_contact_developers_main_page
     *
     * @return void
     */
    public function render_contact_developers_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/contact_developers.php';
    }

    /**
     * render_tute_add_clients_main_page
     *
     * @return void
     */
    public function render_tute_add_clients_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/tute_add_clients.php';
    }

    /**
     * render_tute_manage_clients_main_page
     *
     * @return void
     */
    public function render_tute_manage_clients_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/tute_manage_clients.php';
    }

    /**
     * render_tute_quote_creation_main_page
     *
     * @return void
     */
    public function render_tute_quote_creation_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/tute_quote_creation.php';
    }

    /**
     * render_tute_search_quotes_main_page
     *
     * @return void
     */
    public function render_tute_search_quotes_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/tute_search_quotes.php';
    }

    /**
     * render_tute_create_invoice_main_page
     *
     * @return void
     */
    public function render_tute_create_invoice_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/tute_create_invoices.php';
    }

    /**
     * render_tute_search_quotes_main_page
     *
     * @return void
     */
    public function render_tute_search_invoice_main_page()
    {
        require plugin_dir_path(__DIR__) . 'classes/tute_search_invoices.php';
    }

}