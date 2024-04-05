<?php
namespace Service_Management\Classes;

class Client_Management_Search_Quotes
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
     */
    public function read_object() 
    {
        
        if (isset($_POST['view_quotes'])) 
        {
            $cm_search_quote_client_id = $_POST['client_id'];
            set_transient('client_id_management_transient', $cm_search_quote_client_id, 2592000);
            $cm_search_quote_client_id_transient = get_transient('client_id_management_transient');
        }

            $cm_search_quote_client_id_transient = get_transient('client_id_management_transient');
        echo '<div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h1>Search Quotes By Client</h1>
                        <table id="show_quotes" class="display">
                            <thead>
                                <tr>
                                    <th>Quote ID</th>
                                    <th>Client ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th class="quote-tr-width">Predefined Tasks</th>
                                    <th>Quote Total</th>
                                    <th>Download Quote</th>
                                    <th>Delete Quote</th>
                                    <th>Manage Quote</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>';
        
        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_quotes";
        // Making SQL query from table name of employer details
        $sql = "SELECT * FROM $table_name WHERE client_id = '$cm_search_quote_client_id_transient'";

        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {
            $quote_id                   = sanitize_text_field( $print->ID );
            $client_id                  = sanitize_text_field( $print->client_id );
            $client_company_name        = sanitize_text_field( $print->client_company_name );
            $client_quote_fname         = sanitize_text_field( $print->client_quote_fname );
            $client_quote_lname         = sanitize_text_field( $print->client_quote_lname );
            $predefined_tasks_json      = sanitize_text_field( $print->predefined_tasks );
            $quote_total                = sanitize_text_field( $print->quote_total );
            $currency                   = sanitize_text_field( $print->currency );

            $predefined_tasks = json_decode($predefined_tasks_json);
            $predefined_tasks = implode('<br /> ',$predefined_tasks);

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
                        <td>' . $quote_id . '</td>
                        <td>' . $client_id . '</td>
                        <td>'. $client_quote_fname . '</td>
                        <td>'. $client_quote_lname . '</td>
                        <td>' . '<button type="button" class="btn btn-primary" data-mdb-ripple-init data-mdb-modal-init data-mdb-target="#client_id' . $client_id . '">
                                View Predefined Tasks
                                </button>
                        </td>
                        <td>'. $currency . ' ' . $quote_total .'</td>
                        <td class="td_adjuster">
                            <form method="POST" enctype="multipart/form-data" id="download-quote" action="admin.php?page=sm-download-quote">
                            <button type="submit" class="btn btn-primary" name="download_quote" data-mdb-ripple-init>Download</button>
                            <input type="hidden" class="small-text" name="quote_download_id" value="' . $quote_id . '">
                            <input type="hidden" class="small-text" name="client_quote_company_name_download_step1" value="' . $client_company_name . '">
                            <input type="hidden" class="small-text" name="client_quote_fname_download_step1" value="' . $client_quote_fname . '">
                            <input type="hidden" class="small-text" name="client_quote_lname_download_step1" value="' . $client_quote_lname . '">
                            </form>
                        </td>
                        <td class="td_adjuster">
                            <form method="POST" enctype="multipart/form-data" id="update-clients" action="admin.php?page=sm-delete-quote">
                            <button type="submit" class="btn btn-primary" name="delete_quote" data-mdb-ripple-init>Delete</button>
                            <input type="hidden" class="small-text" name="quote_delete_id" value="' . $quote_id . '">
                            <input type="hidden" class="small-text" name="client_quote_fname_delete_step1" value="' . $client_quote_fname . '">
                            <input type="hidden" class="small-text" name="client_quote_lname_delete_step1" value="' . $client_quote_lname . '">
                            <input type="hidden" class="small-text" name="quote_total_delete_step1" value="' . $quote_total . '">
                            </form>
                        </td>
                        <td class="td_adjuster">
                            <form method="POST" enctype="multipart/form-data" id="manage_quote" action="admin.php?page=sm-manage-quote">
                            <button type="submit" class="btn btn-info" name="manage_quote" data-mdb-ripple-init>Manage</button>

                            <input type="hidden" class="small-text" name="edit_quote_id" value="' . $quote_id . '">
                            <input type="hidden" class="small-text" name="client_quote_fname_manage_step1" value="' . $client_quote_fname . '">
                            <input type="hidden" class="small-text" name="client_quote_lname_manage_step1" value="' . $client_quote_lname . '">
                            <input type="hidden" class="small-text" name="quote_total_manage_step1" value="' . $quote_total . '">
                            </form>
                        </td>
                    </tr>
                    </div>
                </div>
            </div>';

        } ?>

        </tbody>
    </table>
    <?php    
    }
}

$search_quotes = new Client_Management_Search_Quotes();

$button_id      = "create_quote_on_search_quote";
$action_page    = "admin.php?page=sm-create-quote-screen1";
$button_name    = "create_quote_on_search_quote";
$button_value   = "Create Quote";
$search_quotes->create_button($button_id, $action_page, $button_name, $button_value);

$search_quotes->read_object();
