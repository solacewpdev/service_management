<?php
namespace Service_Management\Classes;


if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Manage_Quote
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';

    }

    use Trait_Card_Notices;

    public function get_quote_details()
    {
        if (
            isset($_POST['manage_quote']) ||
            isset($_POST['quote_accepted']) ||
            isset($_POST['go_back_to_manage_quotes']) ||
            isset($_POST['submit_creating_invoices'])
        ) {

            $quote_id = sanitize_text_field($_POST['edit_quote_id']);

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_quotes";
            $sql = "SELECT * FROM $table_name WHERE ID = '$quote_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) {
                $client_id = sanitize_text_field($print->client_id);
                $client_quote_fname = sanitize_text_field($print->client_quote_fname);
                $client_quote_lname = sanitize_text_field($print->client_quote_lname);
                $predefined_tasks = sanitize_text_field($print->predefined_tasks);
                $quote_total = sanitize_text_field($print->quote_total);
                $quote_accepted = sanitize_text_field($print->quote_accepted);
                $quote_currency = sanitize_text_field($print->currency);

                if ($predefined_tasks === '') {
                    $predefined_tasks_view = '';
                    // $quote_accepted = 'NO';
                } else {
                    $predefined_tasks_view = json_decode($predefined_tasks);
                    $predefined_tasks_view = implode('<br />', $predefined_tasks_view);
                    // $quote_accepted = 'NO';
                }



                // $user_details = <<<HTML
                echo '
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <br />
                        <h4>You are currently working with client:</h4><br />
                        <h5>First Name: ' . $client_quote_fname . '</h5>
                        <h5>Last Name: ' . $client_quote_lname . '</h5>
                        <h6>Quote ID: ' . $quote_id . '</h6><br />
                    </div> <!-- col 1 -->
                    <div class="col-md-6">
                    <br />    
                        <h4>Has this qoute been accepted?</h4>
                        <p>Invoices can only be generated once this quote has been accepted. Note that no further editing will be possible once the quote has been accepted.</p>
                        <div class="container-fluid no_padding">
                            <div class="row no_padding">
                                <div class="col">
                                    <form method="POST" enctype="multipart/form-data" id="edit-quote" action="admin.php?page=sm-accepting-quotes-screen1">
                                    <input type="hidden" class="small-text" name="edit_quote_id" value="' . $quote_id . '">';
                if ($quote_accepted != 'NO') { ?>
                    <?php echo '<button type="submit" name="submit_to_quote_accepted_yes_screen1" class="btn btn-success text-left" data-mdb-ripple-init disabled>Yes</button>';
                } else {
                    echo '<button type="submit" name="submit_to_quote_accepted_yes_screen1" class="btn btn-success text-left" data-mdb-ripple-init >Yes</button>';
                }
                echo '</form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- col 2 -->
                </div> <!-- row -->
            </div> <!-- container-fluid -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Quote Details:</h6>
                        <h6> ' . $predefined_tasks_view . '</h6><br />
                        <h6>
                            <strong>Total: ' . $quote_currency . ' ' . $quote_total . '</strong>
                        </h6>
                        <form method="POST" enctype="multipart/form-data" id="edit-quote" action="admin.php?page=sm-edit-quote-screen1">
                        <input type="hidden" class="small-text" name="client_id" value="' . $client_id . '">
                        <input type="hidden" class="small-text" name="edit_quote_id" value="' . $quote_id . '">';
                if ($quote_accepted != 'NO') { ?>
                    <?php echo '<button type="submit" class="btn btn-primary" name="submit_to_edit_quote_screen1" data-mdb-ripple-init disabled>Edit Quote</button>';
                } else {
                    echo '<button type="submit" class="btn btn-primary" name="submit_to_edit_quote_screen1" data-mdb-ripple-init >Edit Quote</button>';
                }
                echo '</form>';
                echo '
                    </div> <!-- col 3 -->
                    <div class="col-md-6">
                        <h4>Create ready invoice(s) from this quote.</h4>
                        <p>Create all the invoices with one click for this quote that can be downloaded at the right date and be emailed. It depends on the payment terms how many invoices will be made ready for download.</p>
                        <form method="POST" enctype="multipart/form-data" id="edit-quote" action="admin.php?page=sm-create-invoices-screen1">
                            <input type="hidden" class="small-text" name="edit_quote_id" value="' . $quote_id . '">';
                if ($quote_accepted != 'NO') { ?>
                    <?php echo '<button type="submit" name="create_invoices" class="btn btn-info" data-mdb-ripple-init >Create Invoices</button>';
                } else {
                    echo '<button type="submit" name="create_invoices" class="btn btn-info" data-mdb-ripple-init disabled>Create Invoices</button>';
                    echo '
                        </form>
                    </div> <!-- col 4 -->
                </div> <!-- row -->
            </div> <!-- container-fluid -->'; ?>
                <?php
                }
            }
        }


    }

    public function quote_accepted()
    {
        if (isset($_POST['quote_accepted'])) {
            $quote_id = sanitize_text_field($_POST['edit_quote_id']);
            // $edit_quote_id = $quote_id;

            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_quotes";
            $data_update = array(

                'quote_accepted' => 'YES',

            );
            $data_where = array('ID' => $quote_id);
            $wpdb->update($table_name, $data_update, $data_where);

            ?>

            <script>
                alert('Your quote has now been marked as accepted. You can generate invoices now, but no further editing of this quote is possible.');
            </script>

            <?php
        }

    }

    public function save_invoices()
    {
        if (isset($_POST['submit_creating_invoices'])) {

            $quote_id = sanitize_text_field($_POST['edit_quote_id']);

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_quotes";
            $sql = "SELECT * FROM $table_name WHERE ID = '$quote_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) {
                $client_to_quote_id     = sanitize_text_field($print->client_id);
                $client_company_name    = sanitize_text_field($print->client_company_name);
                $client_quote_fname     = sanitize_text_field($print->client_quote_fname);
                $client_quote_lname     = sanitize_text_field($print->client_quote_lname);
                $predefined_tasks       = sanitize_text_field($print->predefined_tasks);
                $quote_total            = sanitize_text_field($print->quote_total);
                $invoice_budget         = sanitize_text_field($print->budget);
                $quote_accepted         = sanitize_text_field($print->quote_accepted);
                $invoice_1              = sanitize_text_field($print->invoice_1);
                $invoice_2              = sanitize_text_field($print->invoice_2);
                $invoice_3              = sanitize_text_field($print->invoice_3);
                $quote_currency         = sanitize_text_field($print->currency);

                $payment = array();
                $payment = explode('-', $invoice_budget);

                if ($invoice_1 !== 0 && $invoice_2 === 0 && $invoice_3 === 0) {

                    $invoice_total1 = $quote_total * $payment['0'] / 100;

                    global $wpdb;
                    $table_name = $wpdb->prefix . "service_management_invoices";
                    $wpdb->insert(
                        $table_name,
                        array(
                            'ID'                    => $invoice_1,
                            'client_id'             => $client_to_quote_id,
                            'quote_id'              => $quote_id,
                            'client_company_name'   => $client_company_name,
                            'client_quote_fname'    => $client_quote_fname,
                            'client_quote_lname'    => $client_quote_lname,
                            'predefined_tasks'      => $predefined_tasks,
                            'invoice_total'         => $quote_total,
                            'invoice_paid'          => 'NO',
                            'budget'                => $invoice_budget,
                            'currency'              => $quote_currency
                        ),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s'

                        )
                    );
                    ?>

                    <script>
                        alert('Invoice(s) has been saved.');
                    </script>

                    <?php

                    exit();

                } elseif ($invoice_1 !== 0 && $invoice_2 !== 0 && $invoice_3 === 0) {

                    $invoice_total1 = $quote_total * $payment['0'] / 100;

                    global $wpdb;
                    $table_name = $wpdb->prefix . "service_management_invoices";
                    $wpdb->insert(
                        $table_name,
                        array(
                            'ID' => $invoice_1,
                            'client_id' => $client_to_quote_id,
                            'quote_id' => $quote_id,
                            'client_company_name' => $client_company_name,
                            'client_quote_fname' => $client_quote_fname,
                            'client_quote_lname' => $client_quote_lname,
                            'predefined_tasks' => $predefined_tasks,
                            'invoice_total' => $invoice_total1,
                            'invoice_paid' => 'NO',
                            'budget' => $invoice_budget,
                            'currency' => $quote_currency
                        ),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                        )
                    );

                    if (!empty($payment['1'])) {
                        $invoice_total2 = $quote_total * $payment['1'] / 100;
                    } else {
                        exit();
                    }

                    global $wpdb;
                    $table_name = $wpdb->prefix . "service_management_invoices";
                    $wpdb->insert(
                        $table_name,
                        array(
                            'ID' => $invoice_2,
                            'client_id' => $client_to_quote_id,
                            'quote_id' => $quote_id,
                            'client_company_name' => $client_company_name,
                            'client_quote_fname' => $client_quote_fname,
                            'client_quote_lname' => $client_quote_lname,
                            'predefined_tasks' => $predefined_tasks,
                            'invoice_total' => $invoice_total2,
                            'invoice_paid' => 'NO',
                            'budget' => $invoice_budget,
                            'currency' => $quote_currency
                        ),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                        )
                    );
                    ?>

                    <script>
                        alert('Invoice(s) has been saved.');
                    </script>

                    <?php

                    exit();

                } elseif ($invoice_1 !== 0 && $invoice_2 !== 0 && $invoice_3 !== 0) {

                    $invoice_total1 = $quote_total * $payment['0'] / 100;

                    global $wpdb;
                    $table_name = $wpdb->prefix . "service_management_invoices";
                    $wpdb->insert(
                        $table_name,
                        array(
                            'ID' => $invoice_1,
                            'client_id' => $client_to_quote_id,
                            'quote_id' => $quote_id,
                            'client_company_name' => $client_company_name,
                            'client_quote_fname' => $client_quote_fname,
                            'client_quote_lname' => $client_quote_lname,
                            'predefined_tasks' => $predefined_tasks,
                            'invoice_total' => $invoice_total1,
                            'invoice_paid' => 'NO',
                            'budget' => $invoice_budget,
                            'currency' => $quote_currency
                        ),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                        )
                    );

                    if (!empty($payment['1'])) {
                        $invoice_total2 = $quote_total * $payment['1'] / 100;
                    } else {
                        exit();
                    }

                    global $wpdb;
                    $table_name = $wpdb->prefix . "service_management_invoices";
                    $wpdb->insert(
                        $table_name,
                        array(
                            'ID'                    => $invoice_2,
                            'client_id'             => $client_to_quote_id,
                            'quote_id'              => $quote_id,
                            'client_company_name'   => $client_company_name,
                            'client_quote_fname'    => $client_quote_fname,
                            'client_quote_lname'    => $client_quote_lname,
                            'predefined_tasks'      => $predefined_tasks,
                            'invoice_total'         => $invoice_total2,
                            'invoice_paid'          => 'NO',
                            'budget'                => $invoice_budget,
                            'currency'              => $quote_currency
                        ),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                        )
                    );

                    if (!empty($payment['2'])) {
                        $invoice_total3 = $quote_total * $payment['2'] / 100;
                    } else {
                        exit();
                    }

                    global $wpdb;
                    $table_name = $wpdb->prefix . "service_management_invoices";
                    $wpdb->insert(
                        $table_name,
                        array(
                            'ID'                    => $invoice_3,
                            'client_id'             => $client_to_quote_id,
                            'quote_id'              => $quote_id,
                            'client_company_name'   => $client_company_name,
                            'client_quote_fname'    => $client_quote_fname,
                            'client_quote_lname'    => $client_quote_lname,
                            'predefined_tasks'      => $predefined_tasks,
                            'invoice_total'         => $invoice_total3,
                            'invoice_paid'          => 'NO',
                            'budget'                => $invoice_budget,
                            'currency'              => $quote_currency
                        ),
                        array(
                            '%d',
                            '%d',
                            '%d',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s',
                            '%s'
                        )
                    );
                }
            }

            ?>

            <script>
                alert('Invoice(s) has been saved.');
            </script>

            <?php

            exit();

        }

        if (
            !isset($_POST['manage_quote']) &&
            !isset($_POST['quote_accepted']) &&
            !isset($_POST['go_back_to_manage_quotes']) &&
            !isset($_POST['submit_creating_invoices'])
        ) { ?>

            <script>
                window.history.back();
            </script>

        <?php
        }

    }
}

$manage_quote = new Manage_Quote();

$message1 = 'On this page you can select how to manage your quotes and create invoices from them.';
$message2 = 'Edit quotes/accept quotes/create invoices from your quotes.';
$card_border_color = 'border_left_notice_warning';
$manage_quote->trait_card_notices($message1, $message2, $card_border_color);

$manage_quote->quote_accepted();
$manage_quote->get_quote_details();
$manage_quote->save_invoices();