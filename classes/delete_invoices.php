<?php
namespace Service_Management\Classes;

class Manage_Invoices
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

    use Trait_Create_Button;

    use Trait_Create_Button;
    
    /**
     * set_invoice_number
     *
     * @return void
     * 
     */
    public function set_invoice_number()
    {
        $invoice_delete_id = $_POST['invoice_delete_id'];

        $invoice_id = set_transient('search_invoice_id_transient', $invoice_delete_id, 2592000);
        
        if ( !isset( $_POST['invoice_delete_id'] ) ) 
        { ?>
            <script>
                window.history.back();
            </script>
        <?php

        }
    }
}

$manage_invoices = new Manage_Invoices();

$message1           = 'On this page you can delete the invoice.';
$message2           = 'This will also reflect in your dashboard.';
$card_border_color  = 'border_left_notice_warning';
$manage_invoices->trait_card_notices($message1, $message2, $card_border_color);

$button_id      = 'invoice_delete';
$action_page    = 'admin.php?page=sm-search-invoice';
$button_name    = 'submit_invoice_delete';
$button_value   = 'Delete Invoice';

$manage_invoices->create_button($button_id, $action_page, $button_name, $button_value);

$button_id      = 'invoice_paid_go_back';
$action_page    = 'admin.php?page=sm-search-invoice';
$button_name    = 'submit_invoice_paid_go_back';
$button_value   = 'Go Back';

$manage_invoices->create_button($button_id, $action_page, $button_name, $button_value);

$manage_invoices->set_invoice_number();