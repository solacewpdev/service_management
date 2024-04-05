<?php
namespace Service_Management\Classes;

class Clients_Management
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
     * read_object
     *
     * @return void
     */
    public function read_object()
    {
        if ( isset( $_POST['submit_clients_management'] ) ) 
        {
            $client_id = sanitize_text_field( $_POST['clients_management_id'] );

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_clients";
            // Making SQL query from table name of employer details
            $sql = "SELECT * FROM $table_name WHERE ID = '$client_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) {
                $client_id              = sanitize_text_field( $print->ID );
                $client_company_name    = sanitize_text_field( $print->client_company_name );
                $client_fname           = sanitize_text_field( $print->client_first_name );
                $client_lname           = sanitize_text_field( $print->client_last_name );

                $view_work = <<<HTML
            <h1 class="text-center mt-4 mb-4">{$client_company_name}</h1>
            <h4 class="text-center">{$client_fname} {$client_lname}</h4>
            <div class="container d-flex justify-content-center align-item-self">
                <div class="row">
                    <div class="col">
                        <form method="POST" enctype="multipart/form-data" id="clients-management" action="admin.php?page=sm-cm-search-quotes">
                            <button type="submit" class="btn btn-primary mt-4 " name="view_quotes" data-mdb-ripple-init>Quotes</button>
                            <input type="hidden" class="small-text" name="client_id" value="{$client_id}">
                        </form>
                    </div>
                    <div class="col">
                        <form method="POST" enctype="multipart/form-data" id="clients-management" action="admin.php?page=sm-cm-search-invoices">
                            <button type="submit" class="btn btn-primary mt-4 " name="view_invoices" data-mdb-ripple-init>Invoices</button>
                            <input type="hidden" class="small-text" name="client_id" value="{$client_id}">
                        </form>
                    </div>
                </div>
            </div>

            HTML;

                echo $view_work;

            }
        }

        if (!isset($_POST['submit_clients_management'])) { ?>
            <script>
                window.history.back();
            </script>
        <?php
        
        }
    }
}

$clients_management = new Clients_Management();
$clients_management->read_object();

