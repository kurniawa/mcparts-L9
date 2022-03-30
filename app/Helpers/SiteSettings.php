<?php

namespace App\Helpers;

use App\Models\SiteSetting;

class SiteSettings {

    static function loadNumToZero()
    {

        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        return $load_num;
    }

    static function variablesNeeded()
    {
        $show_dump = true;
        $show_hidden_dump = true;
        $load_num_ignore = false;
        $run_db = true;

        return [$show_dump, $show_hidden_dump, $load_num_ignore, $run_db];
    }

}

?>
