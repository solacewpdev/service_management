<?php
namespace Service_Management\Classes;

trait Trait_Get_Currency
{    
    
    public function get_currency($form_id, $action_page, $input_name, $input_id, $btn_name )
    {
        $get_client_currency_form = <<<HTML
        <div class="currency_width">
        <img src="../wp-content/plugins/service_management/assets/images/illustrations/quote-create-step3.png"  width="400px;"/>
        <form method="POST" enctype="multipart/form-data" id="{$form_id}" action="{$action_page}">
        <div class="form-outline" data-mdb-input-init>
                <input type="text" id="{$input_id}" name="{$input_name}" class="form-control mb-4" />
                <label class="form-label" for="currency_selector">Enter Currency Prefix For Quote</label>
            </div>
        <button type="submit" class="btn btn-primary" name="{$btn_name}" data-mdb-ripple-init>Next Step</button>
        </form>
        </div>
        HTML;
        echo $get_client_currency_form;
    }
}
