<?php
namespace Service_Management\Classes;

class Search_Invoice
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

    use Trait_Create_Button;
        
    /**
     * read_object
     *
     * @return void
     * 
     * Displaying all the invoices to search in a datatable
     */
    public function read_object()
    {

        echo '<div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <h1>Search All Invoices</h1>
                            <table id="show_invoices" class="display">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Quote ID</th>
                                        <th>Client ID</th>
                                        <th>Company Name</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th class="quote-tr-width">Predefined Tasks</th>
                                        <th>Invoice Total</th>
                                        <th>Download Invoice</th>
                                        <th>Delete Invoice</th>
                                        <th>Manage</th>
                                        <th>Paid Yet?</th>
                                    </tr>
                                </thead>
                                <tbody>';

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_invoices";
        $sql = "SELECT * FROM $table_name";

        $result = $wpdb->get_results($sql);
        foreach ($result as $print) 
        {
            $invoice_id             = sanitize_text_field( $print->ID );
            $quote_id               = sanitize_text_field( $print->quote_id );
            $client_id              = sanitize_text_field( $print->client_id );
            $currency               = sanitize_text_field( $print->currency );
            $client_company_name    = sanitize_text_field( $print->client_company_name );
            $client_quote_fname     = sanitize_text_field( $print->client_quote_fname );
            $client_quote_lname     = sanitize_text_field( $print->client_quote_lname );
            $predefined_tasks_json  = sanitize_text_field( $print->predefined_tasks );
            $invoice_total          = sanitize_text_field( $print->invoice_total );
            $invoice_paid           = sanitize_text_field( $print->invoice_paid );

            // $invoice_id = set_transient('search_invoice_id_transient', $invoice_id, 2592000);

            $predefined_tasks = json_decode($predefined_tasks_json);
            // $predefined_tasks = explode(", ", $predefined_tasks);
            $predefined_tasks = implode('<br /> ', $predefined_tasks);
            echo '<!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="client_id'.$client_id.'" tabindex="-1" aria-labelledby="client_id'.$client_id.'ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="client_id'.$client_id.'ModalLabel">Predefined Tasks</h5>
                    <button type="button" class="btn-close" data-mdb-ripple-init data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">' . $predefined_tasks . '</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-ripple-init data-mdb-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
            <tr>
                    <td>' .  $invoice_id . '</td>
                    <td>' . $quote_id . '</td>
                    <td>' . $client_id . '</td>
                    <td>' . $client_company_name . '</td>
                    <td>' . $client_quote_fname . '</td>
                    <td>' . $client_quote_lname . '</td>
                    <td>' . '<button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#client_id' . $client_id . '">
                            View Predefined Tasks
                            </button>
                    </td>
                    <td>' . $currency . ' ' . $invoice_total . '</td>
                    <td class="td_adjuster">
                        <form method="POST" enctype="multipart/form-data" id="download-invoice" action="admin.php?page=sm-download-invoice">
                        <button type="submit" class="btn btn-primary" name="download_invoice" data-mdb-ripple-init>Download</button>
                        <input type="hidden" class="small-text" name="invoice_download_id" value="' .  $invoice_id . '">
                        <input type="hidden" class="small-text" name="quote_invoice_download_id" value="' . $quote_id . '">
                        </form>
                    </td>
                    <td class="td_adjuster">
                        <form method="POST" enctype="multipart/form-data" id="delete-invoices" action="admin.php?page=sm-delete-invoices">
                        <button type="submit" class="btn btn-primary" name="delete-invoice" data-mdb-ripple-init>Delete</button>
                        <input type="hidden" class="small-text" name="invoice_delete_id" value="' .  $invoice_id . '">
                        </form>
                    </td>
                    <td class="td_adjuster">
                        <form method="POST" enctype="multipart/form-data" id="manage-invoices" action="admin.php?page=sm-manage-invoices">
                        <button type="submit" class="btn btn-info" name="manage_invoice" data-mdb-ripple-init>Manage</button>
                        <input type="hidden" class="small-text" name="manage_invoice_id" value="' .  $invoice_id . '">
                        </form>
                    </td>';
                    if ( $invoice_paid === 'NO' ) { ?>
                        <td class="not-paid-yet">
                        <?php echo  $invoice_paid ?>
                         </td>
                <?php   } else { ?>
                            <td class="paid">
                        <?php echo  $invoice_paid ?>
                         </td>
                 <?php  }
                    
               echo '</tr>
               </div>
            </div>
        </div>';

        } ?>

        </tbody>
        </table>
    <?php
    }
    
    /**
     * invoice_paid
     *
     * @return void
     * 
     * Accept if invoice has been paid
     */
    public function invoice_paid()
    {
        if ( isset ($_POST['submit_invoice_paid'] ) )
        {
            // $invoice_id = $_POST['manage_invoice_id'];
            $invoice_id = get_transient('search_invoice_id_transient');

            $new_date = date('Y-m');

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_invoices";
            $data_update = array(

                'invoice_paid' => 'YES',
                'date_paid' => $new_date

            );
        $data_where = array('ID' => $invoice_id );
            $wpdb->update( $table_name, $data_update, $data_where );

            echo "<meta http-equiv='refresh' content='0'>";
        
        }

        
    }
    
    /**
     * delete_invoice
     *
     * @return void
     */
    public function delete_invoice()
    {
        if ( isset ($_POST['submit_invoice_delete'] ) ) 
        {

            $invoice_id = get_transient('search_invoice_id_transient');

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_invoices";

            $wpdb->delete( $table_name, array('ID' => $invoice_id ) );

            echo "<meta http-equiv='refresh' content='0'>";
        
        }
    }
}

$search_invoices = new Search_Invoice();

$button_id      = "create_invoice_on_invoice_quote";
$action_page    = "admin.php?page=sm-search-quotes";
$button_name    = "create_invoice_on_invoice_quote";
$button_value   = "Create Invoice";
$search_invoices->create_button($button_id, $action_page, $button_name, $button_value);
$search_invoices->read_object();
$search_invoices->invoice_paid();
$search_invoices->delete_invoice();

