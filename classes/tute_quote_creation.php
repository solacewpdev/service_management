<?php
namespace Service_Management\Classes;

class Tute_Quote_Creation
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    public function tute_quote_creation_process()
    {
        $tute_add_clients = <<<HTML

            <h5 class="text-center mt-4">The following is the process on how to get a quote done. But firstly, let us explain Local and Global Predefined Tasks: Local Predefined Tasks, are the tasks, like a custom logo, anything that is not used in more than one quote. So, basically, anything related to one quote. On the other hand, Global Predefined Tasks, are true for tasks, that are usually rendered, maybe something like online consultation. Fixed item, with a fixed price. Between the local and global tasks, the quotes can be speedily assembled.</h5>
            <br />
            <div class="text-center">
            <h6>First thing is to click on "Clients->Create Quote" and select whether you want to create a quote for a new or existing client in the form.</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote1.png"  width="600px;"/>
            <br /><br /><br />
            <h6>If it is for a new client, select "New" and click on "Next". Fill in the add client form, and you willl be guided to the next steps.</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote2.png"  width="600px;"/>
            <h6>If it is for an existing client, click on the dropdown and select "Existing".</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote3.png"  width="600px;"/>
            <h6>When selecting "Existing", you can search for the client's name in the dropdown. See below:</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote4.png"  width="600px;"/>
            <h6>Select a currency prefix for the quote:</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote5.png"  width="600px;"/>
            <h6>Select how the client will pay for the quote:</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote6.png"  width="600px;"/>
            <h6>Next, all the quote items that are unique to this quote (local predefined tasks), must be entered. See below:</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote7.png"  width="600px;"/>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote8.png"  width="600px;"/>
            <br /><br /><br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote9.png"  width="600px;"/>
            <h6>Create or select Global Predefined Tasks for this quote, that can be used in this quote, or any other quote. Globals are not quote specific. They can be created while in quote creation mode, or when clicking on "Global Tasks", when not in quote creation mode. See Below:</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote10.png"  width="600px;"/>
            <h6>Finally, you get a summary screen of the quote just created. See Below:</h6>
            <br />
            <img  src="../wp-content/plugins/service_management/assets/images/create-quote11.png"  width="600px;"/>
        </div>
    HTML;

        echo $tute_add_clients;
    }
}

$tute_quote_creation = new Tute_Quote_Creation();
$tute_quote_creation->tute_quote_creation_process();