<?php
namespace Service_Management\Classes;

trait Trait_Get_Client
{    
    /**
     * get_client
     *
     * @return void
     */
    public function get_client(
        $form_id, 
        $action_page, 
        $select_name, 
        $select_id, 
        $input_name, 
        $input_id, 
        $btn_name
        )
    {
        $get_client_form = <<<HTML
        <form method="POST" enctype="multipart/form-data" id="{$form_id}" action="$action_page">
        <label for="client_to_quote">Choose a client:</label>
        <select name="{$select_name}" class="users ml-4 mb-1" id="{$select_id}">
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
            $client_id              = sanitize_text_field( $print->ID );
            $client_company_name    = sanitize_text_field( $print->client_company_name );
            $client_fname           = sanitize_text_field( $print->client_first_name );
            $client_lname           = sanitize_text_field( $print->client_last_name );

            echo '<option value="' . $client_id . '">' . $client_fname . ' ' . $client_lname . '</option>';

        }
        $get_client_form_bottom = <<<HTML
        </select><br /><br />
        <div class="form-outline currency_width" data-mdb-input-init>
                <input type="text" id="{$input_id}" name="{$input_name}" class="form-control mb-4" />
                <label class="form-label" for="currency_selector">Enter Currency Prefix For Quote</label>
            </div>
        <button type="submit" class="btn btn-primary" name="{$btn_name}" data-mdb-ripple-init>Next Step</button>
        </form>
        HTML;
        echo $get_client_form_bottom;
    }
}
