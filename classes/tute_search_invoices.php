<?php
namespace Service_Management\Classes;

class Tute_Search_Invoices
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function tute_create_invoice_display()
    {
        $tute_add_clients = <<<HTML

            <h5 class="text-center mt-4">Searching and working with invoices:</h5>
            <br />
            <div class="text-center">
                <h6>Click on "Clients->Search Invoices". Here you can download, delete, or manage invoices - by putting them in paid or leaving them in unpaid state.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/search-invoices1.png"  width="600px;"/>
                <br /><br /><br />
                <h6>Acccept the invoice as paid will leave the column in the main invoices table set to "Paid", or leave it for now on "NO" if not yet paid. This can be adjusted at any time.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/search-invoices2.png"  width="600px;"/>
                <h6>See below:</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/search-invoices3.png"  width="600px;"/>
            </div>
        HTML;

        echo $tute_add_clients;
    }
}

$tute_create_invoices = new Tute_Search_Invoices();
$tute_create_invoices->tute_create_invoice_display();