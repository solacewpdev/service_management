<?php
namespace Service_Management\Classes;

use Dompdf\Dompdf;

class Download_Quote
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
     * download_quote_func
     *
     * @return void
     * 
     * Prepared Quote PDF for download uisng DomPDF library
     */
    public function download_quote_func()
    {
        if ( isset( $_POST['download_quote']))
        {
            $quote_id = sanitize_text_field($_POST['quote_download_id']);

            $client_quote_fname_download_step1 = $_POST['client_quote_fname_download_step1'];
            set_transient('client_quote_fname_download_step1_transient', $client_quote_fname_download_step1, 2592000);

            $client_quote_lname_download_step1 = $_POST['client_quote_lname_download_step1'];
            set_transient('client_quote_lname_download_step1_transient', $client_quote_lname_download_step1, 2592000);

            $client_quote_company_name_download_step1   = $_POST['client_quote_company_name_download_step1'];
            set_transient('client_quote_company_name_download_step1_transient', $client_quote_company_name_download_step1, 2592000);

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_quotes";

            $sql = "SELECT * FROM $table_name WHERE ID = '$quote_id'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) 
            {
                $quote_download_id          = sanitize_text_field( $print->ID ); 
                $predefined_tasks_json      = sanitize_text_field( $print->predefined_tasks );
                $quote_total                = sanitize_text_field( $print->quote_total );
                $currency                   = sanitize_text_field( $print->currency );

                set_transient('quote_download_id_transient', $quote_download_id, 2592000);
                set_transient('predefined_tasks_json_transient', $predefined_tasks_json, 2592000);
                set_transient('quote_total_transient', $quote_total, 2592000);
                set_transient('currency_transient', $currency, 2592000);

            }

        }

        $predefined_tasks_json = get_transient('predefined_tasks_json_transient');
        $predefined_tasks_in_quote = json_decode($predefined_tasks_json );

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
            // $currency                   = sanitize_text_field($print->currency);

            $quote_download_id_transient = get_transient('quote_download_id_transient');
            $client_quote_company_name_download_step1_transient = get_transient('client_quote_company_name_download_step1_transient');
            $client_quote_fname_download_step1_transient = get_transient('client_quote_fname_download_step1_transient');
            $client_quote_lname_download_step1_transient = get_transient('client_quote_lname_download_step1_transient');

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
                    <td class="tg-0lax">{$client_quote_company_name_download_step1_transient}</td>
                </tr>
                <tr>
                    <td class="tg-0lax">Cient Contact Person:</td>
                    <td class="tg-0lax">{$client_quote_fname_download_step1_transient} {$client_quote_lname_download_step1_transient}</td>
                </tr>
                </tbody>
            </table>

            <div class="container" style="text-align: center">
                <div class="row">
                    <div class="col">
                        <h1>Quotation</h1>
                        <p>Date: {$new_date}</p>
                        <p>Quote ID: {$quote_download_id_transient}</p>
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

                $currency_transient = get_transient('currency_transient');
                $quote_total_transient = get_transient('quote_total_transient');

            $html .= <<<HTML
                            
                    <tr>
                        <td class="tg-0lax"></td>
                        <td class="tg-0lax">
                            <strong>Total Amount</strong>
                        </td>
                        <td class="tg-0lax">{$currency_transient} {$quote_total_transient}</td>
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

            echo '<a href="' . $download_link . $filename . '" download><button type="button" class="btn btn-info mt-4" data-mdb-ripple-init>Download Generated Quote in PDF immediately otherwise it will be deleted from the server for security reasons.</button></a>';

        }
    }
    
$download_quote = new Download_Quote();
$download_quote->download_quote_func();