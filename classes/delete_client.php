<?php
namespace Service_Management\Classes;

class Delete_Client
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
     * delete_client_form
     *
     * @return void
     * 
     * Getting information and processing the delete functionality
     */
    public function delete_client_form()
    {
        if ( isset($_POST['delete_client']) ) 
        {

            $client_id = $_POST['client_delete_id'];

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_clients";
        // Making SQL query from table name of employer details
        $sql = "SELECT * FROM $table_name WHERE ID = '$client_id'";
        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {

            $client_id_to_delete                        = sanitize_text_field($print->ID);
            $client_delete_company_name                 = sanitize_text_field($print->client_company_name);
            $client_delete_client_fname                 = sanitize_text_field($print->client_first_name);
            $client_delete_client_lname                 = sanitize_text_field($print->client_last_name);
            $client_delete_client_tel                   = sanitize_text_field($print->client_tel_no);
            $client_delete_website_url                  = sanitize_text_field($print->client_website_link);
            $client_delete_email_address                = sanitize_text_field($print->client_email);
            $client_delete_client_physical_address      = sanitize_text_field($print->client_address);
        
        $delete_form = <<<HTML

                <div class="card card_width">
                <h5 class="card-title">Delete Client</h5>
                <div class="card border_left_notice_danger shadow h-100 py-2 mb-4">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase">
                                    <h6 class="company_settings_form_notice">You are about to delete the following client: 
                                        {$client_delete_client_fname} {$client_delete_client_lname}
                                    </h6>
                                </div>
                                <div class="text-xs font-weight-bold text-uppercase">
                                    <h6 class="company_settings_form_notice">You can update, by clicking on "Update" or delete the user by clicking on "Delete". Website link and physical address are optional.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <form method="POST" enctype="multipart/form-data" id="delete-clients" action="admin.php?page=sm-manage-clients">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="client_company_name" value="{$client_delete_company_name}" name="client_company_name" class="form-control" required />
                        <label class="form-label" for="client_company_name">Enter the client's company name:</label>
                    </div>
                    <br />
                
                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="client_first_name" value="{$client_delete_client_fname}" name="client_first_name" class="form-control" required />
                        <label class="form-label" for="client_first_name">Enter the client's first name:</label>
                    </div>
                    <br />

                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="client_last_name" value="{$client_delete_client_lname}" name="client_last_name" class="form-control" required />
                        <label class="form-label" for="client_last_name">Enter the client's last name:</label>
                    </div>
                    <br />

                    <div class="form-outline" data-mdb-input-init>
                        <input type="tel" id="client_tel_no" value="{$client_delete_client_tel}" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}" required name="client_tel_no" class="form-control" required />
                        <label class="form-label" for="client_tel_no">Enter your phone number - Format 555-5555-555:</label>
                    </div>
                    <br />

                    <div class="form-outline" data-mdb-input-init>
                        <input type="url" id="client_website_link" name="client_website_link" value="{$client_delete_website_url}" name="client_website_link" class="form-control" />
                        <label class="form-label" for="client_website_link">Enter the client's website link:</label>
                    </div>
                    <br />

                    <div class="form-outline" data-mdb-input-init>
                        <input type="email" id="client_email" name="client_email" value="{$client_delete_email_address}" name="client_email" class="form-control" required />
                        <label class="form-label" for="client_email">Enter the client's email address:</label>
                    </div>
                    <br />

                    <div class="form-outline" data-mdb-input-init>
                        <input type="text" id="client_address" name="client_address" value="{$client_delete_client_physical_address}" name="client_address" class="form-control"  />
                        <label class="form-label" for="client_address">Enter the client's address:</label>
                    </div>
                    <br />

                    <input type="hidden" name="client_id_from_update_page" value="{$client_id_to_delete}">

                    <input type="hidden" name="client_id_from_delete_page" value="{$client_id_to_delete}">
                    
                    <button type="submit" class="btn btn-primary" name="update_client_from_update_page" data-mdb-ripple-init>Update</button>

                    <button type="submit" class="btn btn-primary" name="delete_client_from_delete_page" data-mdb-ripple-init>Delete</button>
                </div>
                HTML;
        
            echo $delete_form;

            }
        }

        if (!isset($_POST['delete_client']))
        { ?>
            <script>
                window.history.back();
            </script>
        <?php
        
        }
    }
}
$delete_client = new Delete_Client();
$delete_client->delete_client_form();