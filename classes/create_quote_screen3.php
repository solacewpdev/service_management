<?php
namespace Service_Management\Classes;

class Create_Quote_Screen3
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
    
    use Trait_View_Predefined_Tasks;
    
    /**
     * process_quote_creation
     *
     * @return void
     */
    public function process_quote_creation()
    {
        if (isset($_POST['submit_to_create_quote_screen3']))
        {

            $budget = sanitize_text_field( $_POST['budget'] );
            set_transient('budget_transient', $budget, 2592000);
            $random_quote_id = rand(1, 1000000);
            set_transient('quote_id_transient', $random_quote_id, 2592000);
            $client_id = get_transient('client_id_transient');
            $quote_id = get_transient('quote_id_transient');
            $currency_select = get_transient('currency_selector_transient');

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_clients";
            $sql = "SELECT * FROM $table_name WHERE ID = '$client_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) {

                $client_id              = sanitize_text_field( $print->ID );
                $client_company_name    = sanitize_text_field( $print->client_company_name );
                $client_first_name      = sanitize_text_field( $print->client_first_name );
                $client_last_name       = sanitize_text_field( $print->client_last_name );
            
                global $wpdb;

                set_transient('global_predefined_tasks_transient', '', 2592000);
                set_transient('local_predefined_tasks_transient', '', 2592000);

                $array1 = get_transient('global_predefined_tasks_transient');
                $array2 = get_transient('local_predefined_tasks_transient');

                $array1 = explode(', ', $array1);
                $array2 = explode(', ', $array2);
                
                $predefined_tasks_confirmed = array_merge($array1, $array2);
                $predefined_tasks_confirmed = json_encode($predefined_tasks_confirmed);
                

                $table_name = $wpdb->prefix . "service_management_quotes";
                $wpdb->insert(
                    $table_name,
                    array(

                        'ID'                    => $quote_id,
                        'client_id'             => $client_id,
                        'client_company_name'   => $client_company_name,
                        'client_quote_fname'    => $client_first_name,
                        'client_quote_lname'    => $client_last_name,
                        'currency'              => $currency_select,
                        'budget'                => $budget,
                        'quote_accepted'        => 'NO',
                        'predefined_tasks'      => $predefined_tasks_confirmed

                    ),
                    array(
                        '%s'
                    )
                );

                echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }    
    /**
     * create_object
     *
     * @return void
     */
    public function create_object()
    {

        if (isset($_POST['add_local_predefined_tasks_submit'])) {

            $quote_id = get_transient('quote_id_transient');
            $currency_select = get_transient('currency_selector_transient');

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_quotes_local_predefined_tasks";
            $sql = "SELECT * FROM $table_name WHERE quote_id = '$quote_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) 
            {
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

            $table_name = $wpdb->prefix . "service_management_quotes_local_predefined_tasks";
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
    
    /**
     * update_task_local
     *
     * @return void
     */
    public function update_task_local()
    {
        if (isset( $_POST['submit_update_task'] ) ) {

            global $wpdb;

            $table_name     = $wpdb->prefix . "service_management_quotes_local_predefined_tasks";
            $data_update    = array(

                'task_description'  => sanitize_text_field( $_POST['local_task_update_delete_desc'] ),
                'task_amount'       => sanitize_text_field( $_POST['local_task_update_delete_amount'] ),

            );

            $data_where = array('ID' => $_POST['task_update_id'] );
            $wpdb->update( $table_name, $data_update, $data_where );

            echo "<meta http-equiv='refresh' content='0'>";

        }
    }
    
    /**
     * delete_local_task
     *
     * @return void
     */
    public function delete_local_task()
    {
        if ( isset($_POST['quotes_delete_task_page'] ) ) {
        
            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes_local_predefined_tasks";

            $wpdb->delete( $table_name, array('ID' => $_POST['task_delete_id_perm'] ) );

            echo "<meta http-equiv='refresh' content='0'>";
        
        }
    }
}

$quote_creation_step3 = new Create_Quote_Screen3();

$local_or_global    = 'Add Local Predefined Tasks';
$task_type          = 'Add Local Task';
$modal_target_id    = '#localTasksModal';
$modal_target_no_id ='localTasksModal';
$modal_target_label = 'localTasksModalLabel';
$submit_name        = 'add_local_predefined_tasks_submit';

$quote_creation_step3->tasks_modals($local_or_global, $task_type, $modal_target_id, $modal_target_no_id, $modal_target_label, $submit_name);


$quote_creation_step3->create_local_tasks_in_quote_create_mode();
$quote_creation_step3->process_quote_creation();
$quote_creation_step3->create_object();
$quote_creation_step3->update_task_local();
$quote_creation_step3->delete_local_task();