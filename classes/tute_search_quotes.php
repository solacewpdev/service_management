<?php
namespace Service_Management\Classes;

class Tute_Search_Quotes
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function tute_search_quotes_display_func()
    {
        $tute_search_quotes_display = <<<HTML

            <h5 class="text-center mt-4">When we look at the placeholder screen here, the following can be done in the "Clients->Search Quotes" screen:</h5>
            <br />
            <div class="text-center">
                <h6>To search your quotes, you can navigate to "Clients->Search Quotes". Once there, you will be able to view the predefined tasks per quote, download the quotes, or delete them. Furthermore, you can also manage quotes to either edit them or accept them (when creating invoices from the quotes).</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/search-quotes1.png"  width="600px;"/>
                <br /><br /><br />
                <h6>When clicking on predefined tasks, you can view them in a modal - per quote.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/search-quotes2.png"  width="600px;"/><br /><br /><br />
                <h6>In the manage screen, once the quote has been acepted, it can't be further edited, but invoice(s) can be created from it. All the invoices will be ready once clicked on "Create Invoices":</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/search-quotes3.png"  width="600px;"/>
                <br /><br /><br />
                <h6>Accepting a quote will be look like below:.</h6>
                <br />
                <img  src="../wp-content/plugins/service_management/assets/images/search-quotes4.png"  width="600px;"/>
            </div>
        HTML;

        echo $tute_search_quotes_display;
    }
}

$tute_manage_clients = new Tute_Search_Quotes();
$tute_manage_clients->tute_search_quotes_display_func();