<?php
namespace Service_Management\Classes;

/**
 * In this class the user gets selected whom a quote will be created for. 
 * The user has an optional button to double check or change his/her company settings, by clicking on "View Settings".
 */
class Edit_Quote_Screen1
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';

        if (isset($_POST['submit_to_edit_quote_screen1']))
        {
            echo $edit_quote_id = $_POST['edit_quote_id'];

            set_transient('edit_quote_id_transient', $edit_quote_id, 2592000);

            echo 'edit quote client ID: ' . $edit_client_id = $_POST['client_id'];

            set_transient('edit_quote_client_id_transient', $edit_client_id, 2592000);
        }
    }

    /**
     * Adds an "View Settings" btn to the create quote section.
     */
    use Trait_Create_Button;

    use Trait_Card_Notices;

    use Trait_Get_Currency;

}

$create_quote_screen1 = new Edit_Quote_Screen1();

$button_id      = 'view-settings';
$action_page    = 'admin.php?page=sm-company-settings';
$button_name    = 'view_settings';
$button_value   = 'View Settings';
$create_quote_screen1->create_button($button_id, $action_page, $button_name, $button_value );

$message_1          = 'All your previously saved company settings will be used.';
$message_2          = 'Should you want to change them, simply click on "View Settings" and resave them, or click on "Next Step" to continue after selecting the relevant client.';
$card_border_color  = 'border_left_notice_warning';
$create_quote_screen1->trait_card_notices($message_1, $message_2, $card_border_color);

$form_id        = 'edit_quote_screen_1';
$action_page    = 'admin.php?page=sm-edit-quote-screen2';
$input_name     = 'edit_currency_select';
$input_id       = 'edit_currency_select';
$btn_name       = 'submit_to_edit_quote_screen2';
$create_quote_screen1->get_currency($form_id, $action_page, $input_name, $input_id, $btn_name);