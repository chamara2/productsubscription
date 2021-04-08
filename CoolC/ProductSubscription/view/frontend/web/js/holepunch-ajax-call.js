define(['jquery'], function ($) {
    'use strict';
    return function (config, element) {
        $(".product-info-after-price").find('input[type="radio"]').click(function () {
            if($(this).val() == 0){
                $(".select-duration").removeAttr("required");
                $(".duration").hide();
            }else{
                $(".select-duration").attr('required', 'required');;
                $(".duration").show();
            }
        });
        $(".product-info-after-price").prependTo(".product-options-bottom");

        console.log(config.product);
        //console.log(element);
        const url = '/productsubscription/product/subscriptions?product_id='+config.product;
        $.get({
            url: url,
            cache: false,
            success: function (result) {
                element.innerHTML = result;
            }
        })
    }
})
