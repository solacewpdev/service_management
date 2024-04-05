<?php 

namespace Service_Management\Classes;


class Global_Predefined_Task 
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

    use Trait_Card_Notices;    
    /**
     * get_predefined_global_tasks
     *
     * @return void
     */
    public function get_predefined_global_tasks()
    {
        $service_fields_form = <<<HTML
            <form method="POST" enctype="multipart/form-data" id="create-tasks" action="admin.php?page=sm-process-predefined-tasks">
                <div class="container-fluid no_padding">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-outline mt-4 mb-4" data-mdb-input-init>
                                <input type="text" name="task_description" class="form-control" required />
                                <label class="form-label" for="task_description">Enter the task description:</label>
                            </div>
                        </div>
                        <div class="col-md-4 no_padding">
                            <div class="form-outline mt-4 mb-4" data-mdb-input-init>
                                <input type="text" name="task_amount" class="form-control" />
                                <label class="form-label" for="task_amount">Amount:</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_predefined_task_submit" data-mdb-ripple-init>Add Task</button>
                </div>
            </form>
        </div>

        HTML;

        echo $service_fields_form;

    }
}

$predefine_task_form = new Global_Predefined_Task();

$message_1          = 'Add a global predefined service task and amount ';
$message_2          = 'You can create a predefined task and amount to avoid repetative task adding when doing quotes. Enter task amount without currency sign. Any decimals should use a fullstop, and no numbers in description.';
$card_border_color  = 'border_left_notice_warning';
$predefine_task_form->trait_card_notices($message_1, $message_2, $card_border_color);

$predefine_task_form->get_predefined_global_tasks();