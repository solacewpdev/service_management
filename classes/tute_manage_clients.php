<?php
namespace Service_Management\Classes;

class Tute_Manage_Clients
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function tute_manage_clients()
    {
        $tute_manage_clients_display = <<<HTML

            <h5 class="text-center mt-4">When we look at the placeholder screen here, the following can be done in the "Clients->Manage Clients" screen:</h5>
            <br />
            <div class="text-center">
                <h6>You can update, delete, manage your clients.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/manage-client-1.png"  width="600px;"/>
                <br /><br /><br />
                <h6>When you want to manage a client, the screen will look like the following. In this screen, you can view all the quotes and invoices relating to the client.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/manage-client-2.png"  width="600px;"/>
                <h6>When you want to update a client, the screen will look like the following:</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/manage-client-3.png"  width="600px;"/>
                <br /><br /><br />
                <h6>When you want to delete a client, the screen will look like the following. In this screen, you can update or delete the client.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/manage-client-4.png"  width="600px;"/>
            </div>
        HTML;

        echo $tute_manage_clients_display;
    }
}

$tute_manage_clients = new Tute_Manage_Clients();
$tute_manage_clients->tute_manage_clients();