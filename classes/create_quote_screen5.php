<?php
namespace Service_Management\Classes;

class Create_Quote_Screen5
{    
    /**
     * __construct
     *
     * @return void
     * 
     * Requires the admin menu
     */
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    /**
     * Creates a button to search quotes.
     */

    use Trait_Create_Button;

        
    /**
     * process_quote_creation
     *
     * @return void
     * 
     * Strips all words from array and string and calculates the total of remainder amounts.
     */
    public function process_quote_creation()
    {

        if (isset($_POST['submit_to_create_quote_screen5']))
        {
            
            if (isset($_POST['global_predefined_tasks'])) {
                $global_predefined_tasks_transient = $_POST['global_predefined_tasks'];
            set_transient('global_predefined_tasks_transient', $global_predefined_tasks_transient, 2592000);
            } else {
                $global_predefined_tasks_transient = array('GlobalTasks' => '0');
            set_transient('global_predefined_tasks_transient', $global_predefined_tasks_transient, 2592000);
            }

            $array1 = get_transient('global_predefined_tasks_transient');
            $array2 = get_transient('local_predefined_tasks_transient');
            

            $predefined_tasks_confirmed = array_merge($array1, $array2);

            if (array_key_exists("LocalTasks", $predefined_tasks_confirmed) && 
                array_key_exists("GlobalTasks", $predefined_tasks_confirmed)) 
            {

            ?>

                <script>
                    alert("No tasks selected please try again!");
                    window.history.back();
                </script>
                
            <?php 
            }

            $string = implode('<br /> ', $predefined_tasks_confirmed);
            
            preg_match_all('/\d+\.\d+|\d+/', $string, $matches);

            $quote_total = array_sum($matches[0]);

            set_transient('quote_total_transient', $quote_total, 2592000);
            
            $removeArray = array(
                'LocalTasks' => '0',
                'GlobalTasks' => '0'
            );

            $originalArray = $predefined_tasks_confirmed;

            $predefined_tasks_confirmed = array_diff_assoc($originalArray, $removeArray);
   
            $budget = get_transient('budget_transient');

            echo '<br /><br />Payment budget is (in %): ' . $budget . '<br /><br />';
            
            $budget = explode('-', $budget);

            count($budget);

            if (count($budget) === 1) {
                $invoice_1 = rand(1, 1000000);
                $invoice_2 = '0';
                $invoice_3 = '0';
            } elseif (count($budget) === 2) {
                $invoice_1 = rand(1, 1000000);
                $invoice_2 = rand(1, 1000000);
                $invoice_3 = '0';
            } else {
                $invoice_1 = rand(1, 1000000);
                $invoice_2 = rand(1, 1000000);
                $invoice_3 = rand(1, 1000000);
            }

            global $wpdb;

            $predefined_tasks_json_encode = implode(' ,',$predefined_tasks_confirmed);
            echo 'Predefined tasks are: ' . $predefined_tasks_json_encode . '<br /><br />';
            $predefined_tasks_json_encode = explode(' ,', $predefined_tasks_json_encode);
            $predefined_tasks_json_encode = json_encode($predefined_tasks_json_encode);

            $quote_id = get_transient('quote_id_transient');

            echo 'Quote ID = ' . ' ' . $quote_id . '<br /><br />';
            

            echo 'Invoice ID 1 = ' . $invoice_1 . '<br />';
            echo 'Invoice ID 2 = ' . $invoice_2 . '<br />';
            echo 'Invoice ID 3 = ' . $invoice_3 . '<br />';

            $quote_total        = get_transient('quote_total_transient');
            $currency_select    = get_transient('currency_selector_transient');

            echo '<br /><br /><strong class="mt-4">Total:</strong> ' . $currency_select . ' ' . $quote_total . '<br /><br /><br />';
            echo 'Quote is ready for download';

            global $wpdb;

            $new_date = date('Y-m');

            $table_name     = $wpdb->prefix . "service_management_quotes";
            $data_update    = array(
                    
                'predefined_tasks'  => $predefined_tasks_json_encode,
                'quote_total'       => $quote_total,
                'quote_accepted'    => 'NO',//$not_accepted,
                'invoice_1'         => $invoice_1,
                'invoice_2'         => $invoice_2,
                'invoice_3'         => $invoice_3,
                'date_added'        => $new_date

            );
            $data_where = array('ID' => $quote_id);
            $wpdb->update( $table_name, $data_update, $data_where );

        }

        if (!isset($_POST['submit_to_create_quote_screen5']))
        {
            print('<script>window.location.href="admin.php?page=sm-create-quote-screen3"</script>');
        }

    }
}
$confirm_created_quote = new Create_Quote_Screen5();
$confirm_created_quote->process_quote_creation();

$button_id      = 'search-quotes';
$action_page    = 'admin.php?page=sm-search-quotes';
$button_name    = 'search_quotes';
$button_value   = 'Search Quotes';
$confirm_created_quote->create_button( $button_id, $action_page, $button_name, $button_value );



