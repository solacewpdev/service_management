<?php
namespace Service_Management\Classes;
class Add_Client
{
    public function __construct()
    {
        if (isset ( $_POST['submit_to_quote_creation_1b']))
        {
            echo '';
        } else {
            require __DIR__ . '/includes/admin_menu.php';
        }
    }

    /**
     *  Trait for Card Notices.
     * Uses 3 @param 
     * @param => $message_1 (Message line 1)
     * @param => $_message_2 (Message Line 2)
     * @param => $card_border_color (Color of card)
     */
    use Trait_Card_Notices;

    /**
     * add_client_form
     *
     * @return void
     */
    public function add_client_form()
    {

        $add_client_form = <<<HTML
    
        <form method="POST" enctype="multipart/form-data" id="add-clients" action="admin.php?page=sm-manage-clients">
            <div class="form-outline" data-mdb-input-init>
                <input type="text" for="client_company_name" name="client_company_name" class="form-control" required/>
                <label class="form-label" >Enter client's company name:</label>
            </div>    
            <br />
            
            <div class="form-outline" data-mdb-input-init>
                <input type="text" for="client_first_name" name="client_first_name" class="form-control" required/>
                <label class="form-label" >Enter the client's first name:</label>
            </div>    
            <br />

            <div class="form-outline" data-mdb-input-init>
                <input type="text" for="client_last_name" name="client_last_name" class="form-control" required/>
                <label class="form-label" >Enter the client's last name:</label>
            </div>    
            <br />

            <div class="form-outline" data-mdb-input-init>
                <input type="tel" for="client_tel_no" name="client_tel_no" class="form-control" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}" required/>
                <label class="form-label" >Enter client's tel no: Format 555-5555-555 </label>
            </div>    
            <br />

            <div class="form-outline" data-mdb-input-init>
                <input type="url" for="client_website_link" name="client_website_link" class="form-control"/>
                <label class="form-label" >Enter the client's website link(optional):</label>
            </div>    
            <br />

            <div class="form-outline" data-mdb-input-init>
                <input type="email" for="client_email" name="client_email" class="form-control" required/>
                <label class="form-label" >Enter the client's email:</label>
            </div>    
            <br />

            <div class="form-outline" data-mdb-input-init>
                <input type="text" for="client_address" name="client_address" class="form-control" />
                <label class="form-label" >Enter the client's address(optional):</label>
            </div>    
            <br />

            <button type="submit" class="btn btn-primary" name="submit_add_client" data-mdb-ripple-init>Add Client</button>
        </form>
    </div>
    HTML;
    
    echo $add_client_form;

    }
}

$add_client = new Add_Client();

$message_1          = 'You are about to create a new client:';
$message_2          = 'Client website link and address are optional';
$card_border_color  = 'border_left_notice_warning';
$add_client->trait_card_notices($message_1, $message_2, $card_border_color);

// $add_client->add_client_backend();
$add_client->add_client_form();