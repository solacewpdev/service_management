<?php
namespace Service_Management\Classes;

class Edit_Quote_Screen2
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function edit_quote_process_step2()
    {
        if ( isset( $_POST['submit_to_edit_quote_screen2'] ) )
        {
            $edit_currency_select = sanitize_text_field( $_POST['edit_currency_select'] );

            set_transient('edit_currency_select_transient', $edit_currency_select, 2592000);
            $edit_currency_select = get_transient('edit_currency_select_transient');
            
            echo 'edit currency is: ' . $edit_currency_select . '<br />';
        
            // The payment budget gets selected here
        $get_budget = <<<HTML
        <div class="mt-4">
            <form method="POST" enctype="multipart/form-data" id="edit-quote-step2" action="admin.php?page=sm-edit-quote-screen3">
                <label for="edit_quote_budget">Choose Payments For Quote</label>
                <select name="edit_quote_budget" id="edit_quote_budget">
                    <option value="30-50-20">30% Deposit, 50% Half-Way, 20% On Sign-Off</option>
                    <option value="20-50-30">20% Deposit, 50% Half-Way, 30% On Sign-Off</option>
                    <option value="25-50-25">25% Deposit, 50% Half-Way, 25% On Sign-Off</option>
                    <option value="50-50">50% Deposit, 50% On Sign-Off</option>
                    <option value="100">100% Upfront</option>
                </select>
                <button type="submit" class="btn btn-primary" name="submit_to_edit_quote_screen3" data-mdb-ripple-init>Proceed To Tasks</button>
            </form>
        </div>
        HTML;
        echo $get_budget;
        }
    }
}

$edit_quote_step_2 = new Edit_Quote_Screen2();
$edit_quote_step_2->edit_quote_process_step2();

