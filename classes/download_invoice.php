<?php
namespace Service_Management\Classes;

use Dompdf\Dompdf;
class Download_Invoice
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
     * download_invoice_func
     *
     * @return void
     * 
     * Assembles the PDF & gets it ready for download
     */
    public function download_invoice_func()
    {
        if ( isset( $_POST['download_invoice']))
        {
            $quote_id = sanitize_text_field($_POST['quote_invoice_download_id']);
            $invoice_id = sanitize_text_field($_POST['invoice_download_id']);

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_quotes";
            $sql = "SELECT * FROM $table_name WHERE ID = '$quote_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) 
            {
                $predefined_tasks_json  = sanitize_text_field( $print->predefined_tasks );
                $quote_total            = sanitize_text_field( $print->quote_total );
                $currency               = sanitize_text_field( $print->currency );
                $client_quote_fname     = sanitize_text_field($print->client_quote_fname);
                $client_quote_lname     = sanitize_text_field($print->client_quote_lname);
                $client_company_name    = sanitize_text_field($print->client_company_name);

                set_transient('client_quote_fname_invoice_transient', $client_quote_fname, 2592000);
                set_transient('client_quote_lname_invoice_transient', $client_quote_lname, 2592000);
                set_transient('client_company_name_invoice_transient', $client_company_name, 2592000);
                set_transient('predefined_tasks_invoice_transient', $predefined_tasks_json, 2592000);
                set_transient('quote_total_invoice_transient', $quote_total, 2592000);
                set_transient('quote_invoice_currency_transient', $currency, 2592000);
                
            }

        $predefined_tasks_json = get_transient('predefined_tasks_invoice_transient');

        $predefined_tasks_in_quote = json_decode( $predefined_tasks_json );


        global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_invoices";

            $sql = "SELECT * FROM $table_name WHERE ID = '$invoice_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) 
            {
                $invoice_download_id                    = sanitize_text_field( $print-> ID );
                $invoice_total                          = sanitize_text_field( $print->invoice_total );
                $currency                               = sanitize_text_field( $print->currency );

                set_transient('invoice_download_id_transient', $invoice_download_id, 2592000);
                set_transient('invoice_total_transient', $invoice_total, 2592000);
                set_transient('invoice_download_currency_transient', $currency, 2592000);

            }

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_settings";
        $sql = "SELECT * FROM $table_name";

        $result = $wpdb->get_results($sql);
        foreach ($result as $print) 
        {
            $company_name               = sanitize_text_field( $print->company_name );
            $company_contact_name       = sanitize_text_field( $print->company_contact_name );
            $company_tel_no             = sanitize_text_field( $print->company_tel_no );
            $company_address            = sanitize_text_field( $print->company_address );
            $company_website            = sanitize_text_field( $print->company_website );
            $company_email              = sanitize_text_field( $print->company_email );
            $company_billing_details    = sanitize_text_field( $print->company_billing_details );
            $company_logo_url           = sanitize_text_field( $print->company_logo_url );
            $company_logo_filename      = sanitize_text_field( $print->company_logo_filename );

            $client_company_name        = get_transient('client_company_name_invoice_transient');
            $client_quote_fname         = get_transient('client_quote_fname_invoice_transient');
            $client_quote_lname         = get_transient('client_quote_lname_invoice_transient');
            $invoice_download_id        = get_transient('invoice_download_id_transient');
            $invoice_download_currency  = get_transient('invoice_download_currency_transient');
            $invoice_total              = get_transient('invoice_total_transient');

            $new_date = date('Y-d-m');
            $html = <<<HTML
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0; width: 100%;}
                .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:12px;
                overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:10px;
                font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
                .tg .tg-0lax{text-align:left;vertical-align:top}
            </style>
         
            <table class="tg">
                <thead>
                <tr>
                    <th class="tg-0lax">
                        <img src="{$company_logo_url}/{$company_logo_filename}" style="height:150px"; width="150px"; />
                    </th>
                    <th class="tg-0lax">
                        <h3>{$company_name}</h3>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="tg-0lax">Contact Person:</td>
                    <td class="tg-0lax">{$company_contact_name}</td>
                </tr>
                <tr>
                    <td class="tg-0lax">Contact Number:</td>
                    <td class="tg-0lax">{$company_tel_no}</td>
                </tr>
                <tr>
                    <td class="tg-0lax">Company Address:</td>
                    <td class="tg-0lax">{$company_address}</td>
                </tr>
                <tr>
                    <td class="tg-0lax">Website URL:</td>
                    <td class="tg-0lax">{$company_website}</td>
                </tr>
                <tr>
                    <td class="tg-0lax">Email:</td>
                    <td class="tg-0lax">{$company_email}</td>
                </tr>
                <tr>
                    <td class="tg-0lax">Client:</td>
                    <td class="tg-0lax">{$client_company_name}</td>
                </tr>
                <tr>
                    <td class="tg-0lax">Cient Contact Person:</td>
                    <td class="tg-0lax">{$client_quote_fname} {$client_quote_lname}</td>
                </tr>
                </tbody>
            </table>

            <div class="container" style="text-align: center">
                <div class="row">
                    <div class="col">
                        <h1>Invoice</h1>
                        <p>Date: {$new_date}</p>
                        <p>Invoice ID: {$invoice_download_id}</p>
                    </div>
                </div>
            </div>
            HTML;
            }

            $html .= <<<HTML

            <table class="tg">
            <thead>
            <tr>
                <th class="tg-0lax" style="width:10%;">QTY</th>
                <th class="tg-0lax" style="width:70%;">Description & Price</th>
                <th class="tg-0lax" style="width:20%;">Total Amount</th>
            </tr>
            </thead>
            <tbody>
            HTML;

            foreach ($predefined_tasks_in_quote as $task) 
                {
                    $html .=<<<HTML
                    <tr>
                    <td class="tg-0lax">1</td>
                    <td class="tg-0lax">{$task}</td>
                    <td class="tg-0lax"></td>
                    </tr>
                    HTML;
                }
            $html .= <<<HTML
                            
                    <tr>
                        <td class="tg-0lax"></td>
                        <td class="tg-0lax">
                            <strong>Total Amount</strong>
                        </td>
                        <td class="tg-0lax">{$invoice_download_currency} {$invoice_total}</td>
                    </tr>
                    
                    </tbody>
                    </table>
                    <h4>Banking Details: {$company_billing_details}</h4>

                    HTML;

            $dompdf = new Dompdf();
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->load_html($html);
            $dompdf->render();

            $output = $dompdf->output();
            $date = date('Y-m-d h:i:s');
            $filename = $date . '.pdf';
            $path = get_home_path();
            $file_storage_location = $path . 'wp-content/uploads/service_management/' . $filename;
            file_put_contents($file_storage_location, $output);

            $download_link = site_url() . '/wp-content/uploads/service_management/';

            echo '<a href="' . $download_link . $filename . '" download><button type="button" class="btn btn-info mt-4" data-mdb-ripple-init>Download Generated Invoice in PDF immediately otherwise it will be deleted from the server for security reasons.</button></a>';

        }
    }
}
$download_quote = new Download_Invoice();
$download_quote->download_invoice_func();