<?php
namespace Service_Management\Classes;

trait Trait_Create_Button_Center
{    
    /**
     * create_button
     *
     * @param  mixed $button_id
     * @param  mixed $action_page
     * @param  mixed $button_name
     * @param  mixed $button_value
     * @return void
     */
    public function create_button_center($button_id, $action_page, $button_name, $button_value)
    {
        $button_raw = <<<HTML
        <div class="mt-4 mb-4 text-center">
            <form method="POST" enctype="multipart/form-data" id="{$button_id}" action="{$action_page}">
            <button type="submit" class="btn btn-lg btn-primary" name="{$button_name}" value="{$button_value}" data-mdb-ripple-init>{$button_value}</button>
            </form>
        </div>
        HTML;

        echo $button_raw;

    }
}

