<?php
namespace Service_Management\Classes;

class Contact_Developers
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    use Trait_Create_Button_Center;

    public function contact_us()
    {
        
        $contact_us = <<<HTML

        <h1 class="text-center mt-4">Need additional features done or any WordPress development?</h1>
       
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col">
                     <img class="" src="../wp-content/plugins/service_management/assets/images/illustrations/massworkcreations-logo.png"  width="400px;"/>
                    <h5>At MassWork Creations, we work hard to satisfy all of our clients' needs. We use ethics in our job delivery, and fair pricing to all. Not only do we build and modify WordPress plugins, but we build all kinds of WordPress websites. Get in touch if you need anything done and we'll show you how we work with talent, speed, and excellence. Contact us on <a href="mailto:team.masswork@gmail.com">team.masswork@gmail.com</a></h5>
                </div>
            </div>
        </div>
        HTML;

        echo $contact_us;
        
    }
}

$contact_us = new Contact_Developers();

$button_id      = 'contact_devs';
$action_page    = 'mailto:team.masswork@gmail.com';
$button_name    = 'contact_devs';
$button_value   = 'Contact Developers';
$contact_us->create_button_center($button_id, $action_page, $button_name, $button_value);

$contact_us->contact_us();

