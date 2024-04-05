<?php
namespace Service_Management\Classes;

trait Trait_Card_Notices
{    
    /**
     * trait_card_notices
     *
     * @param  mixed $message1
     * @param  mixed $message2
     * @param  mixed $card_border_color
     * @return void
     */
    public function trait_card_notices($message1, $message2, $card_border_color)
    {
    
    $card_notices = <<<HTML

    <div class="card card_width">
        <div class="card {$card_border_color} shadow h-100 py-2 mb-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase">
                            <h6 class="company_settings_form_notice">
                                {$message1} 
                            </h6>
                        </div>
                        <div class="text-xs font-weight-bold text-uppercase">
                            <h6 class="company_settings_form_notice">{$message2}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    HTML;

    echo $card_notices;

    }
}