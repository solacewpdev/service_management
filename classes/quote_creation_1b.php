<?php
namespace Service_Management\Classes;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Quote_Creation_1B
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function display_option()
    {
        if (isset( $_POST['submit_to_quote_creation_1b'] ) && 
        sanitize_text_field( $_POST['prompt_new_or_existing_user'] ) === 'new' )
        {
            require 'add_client.php';

        } else {
            $get_client_form = <<<HTML
            <img src="../wp-content/plugins/service_management/assets/images/illustrations/quote-create-step1b.png"  width="400px;"/>
            <form method="POST" enctype="multipart/form-data" id="add_quote_screen_1" action="admin.php?page=sm-quote-creation-1c">
            <label for="client_to_quote">Choose a client:</label>
            <select name="client_id" class="users ml-4 mb-1" id="client_id">
            HTML;
                echo $get_client_form;

            /**
             * Gets a list of all the clients' details and displays in a dropdown.
             */
            global $wpdb;

            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_clients";
            // Making SQL query from table name of employer details
            $sql = "SELECT * FROM $table_name";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) {
                $client_id = sanitize_text_field($print->ID);
                $client_company_name = sanitize_text_field($print->client_company_name);
                $client_fname = sanitize_text_field($print->client_first_name);
                $client_lname = sanitize_text_field($print->client_last_name);

                echo '<option value="' . $client_id . '">' . $client_fname . ' ' . $client_lname . '</option>';
            }
            $get_client_form_bottom = <<<HTML
        </select>
        <br /><br />

        <button type="submit" class="btn btn-primary" name="submit_to_quote_creation_1c" data-mdb-ripple-init>Next Step</button>
        </form>
        HTML;
            echo $get_client_form_bottom;
        }

            if (!isset($_POST['submit_to_quote_creation_1b']) &&
            !isset($_POST['submit_to_create_quote_screen2'])) { ?>
                <script>
                    window.history.back();
                </script>
            <?php

        }
    }
}

$quote_creation_1b = new Quote_Creation_1B();
$quote_creation_1b->display_option();