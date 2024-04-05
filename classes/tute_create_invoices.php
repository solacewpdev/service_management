<?php
namespace Service_Management\Classes;

class Tute_Create_Invoices
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function tute_create_invoice_display()
    {
        $tute_add_clients = <<<HTML

            <h5 class="text-center mt-4">Creating an invoice:</h5>
            <br />
            <div class="text-center">
                <h6>Click on "Clients->Create Invoice". You will be going back to the "Search all Quotes" screen to select a quote to convert to a invoice, or create invoice(s) from accepted quotes.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/create-invoice1.png"  width="600px;"/>
                <br /><br /><br />
                <h6>Acccept the quote if not accepted already, and click on "Create Invoices". From there you can navigate to "Clients->Search Invoices"</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/create-invoice2.png"  width="600px;"/>
            </div>
        HTML;

        echo $tute_add_clients;
    }
}

$tute_create_invoices = new Tute_Create_Invoices();
$tute_create_invoices->tute_create_invoice_display();