/* [ ---- AHIS - Animal Health Information System - settings ---- ] */

    $(document).ready(function() {
        if($('#s_offline').length) {
            $("#s_offline").iButton({
                labelOn: "Yes",
                labelOff: "No"
            });
        }
        if($('#s_seo_engine').length) {
            $("#s_seo_engine").iButton({
                labelOn: "Yes",
                labelOff: "No"
            });
        }
        if($('#s_seo_rewrite').length) {
            $("#s_seo_rewrite").iButton({
                labelOn: "Yes",
                labelOff: "No"
            });
        }
        if($('#syptoms').length) {
            $('#syptoms').select2({
                tags:["Bleeding", "Scars", "Weakness", "Fever", "Pyrexia,", "Pneumonia,", "Anorexia"],
                tokenSeparators: [",", " "]
            });
        }
        if($('#s_lang_redirect').length) {
            $('#s_lang_redirect').select2({
                tags:["Bleeding", "Scars", "Weakness", "Fever", "Pyrexia,", "Pneumonia,", "Anorexia"],
                tokenSeparators: [",", " "]
            });
        }
    });