<?php
namespace Service_Management\Classes;

/**
 * In this class the user gets selected whom a quote will be created for. 
 * The user has an optional button to double check or change his/her company settings, by clicking on "View Settings".
 */
class Create_Quote_Screen1
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    /**
     * Adds an "View Settings" btn to the create quote section.
     */
    use Trait_Create_Button;

    use Trait_Card_Notices;

    use Trait_Get_Client;

}

$create_quote_screen1 = new Create_Quote_Screen1();

$button_id      = 'view-settings';
$action_page    = 'admin.php?page=sm-company-settings';
$button_name    = 'view_settings';
$button_value   = 'View Settings';
$create_quote_screen1->create_button($button_id, $action_page, $button_name, $button_value );

$message_1          = 'All your previously saved company settings will be used.';
$message_2          = 'Should you want to change them, simply click on "View Settings" and resave them, or click on "Next Step" to continue after selecting the relevant client.';
$card_border_color  = 'border_left_notice_warning';
$create_quote_screen1->trait_card_notices($message_1, $message_2, $card_border_color);

$form_id        = 'add_quote_screen_1';
$action_page    = 'admin.php?page=sm-create-quote-screen2';
$select_name    = 'client_to_quote_select';
$select_id      = 'client_to_quote_select';
$input_name     = 'currency_selector';
$input_id       = 'currency_selector';
$btn_name       = 'submit_to_create_quote_screen2';
$create_quote_screen1->get_client($form_id, $action_page, $select_name, $select_id, $input_name, $input_id, $btn_name);