<?php
namespace Service_Management\Classes;

class Quotes_Overview
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    /**
     * Adds an "Add Client" btn to the Manage Clients Portal.
     */
    use Trait_Create_Button;

    use Trait_View_Predefined_Tasks;

    public function create_object()
    {
        if ( isset( $_POST['create_predefined_task_submit'] ) ) 
        {
            $currency_select = get_transient('currency_selector_transient');

            $task_description   = sanitize_text_field( $_POST['task_description'] );
            $task_amount        = $currency_select . sanitize_text_field( $_POST['task_amount'] );

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes_predefined_tasks";
            $wpdb->insert(
                $table_name, array(

                    'task_description'  => $task_description,
                    'task_amount'       => $task_amount

                ), array(
                    '%s'
                )
            );
        }
    }

    public function update_object()
    {
        if ( isset( $_POST['quotes_update_task_page'] ) ) 
        {

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes_predefined_tasks";
            $data_update = array(
                'task_description'  => sanitize_text_field( $_POST['task_update_desc_update_page'] ),
                'task_amount'       => sanitize_text_field( $_POST['task_update_amount_update_page'] ),
                

            );
            $data_where = array('ID' => $_POST['task_update_id'] );
            $wpdb->update( $table_name, $data_update, $data_where );

            echo "<meta http-equiv='refresh' content='0'>";

        }
    }

    public function delete_object()
    {
        if ( isset( $_POST['quotes_delete_task_page'] ) ) {

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes_predefined_tasks";
            $wpdb->delete( $table_name, array('ID' => $_POST['task_delete_id_perm'] ) );
            
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
}

$quotes_overview = new Quotes_Overview();

$button_id      = 'add-predefined-task-to-backend';
$action_page    = 'admin.php?page=sm-create-predefined-task';
$button_name    = 'add_predefined_tasks_to_backend';
$button_value   = 'Create Task';
$quotes_overview->create_button( $button_id, $action_page, $button_name, $button_value );

$quotes_overview->create_object();
$quotes_overview->update_object();
$quotes_overview->delete_object();