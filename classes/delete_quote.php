<?php
namespace Service_Management\Classes;

class Delete_Quote
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    /**
     * Adds an "Add Client" btn to the Manage Clients Portal.
     */
    public function delete_quote($message_1, $notice_color_1)
    { 
        if ( isset( $_POST['delete_quote'] ) )
        {
            $quote_delete_id                    = sanitize_text_field( $_POST['quote_delete_id'] );
            $client_quote_fname_delete_step1    = sanitize_text_field( $_POST['client_quote_fname_delete_step1'] );
            $client_quote_lname_delete_step1    = sanitize_text_field( $_POST['client_quote_lname_delete_step1'] );
            $quote_total_delete_step1           = sanitize_text_field( $_POST['quote_total_delete_step1'] );


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
                                    <h6 class="company_settings_form_notice">Quote ID: {$quote_delete_id}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            HTML;

            echo $notice_card_1;

            $confirm_delete = <<<HTML
            <h5 class="mt-4 mb-4">Quote Details:</h5>
            <p>Quote ID: {$quote_delete_id}</p>
            <p>First Name: {$client_quote_fname_delete_step1}</p>
            <p>Last Name: $client_quote_lname_delete_step1</p>
            <p>Quote Total: {$quote_total_delete_step1}</p>
            <h6>Confirm to delete by clicking on "Delete"</h6>
            <form method="POST" enctype="multipart/form-data" id="download-quote-step2" action="admin.php?page=sm-delete-quote-step2">
                <input type="hidden" value="{$quote_delete_id}" name="quote_delete_id_step2" />
                <button type="submit" class="btn btn-primary" name="delete_quote_step2" data-mdb-ripple-init>Delete</button>
            </form>
            HTML;
            echo $confirm_delete;
        }

        if ( !isset( $_POST['delete_quote'] ) ) { ?>
            <script>
                window.history.back();
            </script>
        <?php

        }
    }
}

$delete_quote = new Delete_Quote();

$message_1      = 'You are about to delete the following quote:';
$notice_color_1 = 'border_left_notice_success';

$delete_quote->delete_quote($message_1, $notice_color_1);