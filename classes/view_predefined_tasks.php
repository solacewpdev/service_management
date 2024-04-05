<?php 
namespace Service_Management\Classes;

class View_Predefined_Tasks 
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

    use Trait_View_Predefined_Tasks;
}

$view_predefined_tasks = new View_Predefined_Tasks();
$view_predefined_tasks->create_local_tasks_in_quote_create_mode();


