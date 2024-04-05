<?php
namespace Service_Management\Classes;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Quote_Creation_1C
{
    use Trait_Get_Currency;
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';

        if (isset( $_POST['submit_to_quote_creation_1c']))
        {
            
            $client_id = sanitize_text_field($_POST['client_id']);
            set_transient('client_id_transient', $client_id, 2592000);

        } 
    }
}

$quote_creation_1b  = new Quote_Creation_1C();
$form_id            = 'edit_quote_screen_1c';
$action_page        = 'admin.php?page=sm-create-quote-screen2';
$input_name         = 'currency_select';
$input_id           = 'currency_select';
$btn_name           = 'submit_to_create_quote_screen2';
$quote_creation_1b->get_currency($form_id, $action_page, $input_name, $input_id, $btn_name);
