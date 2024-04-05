<?php
namespace Service_Management\Classes;

class Manage_Invoices
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php'; 
    }

    use Trait_Card_Notices;

    use Trait_Create_Button;

    use Trait_Create_Button;

    public function invoice_navigate_back()
    {
        $manage_invoice_id = $_POST['manage_invoice_id'];

        $invoice_id = set_transient('search_invoice_id_transient', $manage_invoice_id, 2592000);
        
        if (!isset($_POST['manage_invoice_id'])) {    

        ?>

        <script>
            window.history.back();
        </script>

    <?php

        }
    }
}

$manage_invoices = new Manage_Invoices();

$message1           = 'On this page you can select if the invoice has been paid or not.';
$message2           = 'If it has been paid it will reflect on the dashboard';
$card_border_color  = 'border_left_notice_warning';
$manage_invoices->trait_card_notices($message1, $message2, $card_border_color);

$button_id      = 'invoice_paid';
$action_page    = 'admin.php?page=sm-search-invoice';
$button_name    = 'submit_invoice_paid';
$button_value   = 'Yes, it has been paid';

$manage_invoices->create_button($button_id, $action_page, $button_name, $button_value);

$button_id      = 'invoice_paid_go_back';
$action_page    = 'admin.php?page=sm-search-invoice';
$button_name    = 'submit_invoice_paid_go_back';
$button_value   = 'Go Back';

$manage_invoices->create_button($button_id, $action_page, $button_name, $button_value);

$manage_invoices->invoice_navigate_back();