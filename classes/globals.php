<?php
namespace Service_Management\Classes;

class Globals
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    use Trait_Tasks_Modals;

    use Trait_View_Predefined_Globals; 
       
    /**
     * update_task_global
     *
     * @return void
     */
    public function update_task_global()
    {
        if ( isset($_POST['submit_update_task'] ) ) {

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes_global_predefined_tasks";

            $data_update = array(

                'task_description' => sanitize_text_field( $_POST['local_task_update_delete_desc'] ),
                'task_amount' => sanitize_text_field( $_POST['local_task_update_delete_amount'] ),

            );

            $data_where = array('ID' => $_POST['task_update_id'] );
            $wpdb->update( $table_name, $data_update, $data_where );

            echo "<meta http-equiv='refresh' content='0'>";

        }
    }
    
    /**
     * delete_global_task
     *
     * @return void
     */
    public function delete_global_task()
    {
        if ( isset( $_POST['quotes_delete_task_page'] ) ) 
        {

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes_global_predefined_tasks";

            $wpdb->delete( $table_name, array('ID' => $_POST['task_delete_id_perm'] ) );

            echo "<meta http-equiv='refresh' content='0'>";

        }
    }
    
    /**
     * create_object
     *
     * @return void
     */
    public function create_object()
    {
        if ( isset( $_POST['add_global_predefined_tasks_submit'] ) ) 
        {

            $quote_id = get_transient('quote_id_transient');
            $currency_select = get_transient('currency_selector_transient');

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_quotes_global_predefined_tasks";
            $sql = "SELECT * FROM $table_name WHERE quote_id = '$quote_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) {
                $task_id = sanitize_text_field($print->ID);
                $task_description_db = sanitize_text_field($print->task_description);
                $task_amount_db = sanitize_text_field($print->task_amount);

                $task_description = sanitize_text_field($_POST['task_description']);
                $task_amount = $currency_select . ' ' . sanitize_text_field($_POST['task_amount']);

                if (
                    $task_description_db === $task_description &&
                    $task_amount_db === $task_amount
                ) {
                    $exit_script = "<script>
                    alert('Task already exists')
                    </script>";

                    echo "<meta http-equiv='refresh' content='0'>";

                    exit($exit_script);
                }


            }

            $task_description = sanitize_text_field($_POST['task_description']);
            $task_amount = $currency_select . ' ' . sanitize_text_field($_POST['task_amount']);

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes_global_predefined_tasks";
            $wpdb->insert(
                $table_name,
                array(

                    'task_description' => $task_description,
                    'task_amount' => $task_amount,
                    'quote_id' => $quote_id,

                ),
                array(
                    '%s',
                    '%s',
                    '%s'
                )
            );


            echo "<meta http-equiv='refresh' content='0'>";

        }
    }
}

$quote_creation_step4 = new Globals();

$local_or_global    = 'Add Global Predefined Tasks';
$task_type          = 'Add Global Task';
$modal_target_id    = '#globalTasksModal';
$modal_target_no_id = 'globalTasksModal';
$modal_target_label = 'globalTasksModalLabel';
$submit_name        = 'add_global_predefined_tasks_submit';

$quote_creation_step4->tasks_modals($local_or_global, $task_type, $modal_target_id, $modal_target_no_id, $modal_target_label, $submit_name);
$quote_creation_step4->update_task_global();
$quote_creation_step4->delete_global_task();
$quote_creation_step4->read_global_tasks();
$quote_creation_step4->create_object();

