<?php
namespace Service_Management\Classes;

class Delete_Quote
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    use Trait_Create_Button;

    /**
     * Adds an "Add Client" btn to the Manage Clients Portal.
     */
    public function delete_quote($message_1, $notice_color_1)
    { 
        if ( isset( $_POST['delete_quote_step2']))
        {
            $quote_id = sanitize_text_field( $_POST['quote_delete_id_step2'] );

            $notice_card_1 = <<<HTML
            <div class="card card_width">
                <div class="card {$notice_color_1} shadow h-100 py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase">
                                    <h6 class="company_settings_form_notice">
                                        {$message_1} 
                                    </h6>
                                </div>
                                <div class="text-xs font-weight-bold text-uppercase">
                                    <h6 class="company_settings_form_notice">Quote ID: {$quote_id}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            HTML;

            echo $notice_card_1;

        global $wpdb;

        $table_name = $wpdb->prefix . "service_management_quotes";
        $wpdb->delete($table_name, array( 'ID' => $quote_id ) );

        }
    }
}

$delete_quote = new Delete_Quote();

$message_1      = 'You have successfully deleted the following quote:';
$notice_color_1 = 'border_left_notice_success';

$button_id      = 'back_to_search_from_delete_quotes';
$action_page    = 'admin.php?page=sm-search-quotes';
$button_name    = 'back_to_search_from_delete_quotes';
$button_value   = 'Back to Search Quotes';
$delete_quote->create_button($button_id, $action_page, $button_name, $button_value);

$delete_quote->delete_quote($message_1, $notice_color_1);