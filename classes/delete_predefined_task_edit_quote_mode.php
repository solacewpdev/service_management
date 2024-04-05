<?php
namespace Service_Management\Classes;

class Delete_Task
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function delete_predefined_task()
    {
        if ( isset( $_POST['delete_predefined_tasks'] ) ) 
        {

        echo $task_to_delete_id = $_POST['delete_predefined_task_id'];

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_quotes_local_predefined_tasks";
        // Making SQL query from table name
        $sql = "SELECT * FROM $table_name WHERE ID = '$task_to_delete_id'";
        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {
            
            $task_to_delete_id              = sanitize_text_field($print->ID);
            $task_to_delete_description     = sanitize_text_field($print->task_description);
            $task_to_delete_amount          = sanitize_text_field($print->task_amount);

        $delete_task_form = <<<HTML

                <div class="card card_width">
                <h5 class="card-title">Delete Predefined Task</h5>
                <div class="card border_left_notice_danger shadow h-100 py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase">
                                    <h6 class="company_settings_form_notice">You are about to delete the following task: 
                                        {$task_to_delete_description} {$task_to_delete_amount}
                                    </h6>
                                </div>
                                <div class="text-xs font-weight-bold text-uppercase">
                                    <h6 class="company_settings_form_notice">You can update, by clicking on "Update" or delete the user by clicking on "Delete".</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form method="POST" enctype="multipart/form-data" id="create-tasks" action="admin.php?page=sm-edit-quote-screen3">
                <div class="container-fluid no_padding">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" id="local_task_update_delete_desc" value="{$task_to_delete_description}" name="local_task_update_delete_desc" class="form-control" />
                                <label class="form-label" for="local_task_update_delete_desc">Enter the task description:</label>
                            </div>
                        </div>
                        <div class="col-md-4 no_padding">
                            <div class="form-outline" data-mdb-input-init>
                                <input type="text" id="local_task_update_delete_amount" value="{$task_to_delete_amount}" name="local_task_update_delete_amount" class="form-control" />
                                <label class="form-label" for="local_task_update_delete_amount">Amount:</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4" name="submit_update_task" data-mdb-ripple-init>Update</button>
                    <input type="hidden" name="task_update_id" value="{$task_to_delete_id}">
                    <button type="submit" class="btn btn-primary mt-4" name="quotes_delete_task_page" data-mdb-ripple-init>Delete</button>
                    <input type="hidden" name="task_delete_id_perm" value="{$task_to_delete_id}">
                </div>
            </form>
            HTML;

            echo $delete_task_form;

            }
        }
    }
}
$delete_predefined_task = new Delete_Task();
$delete_predefined_task->delete_predefined_task();