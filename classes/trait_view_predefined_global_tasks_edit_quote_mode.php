<?php
namespace Service_Management\Classes;

trait Trait_View_Predefined_Global_Tasks_Edit_Quote_Mode
{    
    /**
     * read_global_tasks_edit_mode
     *
     * @return void
     */
    public function read_global_tasks_edit_mode()
    {
        echo '
        <form method="POST" id="delete-predefined-tasks" action="admin.php?page=sm-edit-quote-screen5">
        <h3 class="mt-4">Global Predefined Tasks</h3>
        <table id="global_predefined_tasks" class="display mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task Description</th>
                    <th>Amount</th>
                    <th></th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>';

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_quotes_global_predefined_tasks";
        // Making SQL query from table name of employer details
        $sql = "SELECT * FROM $table_name";

        $result = $wpdb->get_results($sql);
        foreach ($result as $print) 
        {
            $task_id            = sanitize_text_field( $print->ID );
            $task_description   = sanitize_text_field( $print->task_description );
            $task_amount        = sanitize_text_field( $print->task_amount );

            $predefined_table = <<<HTML
        
                <tr>
                    <td>
                        {$task_id}
                    </td>
                    <td>
                        {$task_description}
                    </td>
                    <td>
                        {$task_amount}
                    </td>
                    <td class="td_adjuster">
                        <form method="POST" id="update-predefined-tasks" action="">
                            <input type="hidden" class="small-text">
                            
                        </form>
                    </td>
                    <td class="td_adjuster">
                        <form method="POST" id="update-predefined-tasks" action="admin.php?page=sm-update-global-task-edit-quote-mode">
                            <button type="submit" class="btn btn-primary mt-3" name="quotes_update_task_page" data-mdb-ripple-init>Update</button>
                            <input type="hidden" class="small-text" name="update_predefined_task_id" value="{$task_id}">
                        </form>
                    </td>
                    <td class="td_adjuster">
                        <form method="POST" id="delete-predefined-tasks" action="admin.php?page=sm-delete-global-task-edit-quote-mode">
                            <button type="submit" class="btn btn-primary mt-3" name="delete_predefined_tasks" data-mdb-ripple-init>Delete</button>
                            <input type="hidden" class="small-text" name="delete_predefined_task_id" value="{$task_id}">
                        </form>
                    </td>
                    <td>
                        <input type="checkbox" id ="global_predefined_tasks" value="{$task_description}-{$task_amount}" name="global_predefined_tasks[]" />
                    </td>
                </tr>
            
            HTML;

            echo $predefined_table;

        } ?>

                </tbody>
            </table>
            <button type="submit" class="btn btn-success" id="submit_to_edit_quote_screen5" name="submit_to_edit_quote_screen5" data-mdb-ripple-init>Confirm Quote Details</button>
            </form>
        <?php
        }

    public function check_checkboxes()
    {
        if (isset($_POST['submit_to_proceed_to_create_quote_screen5'] ) && (!isset($_POST['global_predefined_tasks']))) {
        echo '<script>';
        echo 'alert("script working!");';
        echo '</script>';
        exit;
        }
    }
}
