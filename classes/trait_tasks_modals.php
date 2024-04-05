<?php
namespace Service_Management\Classes;

trait Trait_Tasks_Modals
{    
    /**
     * tasks_modals
     *
     * @param  mixed $local_or_global
     * @param  mixed $task_type
     * @param  mixed $modal_target_id
     * @param  mixed $modal_target_no_id
     * @param  mixed $modal_target_label
     * @param  mixed $submit_name
     * @return void
     */
    public function tasks_modals($local_or_global, $task_type, $modal_target_id, $modal_target_no_id, $modal_target_label, $submit_name)
    {
        $modal_tasks = <<<HTML
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-lg btn-primary mt-4" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="{$modal_target_id}">
        {$local_or_global}
        </button>

        <!-- Modal -->
        <div class="modal fade" id="{$modal_target_no_id}" tabindex="-1" aria-labelledby="{$modal_target_label}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{$modal_target_label}">{$task_type}</h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>When inserting a description and an amount, make sure not to use something like "Local Task 1" by using any numbers in the description, because that will interfere with the calculations. Should you wish to use a decimal, then use a full stop and not a comma. And you can add the amount without any currency signs. It gets automatically added.</p>
                    <form method="POST" enctype="multipart/form-data" id="create-tasks" action="">
                    <div class="container-fluid no_padding">
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <div class="form-outline" data-mdb-input-init>
                                    <input type="text" id="task_description" name="task_description" class="form-control" required />
                                    <label class="form-label" for="task_description">Task Name:</label>
                                </div>
                            </div>
                            <div class="col-md-4 no_padding mb-4">
                                <div class="form-outline" data-mdb-input-init>
                                    <input type="text" id="task_amount" name="task_amount" class="form-control" required />
                                    <label class="form-label" for="task_amount">Amount:</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="{$submit_name}" data-mdb-ripple-init>Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
HTML;

        echo $modal_tasks;
    }
}