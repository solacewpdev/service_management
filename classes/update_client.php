<?php 
namespace Service_Management\Classes;

class Update_Client
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
        
    /**
     * update_client_form
     *
     * @return void
     */
    public function update_client_form()
    { 

        if ( isset($_POST['update_client']) ) 
        {

            $client_id = $_POST['client_update_id'];

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_clients";
        // Making SQL query from table name of employer details
        $sql = "SELECT * FROM $table_name WHERE ID = '$client_id'";
        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {
            $client_update_company_name             = sanitize_text_field( $print->client_company_name );
            $client_id_to_update                    = sanitize_text_field( $print->ID );
            $client_update_fname                    = sanitize_text_field( $print->client_first_name );
            $client_update_lname                    = sanitize_text_field( $print->client_last_name );
            $client_update_tel                      = sanitize_text_field( $print->client_tel_no );
            $client_website_url                     = sanitize_text_field( $print->client_website_link );
            $client_update_email_address            = sanitize_text_field( $print->client_email );
            $client_update_client_physical_address  = sanitize_text_field( $print->client_address );
        
        $update_form = <<<HTML

            <div class="card card_width">
            <h5 class="card-title">Update Client</h5>
            <div class="card border_left_notice_danger shadow h-100 py-2 mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase">
                                <h6 class="company_settings_form_notice">You are about to update the details for: 
                                    {$client_update_fname} {$client_update_lname}
                                </h6>
                            </div>
                            <div class="text-xs font-weight-bold text-uppercase">
                                <h6 class="company_settings_form_notice">Website link and physical address is optional</h6>
                            </div>
                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->
                        </div>
                    </div>
                </div>
            </div>
            
            <form method="POST" enctype="multipart/form-data" id="add-clients" action="admin.php?page=sm-manage-clients">
                
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="form12" name="client_company_name" class="form-control" value="{$client_update_company_name}" required />
                    <label class="form-label" for="form12">Enter the client's company name:</label>
                </div>
                <br />
                
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="client_first_name" name="client_first_name" class="form-control" value="{$client_update_fname}" required />
                    <label class="form-label" for="form12">Enter the client's first name:</label>
                </div>
                <br />

                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="client_last_name" name="client_last_name" class="form-control" value="{$client_update_lname}" required />
                    <label class="form-label" for="form12">Enter the client's last name:</label>
                </div>
                <br />

                <div class="form-outline" data-mdb-input-init>
                    <input type="tel" id="client_tel_no" name="client_tel_no" class="form-control" value="{$client_update_tel}" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}" required />
                    <label class="form-label" for="client_tel_no">Enter the client's tel no:</label>
                </div>
                <br />

                <div class="form-outline" data-mdb-input-init>
                    <input type="url" id="client_website_link" name="client_website_link" class="form-control" value="{$client_website_url}" />
                    <label class="form-label" for="client_website_link">Enter the client's client's website link:</label>
                </div>
                <br />

                <div class="form-outline" data-mdb-input-init>
                    <input type="email" id="client_email" name="client_email" class="form-control" value="{$client_update_email_address}" required />
                    <label class="form-label" for="client_email">Enter the client's client's email:</label>
                </div>
                <br />

                <div class="form-outline" data-mdb-input-init>
                    <input type="text" id="client_address" name="client_address" class="form-control" value="{$client_update_client_physical_address}"  />
                    <label class="form-label" for="client_address">Enter the client's physical address:</label>
                </div>
                <br />

                <input type="hidden" name="client_id_from_update_page" value="{$client_id_to_update}">

                <button type="submit" class="btn btn-primary" name="update_client_from_update_page" data-mdb-ripple-init>Update</button>
            </div>
            HTML;
        
            echo $update_form;

            }
        }

        if (!isset($_POST['update_client'])) { ?>
            <script>
                window.history.back();
            </script>
        <?php
        
        }
    }
}

$update_client = new Update_Client();
$update_client->update_client_form();
