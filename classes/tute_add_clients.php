<?php
namespace Service_Management\Classes;

class Tute_Add_Clients
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function tute_add_clients()
    {
        $tute_add_clients = <<<HTML

            <h5 class="text-center mt-4">There are three ways to add clients into the system:</h5>
            <br />
            <div class="text-center">
                <h6>First route is to click on "Clients->Add Client" and fill in the form. After that you will be directed to complete the quote process. Please see "Tutorials->Create Quote Tutorial" for how to complete the quote creation process.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/add-client-1.png"  width="600px;"/>
                <br /><br /><br />
                <h6>The second route is to click on "Clients->Create Quote->New" and fill in the form. After that you will be directed to complete the quote process. Please see "Tutorials->Create Quote Tutorial" for how to complete the quote creation process.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/add-client-2.png"  width="600px;"/>
                <h6>The last route is to click on "Clients->Manage Clients->Add Client" and fill in the form. After that you will be directed to complete the quote process. Please see "Tutorials->Create Quote Tutorial" for how to complete the quote creation process.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/add-client-3.png"  width="600px;"/>
            </div>
        HTML;

        echo $tute_add_clients;
    }
}

$tute_add_clients = new Tute_Add_Clients();
$tute_add_clients->tute_add_clients();