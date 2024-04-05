<?php
namespace Service_Management\Classes;
class Create_Quote_Screen2
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function process_quote_creation()
    {
        if ( isset( $_POST['submit_to_create_quote_screen2']))
        {
            $currency_select_transient = sanitize_text_field($_POST['currency_select']);
            set_transient('currency_selector_transient', $currency_select_transient, 2592000);

        // The payment budget gets selected here
        $get_budget = <<<HTML
        <img src="../wp-content/plugins/service_management/assets/images/illustrations/quote-create-step4.png"  width="400px;"/>
        <div class="mt-4">
            <form method="POST" enctype="multipart/form-data" id="confirm-quote-step2" action="admin.php?page=sm-create-quote-screen3">
                <label for="budget">Choose Payments For Quote</label>
                <select name="budget" id="budget">
                    <option value="30-50-20">30% Deposit, 50% Half-Way, 20% On Sign-Off</option>
                    <option value="20-50-30">20% Deposit, 50% Half-Way, 30% On Sign-Off</option>
                    <option value="25-50-25">25% Deposit, 50% Half-Way, 25% On Sign-Off</option>
                    <option value="50-50">50% Deposit, 50% On Sign-Off</option>
                    <option value="100">100% Upfront</option>
                </select>
                <button type="submit" class="btn btn-primary" name="submit_to_create_quote_screen3" data-mdb-ripple-init>Proceed To Tasks</button>
            </form>
        </div>
        HTML;
        echo $get_budget;
        }

        if (!isset($_POST['submit_to_create_quote_screen2'])) { ?>
            <script>
                window.history.back();
            </script>
        <?php

        }
    }
}

$create_quote_step2 = new Create_Quote_Screen2();
$create_quote_step2->process_quote_creation();

