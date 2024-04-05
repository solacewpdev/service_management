<?php
namespace Service_Management\Classes;

trait Trait_View_Predefined_Tasks_Edit_Quote_Mode
{    
    /**
     * create_local_tasks_in_quote_edit_mode
     *
     * @return void
     */
    public function create_local_tasks_in_quote_edit_mode()
    {
            $trait_local_tasks = <<<HTML
            <form method="POST" id="delete-predefined-tasks" action="admin.php?page=sm-edit-quote-screen4">
                <h3 class="mt-4">Local Predefined Tasks</h3>
                <h5>Please select/create/edit/delete your local predefined tasks for the quote you are making</h5>
                    <table id="local_predefined_tasks" class="display">
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
                        <tbody>
            HTML;
            echo $trait_local_tasks;

            $quote_id = get_transient('quote_id_transient');

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_quotes_local_predefined_tasks";
            // Making SQL query from table name of employer details
            $sql = "SELECT * FROM $table_name WHERE quote_id = '$quote_id'";

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
                            <form method="POST" id="update-predefined-tasks" action="admin.php?page=sm-update-task-edit-quote-mode">
                                <input type="hidden" class="small-text" name="update_predefined_task_id" value="{$task_id}">
                                <button type="submit" class="btn btn-primary mt-3" name="quotes_update_task_page" data-mdb-ripple-init>Update</button>
                            </form>
                        </td>
                        <td class="td_adjuster">
                            <form method="POST" id="delete-predefined-tasks" action="admin.php?page=sm-delete-task-edit-quote-mode">
                                <input type="hidden" class="small-text" name="delete_predefined_task_id" value="{$task_id}">
                                <button type="submit" class="btn btn-primary mt-3" name="delete_predefined_tasks" data-mdb-ripple-init>Delete</button>
                            </form>
                        </td>
                        <td>
                            
                            <input type="checkbox" name="local_predefined_tasks[]" value="{$task_description}-{$task_amount}" />
                        </td>
                    </tr>
                            
                    HTML;

                echo $predefined_table;

            } ?>
       
                    </tbody>
                </table>
               
                <button type="submit" class="btn btn-success" name="submit_to_edit_quote_screen4" data-mdb-ripple-init>Proceed To Global Tasks</button>
                </form>
        <?php   
    }
}