<?php
namespace Service_Management\Classes;

class Plugin_Notices
{
    public function __construct()
    {
        require __DIR__ . '/includes/admin_menu.php';
    }

    use Trait_Create_Button_Center;

    public function plugin_notices_display()
    {
        $plugin_notices = <<<HTML

        <h1 class="text-center mt-4">Plugin Notices</h1>
        <h5 class="text-center">Welcome to the first release of Service Management by MassWork Creations.</h5>
        <p>With this plugin all service based niches will be able to quickly make quotes and invoices and save a lot of time to rather spend on things more of value of their time. There are local predefined tasks that is the same as tasks that gets used only on a specific quote, and global predefined task that gets used on more than one quote. Therefore, making the compiling of quotes at the speed of light! Quotes and invoices can be downloaded as PDFs. This is a very handy plugin for all service niches, so please check it out, and if any custom work is needed or any WordPress development, please contact us at <a href="mailto:team.masswork@gmail.com">team.masswork@gmail.com</a>


        HTML;

        echo $plugin_notices;
    }
}

$plugin_notices = new Plugin_Notices();

$button_id      = 'contact_devs';
$action_page    = 'mailto:team.masswork@gmail.com';
$button_name    = 'contact_devs';
$button_value   = 'Contact Developers';
$plugin_notices->create_button_center($button_id, $action_page, $button_name, $button_value);

$plugin_notices->plugin_notices_display();