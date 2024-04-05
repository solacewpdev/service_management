<?php 

namespace Service_Management\Classes;

class Creating_Invoices_Screen1
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
     * creating_invoices
     *
     * @return void
     */
    public function creating_invoices()
    { 

        if ( isset($_POST['create_invoices']) ) 
        {

            $accepting_quote_id = sanitize_text_field( $_POST['edit_quote_id'] );

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_quotes";
        // Making SQL query from table name of employer details
        $sql = "SELECT * FROM $table_name WHERE ID = '$accepting_quote_id'";
        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {
            $company_name       = sanitize_text_field( $print->client_company_name );
            $client_quote_fname = sanitize_text_field( $print->client_quote_fname );
            $client_quote_lname = sanitize_text_field( $print->client_quote_lname );
            
        

        $update_task_form = <<<HTML

            <div class="card card_width">
            <h5 class="card-title">Accepting Quote</h5>
            <div class="card border_left_notice_danger shadow h-100 py-2 mb-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase">
                                <h6 class="company_settings_form_notice">You are about to create an invoice(s): <br /><br />
                                    {$company_name} - {$client_quote_fname} {$client_quote_lname}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form method="POST" enctype="multipart/form-data" id="accepted_quote" action="admin.php?page=sm-manage-quote">
                        <input type="hidden" id="creating_invoices" value="{$accepting_quote_id}" name="edit_quote_id" class="form-control mb-4" />
                        <button type="submit" name="submit_creating_invoices"class="btn btn-primary" data-mdb-ripple-init>Create Invoice(s)</button>
                        </form>
                    </div>
                    <div class="col">
                        <form method="POST" enctype="multipart/form-data" id="go_back" action="admin.php?page=sm-manage-quote">
                        <input type="hidden" id="go_back_to_manage_quotes" value="{$accepting_quote_id}" name="edit_quote_id" class="form-control mb-4" />
                        <button type="submit" name="go_back_to_manage_quotes" class="btn btn-info" data-mdb-ripple-init>Go Back</button>
                        </form>
                    </div>
                </div>
            </div>
            
            HTML;
        
            echo $update_task_form;

            }
        }

        if (!isset($_POST['create_invoices']))
        { ?>
             <script>
                window.history.back();
            </script>
<?php   }
    }
}

$update_predefined_task = new Creating_Invoices_Screen1();
$update_predefined_task->creating_invoices();
