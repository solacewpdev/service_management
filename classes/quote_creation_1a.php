<?php
namespace Service_Management\Classes;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Quote_Creation_1A
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function prompt_for_new_or_existing_user()
    {
        $prompt_user = <<<HTML
        <img src="../wp-content/plugins/service_management/assets/images/illustrations/quote-create-step1.png"  width="400px;"/>
        <form method="POST" enctype="multipart/form-data" id="create-tasks" action="admin.php?page=sm-quote-creation-1b">
        <label for="prompt_new_or_existing_user">What type of client is this quote for?</label>
        <select name="prompt_new_or_existing_user" id="prompt_new_or_existing_user">
            <option value="new">New</option>
            <option value="existing">Existing</option>
        </select>
        <br />
        <button type="submit" class="btn btn-primary mt-4" name="submit_to_quote_creation_1b" data-mdb-ripple-init>Next</button>
        </form>

        HTML;
        
        echo $prompt_user;
    }
}

$quote_creation_1a = new Quote_Creation_1A();
$quote_creation_1a->prompt_for_new_or_existing_user();
