<?php 

namespace Service_Management\Classes;

class Update_Predefined_Task
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
        
    /**
     * update_task_form
     *
     * @return void
     */
    public function update_task_form()
    { 

        if ( isset($_POST['quotes_update_task_page']) ) 
        {

        $task_id = $_POST['update_predefined_task_id'];

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_quotes_global_predefined_tasks";
        // Making SQL query from table name of employer details
        $sql = "SELECT * FROM $table_name WHERE ID = '$task_id'";
        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {
            $task_id_to_update  = sanitize_text_field( $print->ID );
            $task_description   = sanitize_text_field( $print->task_description );
            $task_amount        = sanitize_text_field( $print->task_amount );

        $update_task_form = <<<HTML

            <div class="card card_width">
            <h5 class="card-title">Update Client</h5>
            <div class="card border_left_notice_danger shadow h-100 py-2 mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase">
                                <h6 class="company_settings_form_notice">You are about to update the details for this task: <br /><br />
                                    {$task_description} {$task_amount}
                                </h6>
                            </div>
                            <div class="text-xs font-weight-bold text-uppercase">
                                <h6 class="company_settings_form_notice">All fields are required</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" enctype="multipart/form-data" id="create-tasks" action="admin.php?page=sm-edit-quote-screen4">
                <div class="container-fluid no_padding">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" id="local_task_update_delete_desc" name="local_task_update_delete_desc" value="{$task_description}" class="form-control" required />
                                <label class="form-label" for="local_task_update_delete_desc">Enter the task description:</label>
                            </div>
                        </div>
                        <div class="col-md-4 no_padding">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" id="local_task_update_delete_amount" value="{$task_amount}" name="local_task_update_delete_amount" class="form-control" required />
                                <label class="form-label" for="local_task_update_delete_amount">Amount:</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="small-text" name="task_update_id" value="{$task_id_to_update}">
                    <button type="submit" class="btn btn-primary mt-4" name="submit_update_task" data-mdb-ripple-init>Update</button>
                </div>
            </form>
            </div>
            
            HTML;
        
            echo $update_task_form;

            }
        }
    }
}

$update_predefined_task = new Update_Predefined_Task();
$update_predefined_task->update_task_form();
