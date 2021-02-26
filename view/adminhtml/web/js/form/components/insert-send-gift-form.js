/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'uiRegistry',
    'Magento_Ui/js/form/components/insert-form',
    'mageUtils',
    'underscore'
], function ($, registry, Insert, utils, _) {
    'use strict';

    return Insert.extend({
        defaults: {
            listens: {
                responseData: 'onResponse',
                responseStatus: 'onStatus'
            },
            modules: {
                giftModalProvider: '${ $.giftModalProvider }',
                ownerComponent: '${ $.ownerComponent }'
            }
        },

        requestData: function (params, ajaxSettings) {
            if (this.customer_email) {
                params.email = this.customer_email;
            }
            if (this.gift_id) {
                params.gift_id = this.gift_id;
            }
            let query = utils.copy(params);
            ajaxSettings = _.extend({
                url: this['update_url'],
                method: 'GET',
                data: query,
                dataType: 'json'
            }, ajaxSettings);

            this.loading(true);

            return $.ajax(ajaxSettings);
        },

        /**
         *
         * @param {Object} responseData
         */
        onResponse: function (responseData) {
            if (responseData.status !== 'Error') {
                this.giftModalProvider().closeModal();
            } else {
                // show error msg
            }
        }
    });
});
