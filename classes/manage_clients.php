<?php
namespace Service_Management\Classes;
// use CRUD_Objects;
// use Interface_CRUD_Objects;
class Manage_Clients implements Interface_CRUD_Objects
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';    
    }

    /**
     * Adds an "Add Client" btn to the Manage Clients Portal.
     */
    use Trait_Create_Button;

    /**
     * Adds a new client to the backend
     */
    public function create_object()
    {
        if (isset($_POST['submit_add_client'])) {

            $post_client_first_name = sanitize_text_field($_POST['client_first_name']);
            $post_client_last_name  = sanitize_text_field($_POST['client_last_name']);
            $post_client_tel_no     = sanitize_text_field($_POST['client_tel_no']);

            set_transient('post_client_first_name_transient', $post_client_first_name, 2592000);
            set_transient('post_client_last_name_transient', $post_client_last_name, 2592000);
            set_transient('post_client_tel_no_transient', $post_client_tel_no, 2592000);

            $client_first_name  = get_transient('post_client_first_name_transient');
            $client_last_name   = get_transient('post_client_last_name_transient');
            $client_tel_no      = get_transient('post_client_tel_no_transient');

            global $wpdb;
            // Establishing Table name Prefix
            $table_name = $wpdb->prefix . "service_management_clients";
            $sql = "SELECT * FROM $table_name WHERE 
            client_first_name       = '$client_first_name'
            AND client_last_name    = '$client_last_name'
            AND client_tel_no       = '$client_tel_no'";

            $result = $wpdb->get_results($sql);
            foreach ($result as $print) {

                $client_first_name_db   = sanitize_text_field($print->client_first_name);
                $client_last_name_db    = sanitize_text_field($print->client_last_name);
                $client_tel_no_db       = sanitize_text_field($print->client_tel_no);

                set_transient('client_first_name_db_transient', $client_first_name_db, 2592000);
                set_transient('client_last_name_db_transient', $client_last_name_db, 2592000);
                set_transient('client_tel_no_db_transient', $client_tel_no_db, 2592000);
            
            }

            $client_first_name_db_comp  = get_transient('client_first_name_db_transient');
            $client_last_name_db_comp   = get_transient('client_last_name_db_transient');
            $client_tel_no_db_comp      = get_transient('client_tel_no_db_transient');

            if (

                $client_first_name_db_comp !== $client_first_name &&
                $client_last_name_db_comp !== $client_last_name &&
                $client_tel_no_db_comp !== $client_tel_no
                
            ) {

                $client_company_name    = sanitize_text_field($_POST['client_company_name']);
                $client_first_name      = sanitize_text_field($_POST['client_first_name']);
                $client_last_name       = sanitize_text_field($_POST['client_last_name']);
                $client_tel_no          = sanitize_text_field($_POST['client_tel_no']);
                $client_website_link    = sanitize_text_field($_POST['client_website_link']);
                $client_email           = sanitize_text_field($_POST['client_email']);
                $client_address         = sanitize_text_field($_POST['client_address']);

                global $wpdb;

                $table_name = $wpdb->prefix . "service_management_clients";
                $wpdb->insert(
                    $table_name,
                    array(

                        'client_company_name'   => $client_company_name,
                        'client_first_name'     => $client_first_name,
                        'client_last_name'      => $client_last_name,
                        'client_tel_no'         => $client_tel_no,
                        'client_website_link'   => $client_website_link,
                        'client_email'          => $client_email,
                        'client_address'        => $client_address,

                    ),
                    array(
                        '%s'
                    )

                );

                $client_id = $wpdb->insert_id;
                set_transient('client_id_transient', $client_id, 2592000);

                print('<script>window.location.href="admin.php?page=sm-quote-creation-1c"</script>');
            
            } else {
                    exit('User already exists');
            }
        }
    }      
        

    /**
     * Updates client records
     */
    public function delete_object()
    {
        if (isset($_POST['delete_client_from_delete_page'])) 
        {
            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_clients";
            $wpdb->delete($table_name, array('ID' => $_POST['client_id_from_delete_page']));
        }
    }

    /**
     * Updates client records
     */
    public function update_object()
    {
        if (isset($_POST['update_client_from_update_page'])) 
        {
            
            global $wpdb;

            $table_name = $wpdb->prefix . "service_management_clients";
            $data_update = array(
                'client_company_name'   => sanitize_text_field( $_POST['client_company_name'] ),
                'client_first_name'     => sanitize_text_field($_POST['client_first_name']),
                'client_last_name'      => sanitize_text_field($_POST['client_last_name']),
                'client_tel_no'         => sanitize_text_field($_POST['client_tel_no']),
                'client_website_link'   => sanitize_text_field($_POST['client_website_link']),
                'client_email'          => sanitize_text_field($_POST['client_email']),
                'client_address'        => sanitize_text_field($_POST['client_address']),

            );
            $data_where = array('ID' => $_POST['client_id_from_update_page']);
            $wpdb->update($table_name, $data_update, $data_where);
        }
    }
    
    public function read_object() 
    {
        
        echo '<table id="update_clients" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Tel No</th>
                    <th>Website Link</th>
                    <th>Email Address</th>
                    <th>Address</th>
                    <th>Update Clients</th>
                    <th>Delete Clients</th>
                    <th>Manage Clients</th>
                </tr>
            </thead>
            <tbody>';
        
        global $wpdb;
        // Establishing Table name Prefix
        $table_name = $wpdb->prefix . "service_management_clients";
        // Making SQL query from table name of employer details
        $sql = "SELECT * FROM $table_name";

        $result = $wpdb->get_results($sql);
        foreach ($result as $print) {
            $client_id                  = sanitize_text_field($print->ID);
            $client_company_name        = sanitize_text_field($print->client_company_name);
            $client_fname               = sanitize_text_field($print->client_first_name);
            $client_lname               = sanitize_text_field($print->client_last_name);
            $client_tel                 = sanitize_text_field($print->client_tel_no);
            $client_website_url         = sanitize_text_field($print->client_website_link);
            $client_email_addy          = sanitize_text_field($print->client_email);
            $client_physical_address    = sanitize_text_field($print->client_address);

                 
            echo '<tr>
                    <td>' . $client_id . '</td>
                    <td>'. $client_company_name .'</td>
                    <td>'. $client_fname . '</td>
                    <td>'. $client_lname . '</td>
                    <td>' . $client_tel . '</td>
                    <td>'. $client_website_url .'</td>
                    <td>'. $client_email_addy . '</td>
                    <td>'. $client_physical_address . '</td>
                    <td class="td_adjuster">
                        <form method="POST" enctype="multipart/form-data" id="update-clients" action="admin.php?page=sm-update-client">
                        <button type="submit" class="btn btn-primary" name="update_client" data-mdb-ripple-init>Update</button>
                        <input type="hidden" class="small-text" name="client_update_id" value="' . $client_id . '">
                        </form>
                    </td>
                    <td class="td_adjuster">
                        <form method="POST" enctype="multipart/form-data" id="delete-clients" action="admin.php?page=sm-delete-client">
                        <button type="submit" class="btn btn-primary" name="delete_client" data-mdb-ripple-init>Delete</button>
                        <input type="hidden" class="small-text" name="client_delete_id" value="' . $client_id . '">
                        </form>
                    </td>
                    <td class="td_adjuster">
                        <form method="POST" enctype="multipart/form-data" id="clients-management" action="admin.php?page=sm-clients-management">
                        <button type="submit" class="btn btn-primary" name="submit_clients_management" data-mdb-ripple-init>Manage</button>
                        <input type="hidden" class="small-text" name="clients_management_id" value="' . $client_id . '">
                        </form>
                    </td>
                </tr>';

        } ?>

        </tbody>
    </table>
<?php 
    }
}

$manage_clients = new Manage_Clients();

$button_id      = 'add-client-to-backend';
$action_page    = 'admin.php?page=sm-add-clients';
$button_name    = 'add_clients_to_backend';
$button_value   = 'Add Client';
$manage_clients->create_button( $button_id, $action_page, $button_name, $button_value );

$manage_clients->create_object();
$manage_clients->delete_object();
$manage_clients->update_object();
$manage_clients->read_object();
