<?php
namespace Service_Management\Classes;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Company_Settings
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';

    }


    public function save_form_details_backend()
    {
        if (isset($_POST['submit_company_settings'])) 
        {
            // Assigning sessions to post form variables
            $company_name = sanitize_text_field($_POST['company_name']);
            $company_contact_name = sanitize_text_field($_POST['company_contact_name']);
            $company_tel_no = sanitize_text_field($_POST['company_tel_no']);
            $company_address = sanitize_text_field($_POST['company_address']);
            $company_website = sanitize_text_field($_POST['company_website']);
            $company_email = sanitize_text_field($_POST['company_email']);
            $company_billing_details = sanitize_text_field($_POST['company_billing_details']);

            // Creating a path for thte plugin in uploads directory
            $directory_name = $company_name . "-" . $company_contact_name . rand();

            $path = get_home_path();
            $logo_upload_path = $path . 'wp-content/uploads/service_management/';

            mkdir($logo_upload_path . $directory_name, 0755, true);
            $logo_full_path = $logo_upload_path . $directory_name;

            // Moving the company logo to uploads file directory
            if (is_array($_FILES)) {
                if (is_uploaded_file($_FILES['company_logo']['tmp_name'])) {
                    if (move_uploaded_file($_FILES['company_logo']['tmp_name'], "$logo_full_path/" . $_FILES['company_logo']['name'])) {
                    }
                }
            }

            $company_logo_filename = $_FILES['company_logo']['name'];
            $company_logo_url = site_url() . '/wp-content/uploads/service_management/' . $directory_name;
            $updated_at = date('m/d/Y h:i:s a', time());

            global $wpdb;

            // Updating company settings in custom DB table
            $table_name = $wpdb->prefix . "service_management_settings";
            $data_update = array(
                'company_name'              => $company_name,
                'company_contact_name'      => $company_contact_name,
                'company_tel_no'            => $company_tel_no,
                'company_address'           => $company_address,
                'company_website'           => $company_website,
                'company_email'             => $company_email,
                'company_billing_details'   => $company_billing_details,
                'company_logo_url'          => $company_logo_url,
                'company_logo_filename'     => $company_logo_filename,
                'updated_at'                => $updated_at,
            );
            $data_where = array('ID' => '1');
            $wpdb->update($table_name, $data_update, $data_where);

        }
    }

    public function show_form_with_values()
    {

        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_settings";
        $sql = "SELECT * FROM $table_name";

        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {
            $company_name               = sanitize_text_field($print->company_name);
            $company_contact_name       = sanitize_text_field($print->company_contact_name);
            $company_tel_no             = sanitize_text_field($print->company_tel_no);
            $company_address            = sanitize_text_field($print->company_address);
            $company_website            = sanitize_text_field($print->company_website);
            $company_email              = sanitize_text_field($print->company_email);
            $company_billing_details    = sanitize_text_field($print->company_billing_details);
            $company_logo_url           = sanitize_text_field($print->company_logo_url);
            $company_logo_filename      = sanitize_text_field($print->company_logo_filename);

            ?>
            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Content Row -->
                            <div class="row">

                                <div id="content-wrapper" class="d-flex flex-column container-fluid">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 mt-4 text-gray-800">Company Settings</h1>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h4 class="h3 mb-0 text-gray-800">Fill in all your company's settings here to be put on quotes and invoices.</h4>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="h6 mb-0 company_settings_form_notice">All Fields Are Required</h6>
                                    </div>
                                    <!-- Main Content -->
                                    <div id="content" class="mb-4">
                                        <form method="POST" enctype="multipart/form-data" id="company-settings" action="">
                                            <!-- Company Name -->


                                            <div class="form-outline mb-4" data-mdb-input-init>
                                                <input type="text" id="company_name" name="company_name" value="<?php
                                                // If the session is set and has an value, it will display, otherwise it will be blank
                                                if (isset($company_name)) {
                                                    echo $company_name;
                                                } else {
                                                    echo $company_name = '';
                                                }
                                                ?>" class="form-control" required />
                                                <label class="form-label" for="company_name">Company Name</label>
                                            </div>

                                            <div class="form-outline mb-4" data-mdb-input-init>
                                                <input type="text" id="company_contact_name" name="company_contact_name" value="<?php
                                                // If the session is set and has an value, it will display, otherwise it will be blank
                                                if (isset($company_contact_name)) {
                                                    echo $company_contact_name;
                                                } else {
                                                    echo $company_contact_name = '';
                                                }
                                                ?>" class="form-control" required />
                                                <label class="form-label" for="company_contact_name">Enter the company contact
                                                    person's name:</label>
                                            </div>

                                            <div class="form-outline mb-4" data-mdb-input-init>
                                                <input type="tel" id="company_tel_no" name="company_tel_no"
                                                    pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}" value="<?php
                                                    // If the session is set and has an value, it will display, otherwise it will be blank
                                                    if (isset($company_tel_no)) {

                                                        echo $company_tel_no;
                                                    } else {

                                                        echo $company_tel_no = '';
                                                    }
                                                    ?>" class="form-control" required />
                                                <label class="form-label" for="company_tel_no">Enter your phone number - Format
                                                    555-5555-555</label>
                                            </div>

                                            <div class="form-outline mb-4" data-mdb-input-init>
                                                <input type="text" id="company_website" name="company_website" value="<?php
                                                // If the session is set and has an value, it will display, otherwise it will be blank
                                                if (isset($company_website)) {

                                                    echo $company_website;
                                                } else {
                                                    echo $company_website = '';
                                                }
                                                ?>" class="form-control" required />
                                                <label class="form-label" for="company_website">Enter your company website
                                                    link:</label>
                                            </div>

                                            <div class="form-outline mb-4" data-mdb-input-init>
                                                <input type="text" id="company_email" name="company_email" value="<?php
                                                // If the session is set and has an value, it will display, otherwise it will be blank
                                                if (isset($company_email)) {

                                                    echo $company_email;
                                                } else {
                                                    echo $company_email = '';
                                                }
                                                ?>" class="form-control" required />
                                                <label class="form-label" for="company_email">Enter your company email
                                                    address:</label>
                                            </div>

                                            <div class="form-outline mb-4" data-mdb-input-init>
                                                <input type="text" id="company_address" name="company_address" value="<?php
                                                // If the session is set and has an value, it will display, otherwise it will be blank
                                                if (isset($company_address)) {

                                                    echo $company_address;
                                                } else {

                                                    echo $company_address = '';
                                                }
                                                ?>" class="form-control" required />
                                                <label class="form-label" for="company_address">Enter your company address:</label>
                                            </div>
                                            <div class="form-outline mb-4" data-mdb-input-init>
                                                <input type="text" id="company_billing_details" name="company_billing_details"
                                                    value="<?php
                                                    // If the session is set and has an value, it will display, otherwise it will be blank
                                                    if (isset($company_billing_details)) {

                                                        echo $company_billing_details;
                                                    } else {

                                                        echo $company_billing_details = '';
                                                    }
                                                    ?>" class="form-control" required />
                                                <label class="form-label" for="company_billing_details">Enter your company billing
                                                    details:</label>
                                            </div>
                                            <h5>Current Logo:</h5>
                                            <img class="mb-4" src="<?php echo $company_logo_url . '/' . $company_logo_filename; ?> "
                                                height="150px" width="150px;" />
                                            <h6> Select a company logo (150px x 150px)</h6>
                                            <input type="file" id="company_logo" name="company_logo" required><br /><br />
                                            <button type="submit" class="btn btn-success" name="submit_company_settings"
                                                data-mdb-ripple-init>Submit</button>
                                        </form>

                                    </div> <!-- Main Form Content wrapper -->

                                </div> <!-- Content Wrapper -->

                            </div> <!-- Row -->

                        </div> <!-- End of Container Fluid -->

                    </div> <!-- Content -->

                </div> <!-- Main Content Wrapper -->

            </div> <!-- Main Wrapper -->
            <?php
        }
    }
}

$company_settiings = new Company_Settings();
$company_settiings->save_form_details_backend();
$company_settiings->show_form_with_values();