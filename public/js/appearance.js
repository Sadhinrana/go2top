var customModule = {};

window.modules = {}, $(function() {
"object" == typeof window.modules && $.each(window.modules, function(e, t) {
void 0 !== customModule[e] && customModule[e].run(t);
});
});

var templates = {};

templates["admin/subscriptions_error_details"] = _.template('<div class="form-group">\n    <label id="details_provider" for="details_details" class="control-label"><%= details.content_label %></label>\n    <textarea id="details_details" class="form-control" rows="7" readonly><%= details.content %></textarea>\n</div>'), 
templates["admin/payment_settings_amounts_container"] = _.template("<div id=\"amount_container_row\" class=\"hidden\">\n    <div id=\"amount_container\">\n        <%= content %>\n    </div>\n    <a href=\"#\" class=\"form-group__generator-link add-amount\" data-id=\"#amount_container\" data-code='<%= JSON.stringify(data['code']) %>' data-name='<%= JSON.stringify(data['name']) %>' data-label='<%= JSON.stringify(data['label']) %>'><span><%= data['add_label'] %></span></a>\n</div>"), 
templates["admin/modules_modal_input"] = _.template('<div class="form-group">\n    <label class="control-label"><%= label %></label>\n    <input type="number" name="form_fields[<%= name %>]" class="form-control" value="<%= value %>">\n</div>'), 
templates["admin/payment_settings_checkbox"] = _.template('<div class="form-check">\n    <input type="checkbox" class="form-check-input" name="EditPaymentMethodForm[options][<%= data[\'name\'] %>]" id="edit-payment-method-options-<%= data[\'code\'] %>" value="1" <% if (data[\'value\']) { %> checked<% } %>>\n    <label for="edit-payment-method-options-<%= data[\'code\'] %>" class="form-check-label"><%= data[\'label\'] %></label>\n</div>'), 
templates["admin/payment_settings_input"] = _.template('<div class="form-group">\n    <label for="edit-payment-method-options-<%= data[\'code\'] %>" class="control-label"><%= data[\'label\'] %></label>\n    <input type="text" class="form-control" name="EditPaymentMethodForm[options][<%= data[\'name\'] %>]" id="edit-payment-method-options-<%= data[\'code\'] %>" value="<%= data[\'value\'] %>">\n</div>'), 
templates["admin/payment_settings_textarea"] = _.template('<div class="form-group">\n    <label for="edit-payment-method-options-<%= data[\'code\'] %>" class="control-label"><%= data[\'label\'] %></label>\n    <textarea cols="30" rows="10" class="form-control" name="EditPaymentMethodForm[options][<%= data[\'name\'] %>]" id="edit-payment-method-options-<%= data[\'code\'] %>"><%= data[\'value\'] %></textarea>\n</div>'), 
templates["admin/subscriptions_fail_details"] = _.template('<div class="form-group">\n    <label id="details_provider" for="details_details" class="control-label"><%= details.content_label %></label>\n    <textarea id="details_details" class="form-control" rows="7" readonly><%= details.content %></textarea>\n</div>\n<div class="form-group">\n    <label for="details_code"><%= details.code_label %></label>\n    <input id="details_code" type="text" class="form-control" value="<%= details.code %>" readonly="">\n</div>'), 
templates["admin/payment_settings_amounts"] = _.template('<div class="form-group__generator-row">\n    <span class="fas fa-times remove__generator-row"></span>\n    <div class="row">\n        <div class="col-xs-4">\n            <div class="form-group">\n                <label for="edit-payment-method-options-amounts-<%= data[\'code\'][\'amount\'] %>" class="control-label"><%= data[\'label\'][\'amount\'] %></label>\n                <input type="number" class="form-control" name="EditPaymentMethodForm[options][amounts][<%= data[\'name\'][\'amount\'] %>][<% if (index) { %><%= index %><% } %>]" id="edit-payment-method-options-amounts-<%= data[\'code\'][\'amount\'] %>" value="<%= value[\'amount\'] %>">\n\n            </div>\n        </div>\n        <div class="col-xs-8">\n            <div class="form-group">\n                <label for="edit-payment-method-options-amounts-<%= data[\'code\'][\'description\'] %>" class="control-label"><%= data[\'label\'][\'description\'] %></label>\n                <input type="text" class="form-control amount-description" name="EditPaymentMethodForm[options][amounts][<%= data[\'name\'][\'description\'] %>][<% if (index) { %><%= index %><% } %>]" id="edit-payment-method-options-amounts-<%= data[\'code\'][\'description\'] %>" value="<%= value[\'description\'] %>">\n            </div>\n        </div>\n    </div>\n</div>'), 
templates["admin/users_activity_log_rows"] = _.template("<% _.each(rows, function(row) { %>\n<tr>\n    <td><%= row.ip %></td>\n    <td><%= row.date %></td>\n</tr>\n<% }); %>"), 
templates["admin/payment_settings_select"] = _.template('<div class="form-group">\n    <label for="edit-payment-method-options-<%= data[\'code\'] %>" class="control-label"><%= data[\'label\'] %></label>\n    <select class="form-control" name="EditPaymentMethodForm[options][<%= data[\'name\'] %>]" id="edit-payment-method-options-<%= data[\'code\'] %>">\n        <% _.forEach(data[\'options\'], function(label, value) {%>\n        <option value="<%= value %>" <% if (value == data[\'value\']) { %> selected <% } %>><%= label %></option>\n        <%}); %>\n    </select>\n</div>'), 
templates["admin/payment_settings_multi_input"] = _.template('<div class="form-group form-group__paypal-description">\n    <span class="fas fa-times remove__paypal-description"></span>\n    <label for="edit-payment-method-options-<%= data[\'code\'] %>" class="control-label"><%= data[\'label\'] %></label>\n    <input required type="text" class="form-control" name="EditPaymentMethodForm[options][<%= data[\'name\'] %>][]" id="edit-payment-method-options-<%= data[\'code\'] %>" value="<%= value %>">\n</div>'), 
templates["admin/subscriptions_details"] = _.template('<% if (details.reason.content) { %>\n<div class="form-group">\n    <label for="reason"><%= details.reason.label %></label>\n    <input type="text" readonly class="form-control" id="reason" value="<%= details.reason.content %>">\n</div>\n<% } %>\n\n<% if (details.message.content) { %>\n<div class="form-group">\n    <label for=""><%= details.message.label %></label>\n    <input type="text" readonly class="form-control" id="" value="<%= details.message.content %>">\n</div>\n<% } %>'), 
templates["admin/modules_modal_select"] = _.template('<div class="form-group">\n    <label for="" class="control-label"><%= label %></label>\n    <select name="form_fields[<%= name %>]" class="form-control">\n        <% _.each(selectItems, function(item) { %>\n        <option <% if (item.value == value) { %> selected="selected" <% } %> value="<%= item.value %>"><%= item.label %></option>\n        <% }); %>\n    </select>\n</div>'), 
templates["admin/payment_settings_course"] = _.template('<div class="form-group">\n    <label for="edit-payment-method-options-<%= data[\'code\'] %>" class="control-label"><%= data[\'label\'] %></label>\n    <input type="text" class="form-control" name="EditPaymentMethodForm[options][<%= data[\'name\'] %>]" id="edit-payment-method-options-<%= data[\'code\'] %>" value="<%= data[\'value\'] %>">\n</div>'), 
templates["admin/payment_settings_multi_input_container"] = _.template('<div id="multi_input_container_<%= data[\'code\'] %>">\n    <%= content %>\n</div>\n<a href="#" class="add-multi-input" data-id="#multi_input_container_<%= data[\'code\'] %>" data-code="<%= data[\'code\'] %>" data-name="<%= data[\'name\'] %>" data-label="<%= data[\'label\'] %>"><span><%= data[\'add_label\'] %></span></a>'), 
templates["user/user_info_modal"] = _.template('\x3c!-- Modal --\x3e\n<div class="modal fade" id="userInfoModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">\n    <div class="modal-dialog" role="document">\n        <form action="<%= action %>" id="userInfoForm" method="POST" class="modal-content">\n            <div class="modal-body">\n                <div id="userInfoError" class="error-summary alert alert-danger hidden"></div>\n                <div class="form-group">\n                    <label for="first_name"><%= labels[\'first_name\'] %></label>\n                    <input type="text" class="form-control" id="first_name" name="UpdateUserInfoFrom[first_name]" value="<%= values[\'first_name\'] %>">\n                </div>\n                <div class="form-group">\n                    <label for="last_name"><%= labels[\'last_name\'] %></label>\n                    <input type="text" class="form-control" id="last_name" name="UpdateUserInfoFrom[last_name]" value="<%= values[\'last_name\'] %>">\n                </div>\n\n                <input type="hidden" name="_csrf" value="<%= csrftoken %>">\n\n                <button type="submit" class="btn btn-primary" id="userInfoSubmit"><%= labels[\'submit_btn\'] %></button>\n            </div>\n        </form>\n    </div>\n</div>'), 
templates["addfunds/select"] = _.template('<div class="form-group fields" id="order_<%= name %>">\n    <label class="control-label" for="field-<%= name %>"><%= label %></label>\n    <select class="form-control" name="AddFoundsForm[fields][<%= name %>]" id="field-<%= name %>">\n        <% _.forEach(options, function(optLabel, optValue) {%>\n        <option value="<%= optValue %>" <% if (value == optValue) { %> selected <% } %>><%= optLabel %></option>\n        <%}); %>\n    </select>\n</div>'), 
templates["addfunds/stripe_iban_element"] = _.template('<div class="form-group" style="position: relative;">\n    <label class="control-label"><%= label %></label>\n    <div id="stripe-iban-element" class="form-control"></div>\n    <div id="stripe-iban-bank-name" style="position: absolute; right: 10px; margin-top: -30px; opacity: 0.8; z-index: 1;"></div>\n</div>'), 
templates["addfunds/stripe_card_element"] = _.template('<div class="form-group">\n    <label class="control-label" ><%= label %></label>\n    <div id="stripe-card-element" ></div>\n</div>'), 
templates["addfunds/description"] = _.template('<div class="form-group fields" id="order_<%= name %>">\n    <label class="control-label" for="field-<%= name %>"><%= label %></label>\n    <div class="panel-body border-solid border-rounded text-center"><%= value %></div>\n</div>'), 
templates["addfunds/checkbox"] = _.template('<div class="form-group fields" id="order_<%= name %>">\n    <label class="control-label" for="field-<%= name %>"><%= label %></label><br>\n    <input name="AddFoundsForm[fields][<%= name %>]" value="0" type="hidden"/>\n    <input name="AddFoundsForm[fields][<%= name %>]" value="1" type="checkbox" id="field-<%= name %>"/>\n</div>'), 
templates["addfunds/alert"] = _.template('<div class="alert alert-dismissible alert-danger ">\n    <button type="button" class="close" data-dismiss="alert">×</button>\n    <%= text %>\n</div>'), 
templates["addfunds/input"] = _.template('<div class="form-group fields" id="order_<%= name %>">\n    <label class="control-label" for="field-<%= name %>"><%= label %></label>\n    <input class="form-control" name="AddFoundsForm[fields][<%= name %>]" value="<%= value %>" type="text" id="field-<%= name %>"/>\n</div>'), 
templates["addfunds/stripe_payment_request_btn"] = _.template('<span id="<%= id %>" style="width: 150px; height: 18px; display: inline-block;" class="hidden"></span>'), 
templates["addfunds/hidden"] = _.template('<input class="fields" name="AddFoundsForm[fields][<%= name %>]" value="<%= value %>" type="hidden" id="field-<%= name %>"/>'), 
templates["addfunds/modal/checkout_com_card"] = _.template('<div class="modal fade" id="checkoutcomCardModal" data-backdrop="static" tabindex="-1" role="dialog">\n    <div class="modal-dialog" role="document">\n        <div class="modal-content">\n            <div class="modal-header">\n                <button type="button" class="close" data-dismiss="modal" aria-label="<%= modal_title %>">\n                    <span aria-hidden="true">&times;</span>\n                </button>\n                <h4 class="modal-title"><%= modal_title %></h4>\n            </div>\n            <form method="POST">\n                <div class="modal-body">\n                    <div class="frames-container">\n                        \x3c!-- form will be added here --\x3e\n                    </div>\n                    \x3c!-- add submit button --\x3e\n                </div>\n                <div class="modal-footer">\n                    <button type="submit" class="button-credit-card btn btn-primary">\n                        <%= submit_title %>\n                    </button>\n                    <button type="button" class="btn btn-default" data-dismiss="modal">\n                        <%= cancel_title %>\n                    </button>\n                </div>\n            </form>\n        </div>\n    </div>\n</div>'), 
templates["addfunds/modal/squareup_card"] = _.template('<div class="modal fade" id="squareupCardModal" data-backdrop="static" tabindex="-1" role="dialog">\n    <div class="modal-dialog" role="document">\n        <div class="modal-content">\n            <div class="modal-header">\n                <button type="button" class="close" data-dismiss="modal" aria-label="<%= modal_title %>">\n                    <span aria-hidden="true">&times;</span>\n                </button>\n                <h4 class="modal-title"><%= modal_title %></h4>\n            </div>\n\n            <div id="form-container">\n                <div id="sq-ccbox">\n                    \x3c!--\n                      Be sure to replace the action attribute of the form with the path of\n                      the Transaction API charge endpoint URL you want to POST the nonce to\n                      (for example, "/process-card")\n                    --\x3e\n                    <form id="nonce-form" novalidate>\n                        <div class="modal-body">\n\n                            <div id="card-error-container" class="error-summary alert alert-danger hidden"></div>\n\n                            <fieldset>\n                                <div class="form-group">\n                                    <label class="control-label" for="sq-card-number"><%= card_number %></label>\n                                    <div id="sq-card-number" class="form-control"></div>\n                                </div>\n                                <div class="form-group">\n                                    <label class="control-label" for="sq-expiration-date"><%= expiration_date %></label>\n                                    <div id="sq-expiration-date" class="form-control"></div>\n                                </div>\n                                <div class="form-group">\n                                    <label class="control-label" for="sq-cvv"><%= cvv %></label>\n                                    <div id="sq-cvv" class="form-control"></div>\n                                </div>\n                                <div class="form-group">\n                                    <label class="control-label" for="sq-postal-code"><%= postal_code %></label>\n                                    <div id="sq-postal-code" class="form-control"></div>\n                                </div>\n                            </fieldset>\n\n                            <div id="error"></div>\n                            \x3c!--\n                              After a nonce is generated it will be assigned to this hidden input field.\n                            --\x3e\n                            <input type="hidden" id="card-nonce" name="nonce">\n                        </div>\n\n                        <div class="modal-footer">\n                            <button id="sq-creditcard" type="submit" class="button-credit-card btn btn-primary">\n                                <%= submit_title %>\n                            </button>\n                            <button type="button" class="btn btn-default" data-dismiss="modal">\n                                <%= cancel_title %>\n                            </button>\n                        </div>\n\n                    </form>\n                </div> \x3c!-- end #sq-ccbox --\x3e\n            </div> \x3c!-- end #form-container --\x3e\n\n        </div>\n    </div>\n</div>'), 
templates["addfunds/custom/credit_card"] = _.template('<div class="form-group fields">\n    <label class="control-label"><%= card_number.label %></label>\n    <input class="form-control" id="field-visible-<%= card_number.name %>" name="AddFoundsForm[fields][<%= card_number.name %>]" value="<%= card_number.value %>" type="text" autocomplete="off" placeholder="XXXX-XXXX-XXXX-XXXX" size="19" >\n</div>\n<div class="row">\n    <div class="col-xs-4 form-group fields">\n        <label class="control-label"><%= expiry_month.label %></label>\n        <input class="form-control" id="field-visible-<%= expiry_month.name %>" name="AddFoundsForm[fields][<%= expiry_month.name %>]" value="<%= expiry_month.value %>" placeholder="MM" minlength="2" maxlength="2" type="number">\n    </div>\n    <div class="col-xs-4 form-group fields">\n        <label class="control-label"><%= expiry_year.label %></label>\n        <input class="form-control" id="field-visible-<%= expiry_year.name %>" name="AddFoundsForm[fields][<%= expiry_year.name %>]" value="<%= expiry_year.value %>" placeholder="YY" minlength="2" maxlength="2" type="number">\n    </div>\n    <div class="col-xs-4 form-group fields">\n        <label class="control-label"><%= cvv.label %></label>\n        <input autocomplete="on" class="form-control" id="field-visible-<%= cvv.name %>" name="AddFoundsForm[fields][<%= cvv.name %>]" value="<%= cvv.value %>" maxlength="4" type="password">\n    </div>\n</div>'), 
templates["modal/confirm"] = _.template('<div class="modal fade confirm-modal" id="confirmModal" aria-labelledby="myModalLabel" tabindex="-1" data-backdrop="static">\n    <div class="modal-dialog modal-sm modal-yesno" role="document">\n        <div class="modal-content">\n            <% if (typeof(confirm_message) !== "undefined" && confirm_message != \'\') { %>\n            <div class="modal-body text-center">\n                <h5 class="mb-0"><%= title %></h5>\n            </div>\n\n            <div class="modal-body">\n                <p><%= confirm_message %></p>\n            </div>\n\n            <div class="modal-footer modal-footer__padding-10 justify-content-center">\n                <button class="btn btn-light" data-dismiss="modal" aria-hidden="true"><%= cancel_button %></button>\n                <button class="btn btn-primary" id="confirm_yes"><%= confirm_button %></button>\n            </div>\n            <% } else { %>\n\n            <div class="modal-body">\n                <div class="m-b" align="center">\n                    <h4 class="m-t-0"> <%= title %></h4>\n                </div>\n\n                <div align="center">\n                    <button type="submit" class="btn btn-primary" id="confirm_yes">\n                        <%= confirm_button %>\n                    </button>\n                    <button type="button" class="btn btn-default" data-dismiss="modal">\n                        <%= cancel_button %>\n                    </button>\n                </div>\n            </div>\n            <% } %>\n        </div>\n    </div>\n</div>'), 
templates["neworder/order_keywords"] = _.template('<div class="form-group hidden fields" id="order_keywords">\n    <label class="control-label" for="field-orderform-fields-keywords"><%= label[\'keywords\'] %></label>\n    <textarea class="form-control" name="OrderForm[keywords]" id="field-orderform-fields-keywords" cols="30" rows="10"><%= data[\'keywords\'] %></textarea>\n</div>'), 
templates["neworder/order_posts"] = _.template('<div class="form-group hidden fields" id="order_posts">\n    <label class="control-label" for="field-orderform-fields-posts"><%= label[\'new_posts\'] %></label>\n    <input class="form-control" name="OrderForm[posts]" value="<%= data[\'posts\'] %>" type="text" id="field-orderform-fields-posts"/>\n</div>'), 
templates["neworder/order_delay"] = _.template('<div class="form-group hidden fields" id="order_delay">\n    <div class="row">\n        <div class="col-xs-6">\n            <label class="control-label" for="field-orderform-fields-delay"><%= label[\'delay\'] %></label>\n            <select class="form-control" name="OrderForm[delay]" id="field-orderform-fields-delay">\n                <% _.forEach(delays, function(delayLabel, delayValue) {%>\n                <option value="<%= delayValue %>" <% if (delayValue == data[\'delay\']) { %> selected <% } %>><%= delayLabel %></option>\n                <%}); %>\n            </select>\n        </div>\n        <div class="col-xs-6">\n            <label for="field-orderform-fields-expiry"><%= label[\'expiry\'] %></label>\n            <div class="input-group">\n                <input class="form-control datetime" name="OrderForm[expiry]" value="<%= data[\'expiry\'] %>" type="text" id="field-orderform-fields-expiry"/>\n                <span class="input-group-btn">\n                    <button class="btn btn-default clear-datetime" type="button" data-rel="#field-orderform-fields-expiry"><span class="fa fa-trash-o"></span></button>\n                </span>\n            </div>\n        </div>\n    </div>\n</div>'), 
templates["neworder/order_media_url"] = _.template('<div class="form-group hidden fields" id="order_mediaUrl">\n    <label class="control-label" for="field-orderform-fields-mediaUrl"><%= label[\'mediaurl\'] %></label>\n    <input class="form-control" name="OrderForm[mediaUrl]" value="<%= data[\'mediaUrl\'] %>" type="text" id="field-orderform-fields-mediaUrl"/>\n</div>'), 
templates["neworder/order_mention_usernames"] = _.template('<div class="form-group hidden fields" id="order_mentionUsernames">\n    <label class="control-label" for="field-orderform-fields-mentionUsernames"><%= label[\'usernames\'] %></label>\n    <textarea class="form-control" name="OrderForm[mentionUsernames]" id="field-orderform-fields-mentionUsernames" cols="30" rows="10"><%= data[\'mentionUsernames\'] %></textarea>\n</div>'), 
templates["neworder/order_link"] = _.template('<div class="form-group hidden fields" id="order_link">\n    <label class="control-label" for="field-orderform-fields-link"><%= label[\'link\'] %></label>\n    <input class="form-control" name="OrderForm[link]" value="<%= data[\'link\'] %>" type="text" id="field-orderform-fields-link"/>\n</div>'), 
templates["neworder/order_min"] = _.template('<div class="form-group hidden fields" id="order_min">\n    <label class="control-label" for="order_count"><%= label[\'quantity\'] %></label>\n    <div class="row">\n        <div class="col-xs-6">\n            <input type="text" class="form-control" id="order_count" name="OrderForm[min]" value="<%= data[\'min\'] %>" placeholder="<%= label[\'min\'] %>" />\n        </div>\n\n        <div class="col-xs-6">\n            <input type="text" class="form-control" id="order_count" name="OrderForm[max]" value="<%= data[\'max\'] %>" placeholder="<%= label[\'max\'] %>" />\n        </div>\n    </div>\n</div>'), 
templates["neworder/order_groups"] = _.template('<div class="form-group hidden fields" id="order_groups">\n    <label class="control-label" for="field-orderform-fields-groups"><%= label[\'groups\'] %></label>\n    <textarea class="form-control" name="OrderForm[groups]" id="field-orderform-fields-groups" cols="30" rows="10"><%= data[\'groups\'] %></textarea>\n</div>'), 
templates["neworder/order_email"] = _.template('<div class="form-group hidden fields" id="order_email">\n    <label class="control-label" for="field-orderform-fields-email"><%= label[\'email\'] %></label>\n    <input class="form-control" name="OrderForm[email]" value="<%= data[\'email\'] %>" type="text" id="field-orderform-fields-email"/>\n</div>'), 
templates["neworder/order_quantity"] = _.template('<div class="form-group hidden fields" id="order_quantity">\n    <label class="control-label" for="field-orderform-fields-quantity"><%= label[\'quantity\'] %></label>\n    <input class="form-control" name="OrderForm[quantity]" value="<%= data[\'quantity\'] %>" type="text" id="field-orderform-fields-quantity"/>\n</div>'), 
templates["neworder/order_username"] = _.template('<div class="form-group hidden fields" id="order_username">\n    <label class="control-label" for="field-orderform-fields-username"><%= label[\'username\'] %></label>\n    <input class="form-control" name="OrderForm[username]" value="<%= data[\'username\'] %>" type="text" id="field-orderform-fields-username"/>\n</div>'), 
templates["neworder/order_hashtag"] = _.template('<div class="form-group hidden fields" id="order_hashtag">\n    <label class="control-label" for="field-orderform-fields-hashtag"><%= label[\'hashtag\'] %></label>\n    <input class="form-control" name="OrderForm[hashtag]" value="<%= data[\'hashtag\'] %>" type="text" id="field-orderform-fields-hashtag"/>\n</div>'), 
templates["neworder/order_dripfeed"] = _.template('<div id="dripfeed">\n    <div class="form-group fields hidden" id="order_check">\n        <label class="control-label has-depends " for="field-orderform-fields-check">\n            <input name="OrderForm[check]" value="1" type="checkbox" id="field-orderform-fields-check" <% if (data[\'check\']) { %> checked <% } %> />\n            <%= label[\'dripfeed\'] %>\n        </label>\n        <div class="hidden depend-fields" id="dripfeed-options" data-depend="field-orderform-fields-check">\n            <div class="form-group">\n                <label class="control-label" for="field-orderform-fields-runs"><%= label[\'dripfeed.runs\'] %></label>\n                <input class="form-control" name="OrderForm[runs]" value="<%= data[\'runs\'] %>" type="text" id="field-orderform-fields-runs" />\n            </div>\n\n            <div class="form-group">\n                <label class="control-label" for="field-orderform-fields-interval"><%= label[\'dripfeed.interval\'] %></label>\n                <input class="form-control" name="OrderForm[interval]" value="<%= data[\'interval\'] %>" type="text" id="field-orderform-fields-interval" />\n            </div>\n\n            <div class="form-group">\n                <label class="control-label" for="field-orderform-fields-total-quantity"><%= label[\'dripfeed.total.quantity\'] %></label>\n                <input class="form-control" name="OrderForm[total_quantity]" value="<%= data[\'total_quantity\'] %>" type="text" id="field-orderform-fields-total-quantity" readonly=""/>\n            </div>\n        </div>\n    </div>\n</div>'), 
templates["neworder/order_usernames_custom"] = _.template('<div class="form-group hidden fields" id="order_usernames_custom">\n    <label class="control-label" for="field-orderform-fields-usernames_custom"><%= label[\'usernames\'] %></label>\n    <textarea class="form-control" name="OrderForm[usernames_custom]" id="field-orderform-fields-usernames_custom" cols="30" rows="10"><%= data[\'usernames_custom\'] %></textarea>\n</div>'), 
templates["neworder/order_usernames"] = _.template('<div class="form-group hidden fields" id="order_usernames">\n    <label class="control-label" for="field-orderform-fields-usernames"><%= label[\'usernames\'] %></label>\n    <textarea class="form-control w-full" name="OrderForm[usernames]" id="field-orderform-fields-usernames" cols="30" rows="10"><%= data[\'usernames\'] %></textarea>\n</div>'), 
templates["neworder/order_hashtags"] = _.template('<div class="form-group hidden fields" id="order_hashtags">\n    <label class="control-label" for="field-orderform-fields-hashtags"><%= label[\'hashtags\'] %></label>\n    <textarea class="form-control" name="OrderForm[hashtags]" id="field-orderform-fields-hashtags" cols="30" rows="10"><%= data[\'hashtags\'] %></textarea>\n</div>'), 
templates["neworder/order_answer_number"] = _.template('<div class="form-group hidden fields" id="order_answer_number">\n    <label class="control-label" for="field-orderform-fields-answer_number"><%= label[\'answer_number\'] %></label>\n    <input class="form-control" name="OrderForm[answer_number]" value="<%= data[\'answer_number\'] %>" type="text" id="field-orderform-fields-answer_number"/>\n</div>'), 
templates["neworder/order_user_name"] = _.template('<div class="form-group hidden fields" id="order_user_name">\n    <label class="control-label" for="field-orderform-fields-user_name"><%= label[\'username\'] %></label>\n    <input class="form-control w-full" name="OrderForm[user_name]" value="<%= data[\'user_name\'] %>" type="text" id="field-orderform-fields-user_name"/>\n</div>'), 
templates["neworder/order_comment"] = _.template('<div class="form-group hidden fields" id="order_comment">\n    <label class="control-label" for="field-orderform-fields-comment"><%= label[\'comments\'] %></label>\n    <textarea class="form-control" name="OrderForm[comment]" id="field-orderform-fields-comment" cols="30" rows="10"><%= data[\'comment\'] %></textarea>\n</div>'), 
templates["neworder/order_comment_username"] = _.template('<div class="form-group hidden fields" id="order_comment_username">\n    <label class="control-label" for="field-orderform-fields-comment_username"><%= label[\'comment_username\'] %></label>\n    <input class="form-control" name="OrderForm[comment_username]" value="<%= data[\'username\'] %>" type="text" id="field-orderform-fields-comment_username"/>\n</div>');

var custom = new function() {
var i = this;
i.request = null, i.confirm = function(e, t, a, o) {
var n;
return n = (0, templates["modal/confirm"])($.extend({}, !0, {
confirm_button: "OK",
cancel_button: "Cancel",
width: "600px"
}, o, {
title: e,
confirm_message: t
})), $(window.document.body).append(n), $("#confirmModal").modal({}), $("#confirmModal").on("hidden.bs.modal", function(e) {
$("#confirmModal").remove();
}), $("#confirm_yes").on("click", function(e) {
return $("#confirm_yes").unbind("click"), $("#confirmModal").modal("hide"), a.call();
});
}, i.ajax = function(e) {
var t = $.extend({}, !0, e);
"object" == typeof e && (e.beforeSend = function() {
"function" == typeof t.beforeSend && t.beforeSend();
}, e.success = function(e) {
i.request = null, e.redirect && 0 < e.redirect.length ? window.location.replace(e.redirect) : "function" == typeof t.success && t.success(e);
}, null != i.request && i.request.abort(), i.request = $.ajax(e));
}, i.notify = function(e) {
var t, a;
if ($("body").addClass("bottom-right"), "object" != typeof e) return !1;
for (t in e) void 0 !== (a = $.extend({}, !0, {
type: "success",
delay: 8e3,
text: ""
}, e[t])).text && null != a.text && $.notify({
message: a.text.toString()
}, {
type: a.type,
placement: {
from: "bottom",
align: "right"
},
z_index: 2e3,
delay: a.delay,
animate: {
enter: "animated fadeInDown",
exit: "animated fadeOutUp"
}
});
}, i.sendBtn = function(t, a) {
if ("object" != typeof a && (a = {}), !t.hasClass("active")) {
t.addClass("has-spinner");
var e = $.extend({}, !0, a);
if (e.url = t.attr("href") || t.data("url"), void 0 !== e.type && e.type.toUpperCase() === "POST".toUpperCase() && yii) {
var o = {};
o[yii.getCsrfParam()] = yii.getCsrfToken(), e.data = $.extend({}, e.data, o);
}
$(".spinner", t).remove(), t.prepend('<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>'), 
e.beforeSend = function() {
t.addClass("active");
}, e.success = function(e) {
t.removeClass("active"), $(".spinner", t).remove(), "success" === e.status ? "function" == typeof a.callback && a.callback(e) : "error" === e.status && i.notify({
0: {
type: "danger",
text: e.message
}
});
}, i.ajax(e);
}
}, i.sendFrom = function(t, a, o) {
if ("object" != typeof o && (o = {}), !t.hasClass("active")) {
t.addClass("has-spinner");
var e = $.extend({}, !0, o), n = $(".error-summary", a);
e.url = a.attr("action"), e.type = "POST", $(".spinner", t).remove(), t.prepend('<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>'), 
e.beforeSend = function() {
t.addClass("active"), custom.showModalLoader(!0), n.length && (n.addClass("hidden"), 
n.html(""));
}, e.success = function(e) {
t.removeClass("active"), custom.showModalLoader(!1), $(".spinner", t).remove(), 
"success" == e.status ? "function" == typeof o.callback && o.callback(e) : "error" == e.status && (e.message && (n.length ? (n.html(e.message), 
n.removeClass("hidden")) : i.notify({
0: {
type: "danger",
text: e.message
}
})), e.errors && $.each(e.errors, function(e, t) {
a.yiiActiveForm("updateAttribute", e, t);
}), "function" == typeof o.errorCallback && o.errorCallback(e));
}, i.ajax(e);
}
}, i.generatePassword = function(e) {
void 0 === e && (e = 8);
var t, a = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", o = "", n = a.length;
for (t = 0; t < e; ++t) o += a.charAt(Math.floor(Math.random() * n));
return o;
}, i.freezeForm = function(e) {
var t, a, o = {};
return e.find("input, select, textarea").each(function() {
this.name && (t = this.name, "checkbox" === (a = $(this)).attr("type") || "radio" === a.attr("type") ? o[t] = a.prop("checked") : o[t] = a.val());
}), JSON.stringify(o);
}, i.restoreForm = function(e, t) {
var a, o, n = JSON.parse(e);
t.find("input, select, textarea").each(function() {
this.name && (a = this.name, "hidden" !== (o = $(this)).attr("type") && ("checkbox" === o.attr("type") || "radio" === o.attr("type") ? o.prop("checked", n[a]) : o.val(n[a])));
});
}, i.showModalLoader = function(e) {
$(".modal-loader").toggleClass("hidden", !e);
}, i.buildFields = function(a, e) {
var o = this, n = "";
return $.each(e, function(e, t) {
n += o.buildField(a + "_" + e, t);
}), n;
}, i.buildField = function(e, t) {
var a, o = $("<label/>", {
class: "control-label",
for: e
}).text(t.label);
return (a = "textarea" === t.type ? $("<textarea/>", {
rows: 7
}).text(t.value) : $("<input/>", {
type: "text",
value: t.value
})).attr({
id: e,
class: "form-control",
readonly: !0
}), $("<div/>", {
class: "form-group"
}).append(o).append(a).wrap("<div/>").parent().html();
}, i.isInt = function(e, t) {
var a;
return void 0 !== t && "keyup" === t.type && "-" === t.key && "-" === e || !isNaN(e) && (0 | (a = parseFloat(e))) === a;
};
}();

$(function() {
if ($('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="popover"]').popover({
html: !0
}), $(".language-editor").length && 765 < window.screen.width) {
var e = $(".language-editor__body-navbar"), t = $(".language-editor__body-container"), a = $(".language-editor__container"), o = $(document).height() - 125;
e.css("max-height", o + "px"), a.css("max-height", o - 100 + "px"), t.css("max-height", o + "px");
}
$("#dark").on("click", function(e) {
e.preventDefault();
var t = $("body"), a = !t.hasClass("dark-mode");
$("i", this).attr("class", a ? "fal fa-sun" : "fas fa-moon"), t.toggleClass("dark-mode", a), 
void 0 !== window.CodeMirrorEditor && window.CodeMirrorEditor.setOption("theme", a ? "material-darker" : "default"), 
custom.ajax({
url: "/admin/site/dark-mode?now=" + (a ? 1 : 0),
type: "GET",
success: function(e) {},
error: function(e, t, a) {
console.log("Something was wrong...", t, a, e);
}
});
});
}), function(s) {
s.fn.jQueryClearButton = function(e) {
if (!this.is(":visible")) return this;
var t = this, a = "clear-button-" + t.attr("id"), o = s.extend({
always: !1,
zindex: 0,
offset_right: 7,
button_width: 15,
button_height: 18,
color: "#aaa"
}, e);
s("body").append("<style> input::-ms-clear { visibility:hidden; } </style>");
var n = s('<div style="position:relative; margin:0; padding:0; border:none;">');
this.before(n), this.prependTo(n);
var i = s('<div class="fa fa-times ' + a + '"></div>');
this.before(i), i.css({
position: "absolute",
display: "none",
cursor: "pointer",
"z-index": o.zindex,
width: o.button_width + "px",
height: o.button_height + "px",
color: o.color
});
var r = n.height();
r || (r = t.height());
var l = r / 2 - o.button_height / 2 + 2;
return i.css({
top: l + "px",
right: o.offset_right + "px"
}), i.on("click", function() {
t.val("").focus(), o.always || i.hide();
}), t.on("input", function() {
t.val() ? i.show() : o.always || i.hide();
}), o.always ? i.show() : (t.on("focus", function() {
t.val() ? i.show() : i.hide();
}), t.on("blur", function() {
setTimeout("$('." + a + "').hide()", 200);
}), t.on("mouseover", function() {
t.val() ? i.show() : i.hide();
})), this;
};
}(jQuery), function() {
var t = function(e) {
return new RegExp("(^| )" + e + "( |$)");
}, e = function(e, t, a) {
for (var o = 0; o < e.length; o++) t.call(a, e[o]);
};
function a(e) {
this.element = e;
}
a.prototype = {
add: function() {
e(arguments, function(e) {
this.contains(e) || (this.element.className += " " + e);
}, this);
},
remove: function() {
e(arguments, function(e) {
this.element.className = this.element.className.replace(t(e), "");
}, this);
},
toggle: function(e) {
return this.contains(e) ? (this.remove(e), !1) : (this.add(e), !0);
},
contains: function(e) {
return t(e).test(this.element.className);
},
replace: function(e, t) {
this.remove(e), this.add(t);
}
}, "classList" in Element.prototype || Object.defineProperty(Element.prototype, "classList", {
get: function() {
return new a(this);
}
}), window.DOMTokenList && null == DOMTokenList.prototype.replace && (DOMTokenList.prototype.replace = a.prototype.replace);
}(), function(o, a) {
function e(e) {
var t = a[e];
a[e] = function(e) {
return i(t(e));
};
}
function n(e, t, a) {
return (a = this).attachEvent("on" + e, function(e) {
(e = e || o.event).preventDefault = e.preventDefault || function() {
e.returnValue = !1;
}, e.stopPropagation = e.stopPropagation || function() {
e.cancelBubble = !0;
}, t.call(a, e);
});
}
function i(e, t) {
if (t = e.length) for (;t--; ) e[t].addEventListener = n; else e.addEventListener = n;
return e;
}
o.addEventListener || (i([ a, o ]), "Element" in o ? o.Element.prototype.addEventListener = n : (a.attachEvent("onreadystatechange", function() {
i(a.all);
}), e("getElementsByTagName"), e("getElementById"), e("createElement"), i(a.all)));
}(window, document), window.initCheckAll = function() {
if (document.querySelector(".checkAll")) {
var o = document.querySelector(".checkAll"), n = o.parentNode.parentNode, i = document.querySelectorAll(".selectOrder"), r = document.getElementById("checkAllText").value, l = document.querySelector(".countOrders"), s = 0;
function e() {
for (var e = !1, t = s = 0; t < i.length; t++) {
var a = i[t].parentNode.parentNode;
i[t].checked ? (s++, e = !0, a.classList.add("active")) : a.classList.remove("active");
}
return e ? (o.checked = !0, l.innerText = 1 == s ? s + " " + r + " " : s + " " + r + "s ", 
n.classList.add("show-action-menu"), !0) : (o.checked = !1, n.classList.remove("show-action-menu"), 
!1);
}
o.addEventListener ? o.addEventListener("change", function() {
if (s = 0, this.checked) {
for (var e = 0; e < i.length; e++) i[e].disabled || (i[e].parentNode.parentNode.classList.add("active"), 
n.classList.add("show-action-menu"), i[e].checked = !0, s++);
l.innerText = s + " " + r + "s ";
} else {
for (e = 0; e < i.length; e++) i[e].parentNode.parentNode.classList.remove("active"), 
n.classList.remove("show-action-menu"), i[e].checked = !1;
s = 0, this.checked = !1, l.innerText = "";
}
}) : o.attachEvent && o.attachEvent("onchange", e);
for (var t = 0; t < i.length; t++) i[t].addEventListener ? i[t].addEventListener("change", e) : i[t].attachEvent && i[t].attachEvent("onchange", e);
}
}, window.initCheckAll(), $(document).ready(function() {
var e = $("#public-page");
if (e) {
var t = function() {
var e = $("#public-page").val(), t = $("#seo-block");
parseInt(e, 10) ? t.show() : t.hide();
};
t(), e.on("change", function() {
t();
});
}
BreakpointSwitcher.create({
"768px": function(e) {
e ? window.navPriority('[data-nav="navbar-priority"]', {
containerSelector: null,
containerWidthOffset: 310,
dropdownLabel: '<span class="fa fa-ellipsis-v"></span>'
}) : window.navPriority('[data-nav="navbar-priority"]', "destroy");
}
});
}), function(e, t, a) {
"use strict";
var o = {
throttle: function(o, n, i) {
var r, l;
return n || (n = 250), function() {
var e = i || this, t = +new Date(), a = arguments;
r && t < r + n ? (clearTimeout(l), l = setTimeout(function() {
r = t, o.apply(e, a);
}, n)) : (r = t, o.apply(e, a));
};
},
debounce: function(a, o) {
var n = null;
return function() {
var e = this, t = arguments;
clearTimeout(n), n = setTimeout(function() {
a.apply(e, t);
}, o);
};
},
extend: function() {
for (var e = 1; e < arguments.length; e++) for (var t in arguments[e]) arguments[e].hasOwnProperty(t) && (arguments[0][t] = arguments[e][t]);
return arguments[0];
},
isElement: function(e) {
return !(!e || 1 !== e.nodeType);
},
hasClass: function(e, t) {
return -1 < e.className.indexOf(t);
},
isSmallScreen: function() {
return e.innerWidth <= this.options.navBreakpoint;
},
handleResize: function() {
o.throttle(this.reflowNavigation.bind(this), delay), o.debounce(this.reflowNavigation.bind(this), delay);
var e = this.isSmallScreen(), t = !1;
if (!this.smallScreen && !e || this.smallScreen && e || (this.smallScreen = e, t = !0), 
!t) return !1;
}
};
e.Util = o;
}(window, document), window.matchMedia = window.matchMedia || function(r, e) {
var a = r.documentElement, t = a.firstElementChild || a.firstChild, o = r.createElement("body"), n = r.createElement("div");
n.id = "mq-test-1", n.style.cssText = "position:absolute;top:-100em", o.style.background = "none", 
o.appendChild(n);
var l, s = function(e) {
return n.innerHTML = '&shy;<style media="' + e + '"> #mq-test-1 { width: 42px; }</style>', 
a.insertBefore(o, t), bool = 42 === n.offsetWidth, a.removeChild(o), {
matches: bool,
media: e
};
}, d = function() {
var e = a.body, t = !1;
return n.style.cssText = "position:absolute;font-size:1em;width:1em", e || ((e = t = r.createElement("body")).style.background = "none"), 
e.appendChild(n), a.insertBefore(e, a.firstChild), t ? a.removeChild(e) : e.removeChild(n), 
l = parseFloat(n.offsetWidth);
}, c = s("(min-width: 0px)").matches;
return function(e) {
if (c) return s(e);
var t = e.match(/\(min\-width:[\s]*([\s]*[0-9\.]+)(px|em)[\s]*\)/) && parseFloat(RegExp.$1) + (RegExp.$2 || ""), a = e.match(/\(max\-width:[\s]*([\s]*[0-9\.]+)(px|em)[\s]*\)/) && parseFloat(RegExp.$1) + (RegExp.$2 || ""), o = null === t, n = null === a, i = r.body.offsetWidth;
return t && (t = parseFloat(t) * (-1 < t.indexOf("em") ? l || d() : 1)), a && (a = parseFloat(a) * (-1 < a.indexOf("em") ? l || d() : 1)), 
bool = (!o || !n) && (o || t <= i) && (n || i <= a), {
matches: bool,
media: e
};
};
}(document);

var BreakpointSwitcher = function(t, a, o, e, n) {
"use strict";
var i = function(e) {
this.breakpoints = a.extend({}, "object" == typeof e && e), this.currentView = null, 
t.addEventListener("resize", a.throttle(this.switch, 20, this)), t.addEventListener("load", a.throttle(this.switch, 20, this));
};
return i.create = function(e) {
if (!o) throw new Error("matchMedia is required for BreakpointSwitcher");
if ("object" == typeof e) return new i(e);
throw new Error("Options object has to be passed to the constructor");
}, i.prototype.matchView = function(e) {
var t = null;
for (var a in e) o("(min-width: " + a + ")").matches && (t = e[a]);
return t;
}, i.prototype.switch = function() {
var e = this.matchView(this.breakpoints);
return this.currentView !== e ? (this.currentView && "function" == typeof this.currentView && this.currentView.call(t, !1), 
"function" == typeof e && e.call(t, !0), this.currentView = e) : null;
}, i;
}(window, window.Util, window.matchMedia, document);

!function(a, s, d, e) {
"use strict";
var c = [], u = function(e, t) {
this.options = t, this.element = "string" == typeof e ? d.querySelector(e) : e, 
this.resizeListener = null, this.container = this.options.containerSelector ? this.element.querySelectorAll(this.options.containerSelector)[0] : this.element, 
this.navList = this.element.querySelectorAll("ul")[0], this.overflowMenu = this.createOverflowMenu(), 
this.overflowList = this.overflowMenu.querySelectorAll("ul")[0], this.overflowDropdown = this.element.parentNode.querySelector("[data-nav-priority-toggle]"), 
this.overflowBreakpoints = [], this.elementStyle = a.getComputedStyle(this.element), 
this.breakpoints = this.getBreakpoints(), this.setupEventListeners(), this.reflowNavigation();
};
u.DEFAULTS = {
dropdownLabel: 'More <i class="caret"></i>',
dropdownMenuClass: "dropdown-menu dropdown-menu-right",
dropdownMenuTemplate: '<li data-nav-priority-menu class="navbar-nav-more dropdown" aria-hidden="true"><a id="{{dropdownMenuId}}" href="#" class="navbar-toggle-more" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-nav-priority-toggle>{{dropdownLabel}}</a><ul class="{{dropdownMenuClass}}" aria-labelledby="{{dropdownMenuId}}"></ul></li>',
containerSelector: "ul",
containerWidthOffset: 10,
threshold: 4
}, u.create = function(e, t) {
var a = e.querySelectorAll("li"), o = !0;
if (!s.isElement(e)) throw o = !1, new Error("element has to be DOM Element");
return (0 === a.length || a.length <= t.threshold) && (o = !1), o ? new u(e, t) : null;
}, u.prototype.createOverflowMenu = function() {
var e = this.navList.querySelector("[data-nav-priority-menu]");
if (!e) {
var t, a = "nav-link-more-" + c.length, o = this.options.dropdownMenuTemplate, n = this.navList.children[this.navList.children.length - 1];
o = o.replace("{{dropdownLabel}}", this.options.dropdownLabel).replace("{{dropdownMenuClass}}", this.options.dropdownMenuClass).replace(new RegExp("{{dropdownMenuId}}", "g"), a), 
(t = d.createElement("div")).innerHTML = o, n.setAttribute("class", n.className + " is-last"), 
this.navList.appendChild(t.firstChild), e = this.navList.querySelector("[data-nav-priority-menu]");
}
if (!e) throw new Error("overflowMenu does not exist, check your custom dropdownMenuTemplate parameter");
return e;
}, u.prototype.getBreakpoints = function() {
for (var e = [], t = this.navList.children, a = t.length, o = Math.ceil(this.overflowDropdown.getBoundingClientRect().width), n = o, i = 0; i < a; i++) {
var r = t[i];
s.hasClass(r, "navbar-nav-more") || (n += Math.ceil(r.getBoundingClientRect().width), 
e.push(n));
}
return e[e.length - 1] -= o, e;
}, u.prototype.setupEventListeners = function() {
this.resizeListener = s.throttle(this.reflowNavigation, 10, this), a.addEventListener("resize", this.resizeListener);
}, u.prototype.addToOverflow = function(e, t) {
return this.overflowList.insertBefore(e, this.overflowList.firstChild), this.overflowBreakpoints.unshift(t), 
this.breakpoints.pop(), this.overflowBreakpoints;
}, u.prototype.removeFromOverflow = function(e, t) {
return this.breakpoints.push(t), this.overflowBreakpoints.shift(), this.navList.insertBefore(e, this.overflowDropdown.parentNode), 
this.overflowBreakpoints;
}, u.prototype.toggleOverflowDropdown = function(e) {
return this.overflowMenu.setAttribute("aria-hidden", e);
}, u.prototype.reflowNavigation = function() {
if (!this.resizeListener) return !1;
for (var e = Math.ceil(this.container.getBoundingClientRect().width - this.options.containerWidthOffset), t = this.navList.children, a = t.length; a--; ) if (!s.hasClass(t[a], "navbar-nav-more")) {
var o = this.breakpoints[a];
e <= o && this.addToOverflow(t[a], o);
}
for (var n = this.overflowList.children.length; n--; ) this.overflowBreakpoints[0] < e && this.removeFromOverflow(this.overflowList.children[0], this.overflowBreakpoints[0]);
this.toggleOverflowDropdown(0 == this.overflowList.children.length);
}, u.prototype.destroy = function() {
if (this.element.removeAttribute("data-nav-priority"), a.removeEventListener("resize", this.resizeListener), 
this.resizeListener = null, this.overflowList.children.length) for (;this.overflowList.children.length; ) this.removeFromOverflow(this.overflowList.children[0], this.overflowBreakpoints[0]);
return this.toggleOverflowDropdown(0 == this.overflowList.children.length), this.element;
}, a.navPriority = function(e, t) {
var a = d.querySelectorAll(e);
if ("string" == typeof t && "destroy" == t) {
for (var o = 0; o < c.length; o++) {
(n = c[o]).destroy.call(n);
}
c = [];
}
if ("string" != typeof t) for (o = 0; o < a.length; o++) {
var n, i = a[o], r = s.extend({}, u.DEFAULTS, "object" == typeof t && t);
if (!(n = i.getAttribute("data-nav-priority"))) {
var l = u.create(i, r);
c.push(l), n = i.setAttribute("data-nav-priority", !0);
}
}
return c;
};
}(window, window.Util, document), customModule.accountController = {
run: function(e) {
if (e.action && e.passwd) {
var a = $("#yw0"), o = $(".modal-loader", a);
o.removeClass("hidden"), custom.ajax({
url: e.action,
data: {
passwd: e.passwd
},
type: "POST",
success: function(e) {
var t = $(e);
$(".alert", t).each(function() {
a.prepend($(this).get(0).outerHTML);
}), o.addClass("hidden"), t = void 0;
},
error: function(e, t, a) {
o.addClass("hidden"), console.log("Something was wrong...", t, a, e);
}
});
}
}
}, customModule.adminApiController = {
run: function(e) {
var t;
$(".navbar-fixed-top").hide(), $(function() {
$('[data-toggle="tooltip"]').tooltip();
}), $(window).scroll(function() {
var e = $(".method-title");
if (0 == $(window).scrollTop() && $("#documentation-nav li").removeClass("active"), 
$(window).scrollTop() == $(document).height() - $(window).height()) $("#documentation-nav li").removeClass("active"), 
$("#list-method-addpayment").addClass("active"); else for (var t = 0; t < e.length; t++) $(e[t]).offset().top <= $(window).scrollTop() + 25 && ($("#documentation-nav li").removeClass("active"), 
$("#list-" + e[t].id).addClass("active"));
}), $(document).ready(function() {
$("#documentation-nav").on("click", "a", function(e) {
e.preventDefault();
var t = $(this).attr("href"), a = $(t).offset().top - 10;
$("body,html").animate({
scrollTop: a
}, 500);
});
}), $(document).ready(function() {
$("#documentation-nav").sticky({
topSpacing: 15
});
}), t = function(u) {
var t = Array.prototype.slice, o = Array.prototype.splice, l = {
topSpacing: 0,
bottomSpacing: 0,
className: "is-sticky",
wrapperClassName: "sticky-wrapper",
center: !1,
getWidthFrom: "",
widthFromWrapper: !0,
responsiveWidth: !1,
zIndex: "inherit"
}, m = u(window), f = u(document), p = [], h = m.height(), e = function() {
for (var e = m.scrollTop(), t = f.height(), a = t - h, o = a < e ? a - e : 0, n = 0, i = p.length; n < i; n++) {
var r = p[n], l = r.stickyWrapper.offset().top - r.topSpacing - o;
if (r.stickyWrapper.css("height", r.stickyElement.outerHeight()), e <= l) null !== r.currentTop && (r.stickyElement.css({
width: "",
position: "",
top: "",
"z-index": ""
}), r.stickyElement.parent().removeClass(r.className), r.stickyElement.trigger("sticky-end", [ r ]), 
r.currentTop = null); else {
var s, d = t - r.stickyElement.outerHeight() - r.topSpacing - r.bottomSpacing - e - o;
if (d < 0 ? d += r.topSpacing : d = r.topSpacing, r.currentTop !== d) r.getWidthFrom ? (padding = r.stickyElement.innerWidth() - r.stickyElement.width(), 
s = u(r.getWidthFrom).width() - padding || null) : r.widthFromWrapper && (s = r.stickyWrapper.width()), 
null == s && (s = r.stickyElement.width()), r.stickyElement.css("width", s).css("position", "fixed").css("top", d).css("z-index", r.zIndex), 
r.stickyElement.parent().addClass(r.className), null === r.currentTop ? r.stickyElement.trigger("sticky-start", [ r ]) : r.stickyElement.trigger("sticky-update", [ r ]), 
r.currentTop === r.topSpacing && r.currentTop > d || null === r.currentTop && d < r.topSpacing ? r.stickyElement.trigger("sticky-bottom-reached", [ r ]) : null !== r.currentTop && d === r.topSpacing && r.currentTop < d && r.stickyElement.trigger("sticky-bottom-unreached", [ r ]), 
r.currentTop = d;
var c = r.stickyWrapper.parent();
r.stickyElement.offset().top + r.stickyElement.outerHeight() >= c.offset().top + c.outerHeight() && r.stickyElement.offset().top <= r.topSpacing ? r.stickyElement.css("position", "absolute").css("top", "").css("bottom", 0).css("z-index", "") : r.stickyElement.css("position", "fixed").css("top", d).css("bottom", "").css("z-index", r.zIndex);
}
}
}, a = function() {
h = m.height();
for (var e = 0, t = p.length; e < t; e++) {
var a = p[e], o = null;
a.getWidthFrom ? a.responsiveWidth && (o = u(a.getWidthFrom).width()) : a.widthFromWrapper && (o = a.stickyWrapper.width()), 
null != o && a.stickyElement.css("width", o);
}
}, s = {
init: function(r) {
return this.each(function() {
var e = u.extend({}, l, r), t = u(this), a = t.attr("id"), o = a ? a + "-" + l.wrapperClassName : l.wrapperClassName, n = u("<div></div>").attr("id", o).addClass(e.wrapperClassName);
t.wrapAll(function() {
if (0 == u(this).parent("#" + o).length) return n;
});
var i = t.parent();
e.center && i.css({
width: t.outerWidth(),
marginLeft: "auto",
marginRight: "auto"
}), "right" === t.css("float") && t.css({
float: "none"
}).parent().css({
float: "right"
}), e.stickyElement = t, e.stickyWrapper = i, e.currentTop = null, p.push(e), s.setWrapperHeight(this), 
s.setupChangeListeners(this);
});
},
setWrapperHeight: function(e) {
var t = u(e), a = t.parent();
a && a.css("height", t.outerHeight());
},
setupChangeListeners: function(t) {
window.MutationObserver ? new window.MutationObserver(function(e) {
(e[0].addedNodes.length || e[0].removedNodes.length) && s.setWrapperHeight(t);
}).observe(t, {
subtree: !0,
childList: !0
}) : window.addEventListener ? (t.addEventListener("DOMNodeInserted", function() {
s.setWrapperHeight(t);
}, !1), t.addEventListener("DOMNodeRemoved", function() {
s.setWrapperHeight(t);
}, !1)) : window.attachEvent && (t.attachEvent("onDOMNodeInserted", function() {
s.setWrapperHeight(t);
}), t.attachEvent("onDOMNodeRemoved", function() {
s.setWrapperHeight(t);
}));
},
update: e,
unstick: function(e) {
return this.each(function() {
for (var e = u(this), t = -1, a = p.length; 0 < a--; ) p[a].stickyElement.get(0) === this && (o.call(p, a, 1), 
t = a);
-1 !== t && (e.unwrap(), e.css({
width: "",
position: "",
top: "",
float: "",
"z-index": ""
}));
});
}
};
window.addEventListener ? (window.addEventListener("scroll", e, !1), window.addEventListener("resize", a, !1)) : window.attachEvent && (window.attachEvent("onscroll", e), 
window.attachEvent("onresize", a)), u.fn.sticky = function(e) {
return s[e] ? s[e].apply(this, t.call(arguments, 1)) : "object" != typeof e && e ? void u.error("Method " + e + " does not exist on jQuery.sticky") : s.init.apply(this, arguments);
}, u.fn.unstick = function(e) {
return s[e] ? s[e].apply(this, t.call(arguments, 1)) : "object" != typeof e && e ? void u.error("Method " + e + " does not exist on jQuery.sticky") : s.unstick.apply(this, arguments);
}, u(function() {
setTimeout(e, 0);
});
}, "function" == typeof define && define.amd ? define([ "jquery" ], t) : "object" == typeof module && module.exports ? module.exports = t(require("jquery")) : t(jQuery);
}
}, customModule.affiliatesController = {
run: function(o) {
$(".js_action").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("params");
custom.confirm(o.confirm_message, "", function() {
return custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
location.reload();
}
}), !1;
});
});
}
}, customModule.apiDoc = {
run: function(e) {
var t = document.querySelector(".api");
if (null != t) var a = window.setInterval(function() {
"undefined" != typeof Redoc && (Redoc.init(t.getAttribute("src"), {
theme: {
colors: {
primary: {
main: "#007AFF"
}
},
typography: {
fontFamily: "Roboto, sans-serif",
fontWeightRegular: "400",
fontWeightLight: "400",
fontWeightBold: "700",
headings: {
fontFamily: '"Basier Square" ,sans-serif'
}
},
rightPanel: {
backgroundColor: "#39383d"
}
}
}, t), window.clearInterval(a));
}, 500);
}
}, customModule.appearanceEditPageController = {
run: function(t) {
var a = $(".is-public"), o = $(".seo-keywords"), n = t.formName.toLowerCase();
if ($(".delete-btn").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("title");
custom.confirm(a, "", function() {
return custom.sendBtn(t, {
type: "POST",
callback: function(e) {
e && e.redirect ? window.location.href = e.redirect : location.reload();
}
}), !1;
});
}), "createblogform" !== n && "editblogform" !== n ? $(".content").summernote({
minHeight: 300,
focus: !0,
toolbar: [ [ "style", [ "style", "bold", "italic" ] ], [ "lists", [ "ul", "ol" ] ], [ "para", [ "paragraph" ] ], [ "color", [ "forecolor", "backcolor", "clear" ] ], [ "insert", [ "link", "picture", "video" ] ], [ "codeview", [ "codeview" ] ] ],
disableDragAndDrop: !0,
styleTags: [ "p", "h1", "h2", "h3", "h4", "h5", "h6" ],
popover: {
image: [ [ "custom", [ "imageAttributes" ] ], [ "imagesize", [ "imageSize100", "imageSize50", "imageSize25" ] ], [ "float", [ "floatLeft", "floatRight", "floatNone" ] ], [ "remove", [ "removeMedia" ] ] ]
},
dialogsFade: !0,
imageAttributes: {
icon: '<i class="note-icon-pencil"/>',
removeEmpty: !0,
disableUpload: !0
}
}) : $(".content").summernote({
minHeight: 300,
focus: !0,
toolbar: [ [ "style", [ "style", "bold", "italic", "underline" ] ], [ "fontname", [ "fontname" ] ], [ "lists", [ "ul", "ol" ] ], [ "para", [ "paragraph" ] ], [ "color", [ "forecolor", "backcolor", "clear" ] ], [ "insert", [ "link", "picture", "video" ] ], [ "insert", [ "shorthr" ] ], [ "codeview", [ "codeview" ] ] ],
disableDragAndDrop: !0,
callbacks: {
onChange: function(e) {
-1 === e.indexOf('class="shorthr"') && $(this).next().find(".btn-shorthr-disabled").length && $(this).next().find(".btn-shorthr-disabled").removeClass("btn-shorthr-disabled");
}
},
fontNames: [ "Serif", "Sans", "Arial", "Arial Black", "Courier", "Courier New", "Comic Sans MS", "Helvetica", "Impact", "Lucida Grande", "Sacramento" ],
styleTags: [ "p", "h1", "h2", "h3", "h4", "h5", "h6" ],
popover: {
image: [ [ "custom", [ "imageAttributes" ] ], [ "imagesize", [ "imageSize100", "imageSize50", "imageSize25" ] ], [ "float", [ "floatLeft", "floatRight", "floatNone" ] ], [ "remove", [ "removeMedia" ] ] ]
},
dialogsFade: !0,
imageAttributes: {
icon: '<i class="note-icon-pencil"/>',
removeEmpty: !0,
disableUpload: !0
}
}), $(".content-rtl").summernote({
minHeight: 300,
focus: !0,
toolbar: [ [ "style", [ "style", "bold", "italic" ] ], [ "lists", [ "ul", "ol" ] ], [ "para", [ "paragraph" ] ], [ "color", [ "forecolor", "backcolor", "clear" ] ], [ "insert", [ "link", "picture", "video" ] ], [ "codeview", [ "codeview" ] ] ],
disableDragAndDrop: !0,
styleTags: [ "p", "h1", "h2", "h3", "h4", "h5", "h6" ],
popover: {
image: [ [ "custom", [ "imageAttributes" ] ], [ "imagesize", [ "imageSize100", "imageSize50", "imageSize25" ] ], [ "float", [ "floatLeft", "floatRight", "floatNone" ] ], [ "remove", [ "removeMedia" ] ] ]
},
dialogsFade: !0,
imageAttributes: {
icon: '<i class="note-icon-pencil"/>',
removeEmpty: !0,
disableUpload: !0
},
onMediaDelete: function(e, t, a) {
console.log("log");
}
}), o.length) {
var i = document.querySelector(".seo-keywords");
function r(e) {
for (var t = "", a = 0; a < e.length; a++) "" === t ? t = e[a].value : t += "," + e[a].value;
o.val(t);
}
new Tagify(i, {}).on("add", function(e) {
r(JSON.parse(i.value));
}).on("remove", function(e) {
r(JSON.parse(i.value));
});
}
if (a.length && "createblogform" !== n && "editblogform" !== n) {
a.on("change", function() {
!function() {
var e = a.val(), t = $("#seo-block-container");
parseInt(e, 10) ? t.show() : t.hide();
}();
}), a.trigger("change");
}
BreakpointSwitcher.create({
"768px": function(e) {
e ? window.navPriority('[data-nav="navbar-priority"]', {
containerSelector: null,
containerWidthOffset: 180,
dropdownLabel: '<span class="fa fa-ellipsis-v"></span>'
}) : window.navPriority('[data-nav="navbar-priority"]', "destroy");
}
});
var l = !1, s = !1;
$("#" + n + "-url").on("input", function(e, t) {
if (a = $(this).val(), t) {
if ("createblogform" == n) {
var a = d.generateUrl($(this).val());
$(this).val(a);
}
} else l = !0;
$(".edit-seo__url").text(a);
}), $("#" + n + "-seo_description").on("input", function(e) {
$(".seo-preview__description").text($(this).val());
}), $("#" + n + "-seo_title").on("input", function(e, t) {
t || (s = !0), $(".seo-preview__title").text($(this).val());
});
var d = this;
"create" === t.mode && $(".default-page-name").on("input", function(e) {
var t = $(this).val();
if (!l) {
var a = $("#" + n + "-url");
a.val(d.filterUrl(t)), a.trigger("input", !0);
}
if (!s) {
var o = $("#" + n + "-seo_title");
o.val(t), o.trigger("input", !0);
}
}), $("#" + t.formName + " input").on("keyup", function(e) {
13 === (e.keyCode || e.which) && $("#" + t.formName).submit();
}), $("#createPageForm, #createBlogForm").submit(function(e) {
$(".content").summernote("codeview.isActivated") && $(".content").summernote("codeview.deactivate");
}), $("input:file").on("change", function() {
var t = $(this).attr("data-target");
if (this.files && this.files[0]) {
var e = new FileReader();
e.onload = function(e) {
$(t).attr("src", e.target.result);
}, $(t).parent().find(".setting-block__image-remove").addClass("hidden"), $(t).closest(".image_container").removeClass("hidden"), 
e.readAsDataURL(this.files[0]);
}
}), $(".delete_image_action").click(function(e) {
var t = $(this).attr("href"), o = $(this).closest(".image_container").find(".modal-loader"), a = $(this).closest(".setting-block__image-remove"), n = $(this);
e.preventDefault(), o.removeClass("hidden"), a.addClass("hidden");
var i = {
blog_id: n.data("blog-id")
};
custom.ajax({
url: t,
data: i,
type: "POST",
success: function(e, t, a) {
n.closest(".image_container").addClass("hidden"), o.addClass("hidden"), location.reload();
},
error: function(e, t, a) {
n.closest(".image_container").addClass("hidden"), o.addClass("hidden"), location.reload();
}
});
});
},
filterUrl: function(e) {
return (e.match(/[a-zA-Z0-9-]+/g) || []).join("").toLowerCase();
},
generateUrl: function(e) {
var t = e;
return custom.ajax({
url: "/admin/appearance/exist-post-url?url=" + e,
async: !1,
method: "GET",
success: function(e) {
"success" == e.status && (t = e.data.url);
}
}), t;
}
}, customModule.appearancePagesController = {
run: function(e) {
$(document).on("change", ".toggle-page-visibility", function(e) {
e.preventDefault();
var t = $(this);
return custom.ajax({
method: "POST",
url: t.data("action"),
success: function(e) {
if ("error" == e.status) return t.prop("checked", !t.prop("checked")), !1;
t.parents("tr").toggleClass("grey");
}
}), !1;
}), $(".toggle-page-visibility").removeAttr("disabled");
}
}, customModule.childPanelsController = {
run: function(o) {
$(".js_action").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("params");
custom.confirm(o.confirm_message, "", function() {
return custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
location.reload();
}
}), !1;
});
});
}
}, customModule.deferredLoadController = {
processing: !1,
load: function(o) {
var n = this;
null === custom.request && custom.ajax({
url: o.queueLink,
type: "GET",
success: function(e) {
if ("success" === e.status) {
var t = "string" == typeof e.data;
if (n.$targetBlock.html(t ? e.data : e.data.html), n.clear(), void 0 !== o.afterLoad) {
var a = "";
t || void 0 !== e.data.afterLoadParams && (a = JSON.stringify(e.data.afterLoadParams)), 
new Function(o.afterLoad.replace("#PARAMS#", a))();
}
n.$targetBlock.data("loaded", !0), n.$targetBlock = null;
}
},
error: function(e, t, a) {
t && "abort" === t.toLowerCase() || (console.log("Something was wrong...", t, a, e), 
n.stop(), n.$targetBlock = null, custom.notify({
0: {
type: "danger",
delay: 0,
text: a
}
}));
}
});
},
run: function(t) {
var a = this;
return a.interval = null, a.queueDataWaitTimer = null, a.nainTimer = null, a.$targetBlock = null, 
a.processing = !0, t.queueLink && t.targetBlock && 0 < t.userRequestInterval && (a.$targetBlock = $(t.targetBlock), 
a.mainTimer = setTimeout(function() {
if (a.interval = setInterval(function() {
a.load(t);
}, 1e3 * parseInt(t.userRequestInterval)), void 0 !== t.queueDataWaitTime) {
var e = parseInt(t.queueDataWaitTime) - 1;
e = 0 <= e ? e : 0, a.queueDataWaitTimer = setTimeout(function() {
a.stop(), a.$targetBlock = null, custom.notify({
0: {
type: "danger",
delay: 0,
text: "Error loading page. Please refresh the page."
}
});
}, 1e3 * e);
}
a.load(t);
}, 1e3)), a;
},
clear: function() {
this.interval && clearInterval(this.interval), this.queueDataWaitTimer && clearTimeout(this.queueDataWaitTimer), 
this.interval = null, this.queueDataWaitTimer = null, this.processing = !1;
},
stop: function() {
this.mainTimer && clearTimeout(this.mainTimer), this.mainTimer = null, this.clear();
}
}, customModule.docsController = {
run: function(e) {
$(document).ready(function() {
$(".link-anchor").on("click", function(e) {
e.preventDefault();
var t = $(this).attr("href"), a = $(t).offset().top - 60;
$("body,html").animate({
scrollTop: a
}, 500);
});
});
}
}, customModule.dripFeedController = {
run: function(o) {
$(".js_action").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("params");
custom.confirm(o.confirm_message, "", function() {
return custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
location.reload();
}
}), !1;
});
}), $(".js_mass_action").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("params");
a || (a = {}), a.dripFeeds = [], $(".mass_item:checkbox:checked").each(function() {
a.dripFeeds.push($(this).val());
}), custom.confirm(o.confirm_message, "", function() {
return custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
location.reload();
}
}), !1;
});
}), $(".dropdown-load").on("show.bs.dropdown", function(e) {
var o = $(".dropdown-menu", this);
o.data("loaded") || custom.ajax({
url: $(this).data("load") + window.location.search,
type: "GET",
success: function(e, t, a) {
o.html(e).data("loaded", !0);
},
error: function(e, t, a) {
console.log("Something was wrong...", t, a, e), o.parents(".dropdown-load").removeClass("open");
}
});
});
}
}, customModule.appearanceEditLanguageController = {
run: function(o) {
$("#btn-reset-changes").click(function(e) {
var t = $(this), a = {};
a.code = t.data("language"), custom.confirm(o.confirm_message, "", function() {
custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
window.location = location.href;
}
});
}), e.preventDefault();
}), $("#search").submit(function(e) {
e.preventDefault();
var t = $("#live-search").val(), a = $("label[id*='" + t + "']").attr("id");
return a || (a = $("input[value*='" + t + "']").data("name")), a && (location.href = "#" + a), 
!1;
}), $("#default-language").click(function(e) {
e.preventDefault();
var t = $(this), a = {};
a.code = t.data("language"), custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
window.location = location.href;
}
});
}), $("#live-search").jQueryClearButton();
}
}, customModule.settingsEditNotificationController = {
run: function(a) {
$("#btn-reset").click(function(e) {
var t = $(this);
return e.preventDefault(), custom.confirm(a.confirm_message_reset, "", function() {
custom.sendBtn(t, {
type: "POST",
callback: function(e) {
if (!e || !e.redirect_url) return location.reload(), !1;
window.location.href = e.redirect_url;
}
});
}), !1;
}), $("#btn-test").click(function(e) {
return e.preventDefault(), $("#notification-send-test").modal("show"), !1;
}), $("#testNotificationForm").submit(function(e) {
e.preventDefault();
var t = $(this), a = $("#test-submit");
return custom.sendFrom(a, t, {
data: t.serialize(),
callback: function() {
location.reload();
}
}), !1;
});
}
}, customModule.appearanceLanguageController = {
run: function(e) {
$("#editLanguage").submit(function(e) {
e.preventDefault();
var t = $(this), a = $("#edit-language-btn");
custom.sendFrom(a, t, {
data: t.serialize(),
callback: function() {
window.location = location.href;
}
});
});
}
}, customModule.appearanceLanguagesController = {
run: function(e) {
$(".selectpicker").selectpicker({
style: "btn-default",
size: "auto"
}), $("#sortable").sortable({
handle: ".table__drag",
placeholder: "table__drag-placeholder",
start: function(e, t) {
$(this).attr("data-previndex", t.item.index());
},
update: function(e, t) {
var a = parseInt(t.item.index()), o = parseInt($(this).attr("data-previndex"));
o !== a && function(e, t) {
var a = {
oldIndex: e + 1,
newIndex: t + 1
};
custom.ajax({
url: "/admin/appearance/language-edit-position",
data: a,
type: "POST",
success: function(e) {
"success" != e.status && custom.notify({
0: {
type: "danger",
text: e.message
}
});
}
});
}(o, a), $(this).removeAttr("data-previndex");
}
}), $("#addLanguage").submit(function(e) {
e.preventDefault();
var t = $(this), a = $("#addpayment_submit_button");
custom.sendFrom(a, t, {
data: t.serialize(),
callback: function(e) {
window.location = location.href;
}
});
}), $(document).on("change", "input[name=active]", function(e) {
$(this).data("code");
var t = $(this).prop("checked") ? 1 : 0;
!function(e, t, a) {
var o = {
code: e,
visibility: t
};
custom.ajax({
url: "/admin/appearance/language-edit-visibility",
data: o,
type: "POST",
success: function(e) {
"success" != e.status ? (console.log(e.status), custom.notify({
0: {
type: "danger",
text: e.message
}
})) : a.toggleClass("grey");
}
});
}($(this).data("code"), t, $(this).closest(".ui-state-default"));
});
}
}, customModule.appearanceMenuController = {
run: function(n) {
function r(e, t, a) {
for (e.find("option:not([disabled])").remove(), a && e.append('<option selected value="' + a.id + '" >' + a.name + "</option>"), 
i = 0; i < t.length; i++) e.append('<option value="' + t[i].id + '" >' + t[i].name + "</option>"), 
"external" === t[i].id && $("#external-page-url").val(t[i].url);
1 < e.find("option").length && !a && $(".default-menu-name").val(t[0].name), "external" === e.val() ? ($(".external-url-label").removeClass("hidden"), 
$("#external-page-url").removeClass("hidden")) : ($(".external-url-label").addClass("hidden"), 
$("#external-page-url").addClass("hidden"));
}
function l(n) {
$("input.translations").each(function(e, t) {
var a = $(t), o = a.data("lang");
n ? a.val(n[o]) : a.val("");
});
}
$(".add-modal-menu").click(function(e) {
var t = $(this), a = parseInt($(t).data("public"));
!function(e, t) {
var a = {
public: e
};
custom.ajax({
url: "/admin/appearance/menu-pages",
data: a,
type: "Get",
success: function(e) {
"success" != e.status ? custom.notify({
0: {
type: "danger",
text: e.message
}
}) : r(t, e.data);
}
});
}(a, $("#select-pages")), $("#menu-delete-div").hide(), $("#myModalLabel").text(n.add_modal_header), 
$("#addmenu_submit_button").text(n.add_modal_header), $("#editmenuform-public").val(a), 
$("#editMenuForm").attr("action", "/admin/appearance/create-menu"), l(null), $("#menu-id").prop("disabled", !0), 
$("#editMenuError").addClass("hidden"), $("#edit_menu_item").modal("show");
}), $(".edit-modal-menu").click(function(e) {
var t = $(this), a = parseInt($(t).data("public"));
$("#myModalLabel").text(n.edit_modal_header), $("#editmenuform-public").val(a), 
$("#addmenu_submit_button").text(n.edit_modal_header), $("#editMenuForm").attr("action", "/admin/appearance/edit-menu"), 
function(t) {
var e = {
id: t
};
custom.ajax({
url: "/admin/appearance/get-menu",
data: e,
type: "Get",
success: function(e) {
"success" != e.status ? custom.notify({
0: {
type: "danger",
text: e.message
}
}) : (r($("#select-pages"), e.data.pages, e.data.currentPage), l(e.data.translations), 
$("#menu-delete-div").show(), $("#menu-delete-div").data("id", t));
}
});
}(t.data("id"));
var o = $("#menu-id");
o.prop("disabled", !1), o.val(t.data("id")), $("#editMenuError").addClass("hidden"), 
$("#edit_menu_item").modal("show");
}), $("#editMenuForm").submit(function(e) {
e.preventDefault();
var t = $(this), a = $("#addmenu_submit_button");
return custom.sendFrom(a, t, {
data: t.serialize(),
callback: function() {
location.reload();
}
}), !1;
}), $(document).on("click", "#delete-menu", function(e) {
var t = {
id: $("#menu-delete-div").data("id")
};
custom.ajax({
url: "/admin/appearance/delete-menu",
data: t,
type: "Post",
success: function(e) {
"success" != e.status ? custom.notify({
0: {
type: "danger",
text: e.message
}
}) : location.reload();
}
});
}), $("#public_menu, #signed_menu").sortable({
placeholder: "dd-placeholder",
start: function(e, t) {
$(this).attr("data-previndex", t.item.index());
},
update: function(e, t) {},
stop: function(e, t) {
var a = $.map($(this).find("li"), function(e) {
return {
position: $(e).index(),
id: $(e).attr("data-id")
};
}), o = "public_menu" === $(e.target).closest(".dd-list").attr("id"), n = parseInt(t.item.index());
!function(e, t, a, o) {
var n = {
tree: e,
oldIndex: a,
newIndex: o,
public: t ? 1 : 0
};
custom.ajax({
url: "/admin/appearance/position-menu",
data: n,
type: "POST",
success: function(e) {
"success" != e.status && custom.notify({
0: {
type: "danger",
text: e.message
}
});
}
});
}(a, o, parseInt($(this).attr("data-previndex")) + 1, n + 1), $(this).removeAttr("data-previndex");
}
}), $("#select-pages").change(function(e) {
$(this).val() ? $(".default-menu-name").val($(this).find(":selected").text()) : $(".default-menu-name").val(""), 
"external" === $(this).val() ? ($(".external-url-label").removeClass("hidden"), 
$("#external-page-url").removeClass("hidden")) : ($(".external-url-label").addClass("hidden"), 
$("#external-page-url").addClass("hidden"));
});
}
}, customModule.settingsModulesController = {
run: function(a) {
var n = this;
$(".edit-module").click(function(e) {
var t = $(this), a = t.data("form"), o = t.data("module");
$(".deactivate-module-btn").removeClass("hidden"), n.composeForm(a, o, !0), n.prepareModal(t);
}), $(".activate-module").click(function(e) {
var t = $(this), a = t.data("form"), o = t.data("module");
$(".deactivate-module-btn").addClass("hidden"), n.composeForm(a, o, !1), n.prepareModal(t);
}), $(document).on("click", "#moduleSubmitBtn", function(e) {
e.preventDefault();
var t = $("#editModuleForm");
custom.sendFrom($(this), t, {
data: t.serialize(),
success: function(e) {
"success" !== e.status ? ($("#editModuleError").html(e.message), $("#editModuleError").removeClass("hidden")) : location.reload();
}
});
}), $(".deactivate-module-btn").click(function(e) {
e.preventDefault();
var t = $(this);
custom.confirm(a.deactivate_confirm_message, "", function() {
return custom.sendBtn(t, {
type: "POST",
callback: function() {
location.reload();
}
}), !1;
});
});
},
prepareModal: function(e) {
$(".edit-module-modal-title").text(e.data("title")), $("#editModuleForm").attr("action", e.data("action")), 
$("#editModuleError").addClass("hidden"), $("#editModuleModal").modal("show");
},
composeForm: function(e, t, a) {
var o = $(".edit-module-modal-body"), n = $(".deactivate-module-btn"), i = n.attr("href").replace(/\?id=[0-9]+/g, "");
for (key in o.html(""), n.attr("href", i + "?id=" + t), e) {
var r = e[key], l = a ? r.value : r.default_value;
"input" === r.type && o.append(templates["admin/modules_modal_input"]({
label: r.label,
name: r.project_column,
value: Number(l)
})), "select" === r.type && o.append(templates["admin/modules_modal_select"]({
label: r.label,
name: r.project_column,
selectItems: r.select_items,
value: l
}));
}
}
}, customModule.settingsNotificationsController = {
run: function(n) {
$("#addEmailModal").click(function(e) {
$(".settings-emails__list-body").children().each(function() {
var e = $(this).find("input[type=checkbox]");
e.prop("checked", !0), $(this).removeClass("settings-emails__notification-disabled");
}), $("#staff-delete-div").hide(), $(".modal-title").text(n.add_modal_header), $("#editStaffEmailForm").attr("action", "/admin/settings/create-staff-email"), 
$("#editStaffError").addClass("hidden"), $("#staff-id").prop("disabled", !0), $("#staffemailform-email").val(""), 
$("#add-email-modal").modal("show");
}), $(".editEmailModal").click(function(e) {
var t = $(this);
$("modal-title").text(n.edit_modal_header), $("#editStaffEmailForm").attr("action", "/admin/settings/edit-staff-email");
var a = $("#staff-id"), o = $("#staff-delete-div");
o.data("id", t.data("id")), o.show(), a.prop("disabled", !1), a.val(t.data("id")), 
function(e) {
var t = {
id: e
};
custom.ajax({
url: "/admin/settings/get-notifications",
data: t,
type: "Get",
async: !1,
success: function(e) {
"success" != e.status ? custom.notify({
0: {
type: "danger",
text: e.message
}
}) : function(a) {
$(".settings-emails__list-body").children().each(function() {
var e = $(this).find("input[type=checkbox]"), t = e.data("name");
-1 !== a.indexOf(t.toString()) ? (e.prop("checked", !0), $(this).removeClass("settings-emails__notification-disabled")) : (e.prop("checked", !1), 
$(this).addClass("settings-emails__notification-disabled"));
});
}(e.data);
}
});
}(t.data("id")), $("#staffemailform-email").val(t.data("email")), $("#editStaffError").addClass("hidden"), 
$("#add-email-modal").modal("show");
}), $("#editStaffEmailForm").submit(function(e) {
e.preventDefault();
var t = $(this), a = $("#staff_submit_button");
return custom.sendFrom(a, t, {
data: t.serialize(),
callback: function() {
location.reload();
}
}), !1;
}), $(".switch-input").change(function() {
$(this).closest(".settings-emails__list-row").toggleClass("settings-emails__notification-disabled");
}), $(document).on("click", "#delete-staff", function(e) {
var t = {
id: $("#staff-delete-div").data("id")
};
custom.ajax({
url: "/admin/settings/delete-staff-email",
data: t,
type: "Post",
success: function(e) {
"success" != e.status ? custom.notify({
0: {
type: "danger",
text: e.message
}
}) : location.reload();
}
});
});
}
}, customModule.ordersControllerExport = {
run: function(e) {
e.exportFromDate || new Date();
var t = e.exportToDate || new Date();
$(function() {
$('[data-toggle="tooltip"]').tooltip();
}), $(".selectpicker").selectpicker({
style: "btn-default",
size: "auto"
}), $("#exportFrom").datetimepicker({
format: "YYYY-MM-DD",
maxDate: t
}), $("#exportTo").datetimepicker({
format: "YYYY-MM-DD",
maxDate: t
});
var a = "", o = {
ajax: {
url: "/admin/users/get-users",
type: "POST",
dataType: "json",
data: {
q: "{{{q}}}"
}
},
preserveSelected: !0,
minLength: 2,
locale: {
emptyTitle: "All users"
},
cache: !1,
preprocessData: function(e) {
var t, a = e.length, o = [];
if (a) for (t = 0; t < a; t++) o.push($.extend(!0, e[t], {
text: e[t].login,
value: e[t].id
}));
return o;
}
}, n = $("#ajax-select-multiple");
n.selectpicker().filter(".with-ajax").ajaxSelectPicker(o), n.trigger("change").data("AjaxBootstrapSelect").list.cache = {}, 
$(document).on("input", ".with-ajax .bs-searchbox input", function() {
a = $(this).val();
}), $(".selectpicker").on("shown.bs.select", function(e) {
$(".with-ajax .bs-searchbox input").val(a);
});
}
}, customModule.ordersControllerMassCancel = {
run: function(e) {
var a = e.error_max_limit, o = e.max_limit, n = $(".error-summary");
$("#links").keyup(function(e) {
var t = $(this).val().split("\n").length;
if (o < t) {
if (n.hasClass("hidden")) return n.removeClass("hidden").html(a), $("button:submit").attr("disabled", !0), 
!1;
} else n.hasClass("hidden") || (n.addClass("hidden").html(""), $("button:submit").attr("disabled", !1));
});
}
}, customModule.ordersController = {
delayedRun: !1,
run: function(o) {
var t = customModule.deferredLoadController;
this.delayedRun || "object" != typeof window.modules || void 0 === window.modules.deferredLoadController ? ($(".dropdown-load button").on("click", function(e) {
t.processing && e.stopPropagation();
}), $(".dropdown-load").on("hide.bs.dropdown", function(e) {
t.processing && t.stop();
}).on("show.bs.dropdown", function(e) {
var o = $(".dropdown-menu", this);
o.data("loaded") || t.processing || custom.ajax({
url: $(this).data("load"),
type: "GET",
success: function(e) {
"success" === e.status ? (o.html(e.data), o.data("loaded", !0)) : e.hasOwnProperty("jsParams") && t.run(e.jsParams);
},
error: function(e, t, a) {
o.parents(".dropdown-load").removeClass("open"), "abort" !== t && (console.log("Something was wrong...", t, a, e), 
custom.notify({
0: {
type: "danger",
text: a
}
}));
}
});
}), $(".js-show-details").on("click", function(e) {
e.preventDefault(), $("#myModalLabelOrderDetail").html($(this).data("title")), $("#orderDetailContent .modal-body-data").html(""), 
$("#orderDetailContent .modal-loader-wrap").show(), $("#orderDetail").modal("show"), 
custom.ajax({
url: $(this).data("load"),
type: "GET",
dataType: "json",
success: function(e) {
$("#orderDetailError").addClass("hidden"), $("#orderDetailContent .modal-body-data").html(custom.buildFields("orderDetailItem", e)), 
$("#orderDetailContent .modal-loader-wrap").hide();
},
error: function(e, t, a) {
"abort" !== t && (console.log("Something was wrong...", t, a, e), $("#orderDetailError").removeClass("hidden").text(o.loading_details_error), 
$("#orderDetailContent .modal-loader-wrap").hide());
}
});
}), $(".js-show-info-data").on("click", function(e) {
e.preventDefault(), $("#myModalLabelOrderInfo").html($(this).text()), $("#orderInfoContent .modal-body-data").html(""), 
$("#orderInfoContent .modal-loader-wrap").show(), $(this).data("resend") ? ($("#orderInfoForm").attr("action", $(this).data("href")).show(), 
$("#orderInfoClose").hide()) : ($("#orderInfoForm").hide(), $("#orderInfoClose").show()), 
$("#checkSendError").modal("show"), custom.ajax({
url: $(this).data("load"),
type: "GET",
dataType: "json",
success: function(e) {
$("#sendInfoError").addClass("hidden"), $("#orderInfoContent .modal-body-data").html(custom.buildFields("orderInfoItem", e)), 
$("#orderInfoContent .modal-loader-wrap").hide();
},
error: function(e, t, a) {
"abort" !== t && (console.log("Something was wrong...", t, a, e), $("#sendInfoError").removeClass("hidden").text(o.loading_details_error), 
$("#orderInfoContent .modal-loader-wrap").hide());
}
});
}), $(".bulkorder-action").on("click", function(e) {
e.preventDefault(), $("#bulkStatus").val($(this).data("status")), custom.confirm(o.confirm_message, "", function() {
return $("#changebulkForm").submit(), !1;
}, {
confirm_button: o.confirm_button,
cancel_button: o.cancel_button
});
}), $(".confirm-change").on("click", function(e) {
e.preventDefault();
var t = $(this).data("href");
custom.confirm(o.confirm_message, "", function() {
return window.location = t, !1;
}, {
confirm_button: o.confirm_button,
cancel_button: o.cancel_button
});
}), $("#editLink").on("show.bs.modal", function(e) {
$("#form_edit_link").attr("action", $(e.relatedTarget).data("href")), $("#form_edit_link_inp").val($(e.relatedTarget).data("link"));
}), $("#setStart").on("show.bs.modal", function(e) {
$("#start_id").val($(e.relatedTarget).data("id")), $("#inputStartCount").val("").trigger("change");
}), $("#setRemains").on("show.bs.modal", function(e) {
var t = $(e.relatedTarget);
$("#remains_id").val(t.data("id")), $("#inputRemainsCount").val("").attr("max", t.data("max")).trigger("change");
}), $("#setPartial").on("show.bs.modal", function(e) {
$("#partial_id").val($(e.relatedTarget).data("id")), $("#inputRemains").val("").trigger("change");
}), $("#inputStartCount, #inputRemainsCount, #inputRemains").on("keyup change", function(e) {
var t = $(this).parents(".modal-body").find(".error-summary");
"" === $(this).val() || custom.isInt($(this).val(), e) ? ($(this).removeClass("has-error"), 
t.addClass("hidden").text("")) : ($(this).addClass("has-error"), t.removeClass("hidden").text($(this).data("number-error")));
}), $("#setRemains form, #setPartial form").on("submit", function(e) {
var t = $(".has-error", this);
0 < t.length && (e.preventDefault(), t.first().focus());
}), $("#setStart form").on("submit", function(e) {
e.preventDefault();
var t = $(".has-error", this);
if (0 < t.length) t.first().focus(); else {
var a = $("#setStart"), o = $(this), n = o.find(":submit");
custom.sendFrom(n, o, {
data: $(this).serialize(),
callback: function(e) {
var t = $("#start_id", o).val();
$(".order" + t + " .start-count").text(e.data.start), a.modal("hide");
}
});
}
})) : this.delayedRun = !0;
},
reRun: function() {
"object" == typeof window.modules && void 0 !== window.modules.ordersController && (window.initCheckAll(), 
this.delayedRun = !0, this.run(window.modules.ordersController));
}
}, customModule.paymentsControllerExport = {
run: function(e) {
e.exportFromDate || new Date();
var t = e.exportToDate || new Date();
$(function() {
$('[data-toggle="tooltip"]').tooltip();
}), $(".selectpicker").selectpicker({
style: "btn-default",
size: "auto"
}), $("#exportFrom").datetimepicker({
format: "YYYY-MM-DD",
maxDate: t
}), $("#exportTo").datetimepicker({
format: "YYYY-MM-DD",
maxDate: t
});
var a = "", o = {
ajax: {
url: "/admin/users/get-users",
type: "POST",
dataType: "json",
data: {
q: "{{{q}}}"
}
},
preserveSelected: !0,
minLength: 2,
locale: {
emptyTitle: "All users"
},
cache: !1,
preprocessData: function(e) {
var t, a = e.length, o = [];
if (a) for (t = 0; t < a; t++) o.push($.extend(!0, e[t], {
text: e[t].login,
value: e[t].id
}));
return o;
}
}, n = $("#ajax-select-multiple");
n.selectpicker().filter(".with-ajax").ajaxSelectPicker(o), n.trigger("change").data("AjaxBootstrapSelect").list.cache = {}, 
$(document).on("input", ".with-ajax .bs-searchbox input", function() {
a = $(this).val();
}), $(".selectpicker").on("shown.bs.select", function(e) {
$(".with-ajax .bs-searchbox input").val(a);
});
}
}, customModule.paymentsController = {
run: function(o) {
$("#addPayment").click(function() {
$("#addpaymentsform-username").val(""), $("#addpaymentsform-memo").val(""), $("#addpaymentsform-amount").val(""), 
$("#addpaymentsform-method").val("0"), $("#addPaymentsError").addClass("hidden");
}), $("#addpayment_submit").submit(function(e) {
e.preventDefault();
var t = $("#addpayment_submit_button"), a = $(this);
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function() {
$("#addPayment").modal("hide"), location.reload();
}
}), !1;
}), $("#editpayment_submit").submit(function(e) {
e.preventDefault();
var t = $("#editpayment_submit_button"), a = $(this);
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#editPayment").modal("hide"), location.reload();
}
}), !1;
}), $("#reportpayment_submit").submit(function(e) {
e.preventDefault();
var t = $("#reportpayment_submit_button"), a = $(this);
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#reportPayment").modal("hide"), location.reload();
}
}), !1;
}), $(".payment-edit").click(function(e) {
e.preventDefault();
var t = $(this).data("payment");
$("#editpaymentsform-memo").val(t.memo), $("#payment-edit-id").val(t.id);
var a = $("#editpaymentsform-method");
a.val(t.method), null === a.val() && a.val(0), $("#editPayment").modal("show");
}), $(".js_report").click(function(e) {
$("#reportpaymentform-comment").val(""), $("#reportPaymentsError").addClass("hidden"), 
e.preventDefault();
var t = $(this).data("payment");
$("#payment-report-id").val(t.id), $("#reportPayment").modal("show");
}), $(".complete-payment").click(function(e) {
e.preventDefault();
var t = $(this).data("payment"), a = $("#completePaymentModal");
$("#completePaymentForm").attr("action", $(this).attr("href")), $("#complete-payment-id", a).val(t.id), 
$("#complete-payment-type", a).val(t.type), $("#editpaymentsform-memo", a).val(""), 
a.modal("show");
}), $(".accept-payment").click(function(e) {
var t = $(this), a = t.data("params");
custom.confirm(o.confirm_message, "", function() {
return custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
location.reload();
}
}), !1;
}), e.preventDefault();
}), $(document).on("click", "#completePaymentBtn", function(e) {
e.preventDefault();
var t = $(this), a = $("#completePaymentForm");
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#completePaymentModal").modal("hide"), location.reload();
}
}), !1;
}), $(".payments-details").click(function(e) {
var t = $(this);
e.preventDefault(), custom.sendBtn(t, {
data: {
id: t.data("id")
},
type: "GET",
callback: function(e) {
var t = $("#checkResponse");
t.modal("show"), $(".field_detils", t).html(e.data.response), e.data.ip && $(".field_ip", t).val(e.data.ip);
}
});
}), $("#addpaymentsform-username").change(function(e) {
var o = $("#addpayment_submit_button");
o.prop("disabled", "disabled"), custom.ajax({
url: "/admin/payments/find-user?username=" + $(this).val(),
type: "GET",
success: function(e) {
var t = $("#addpaymentsform-includereferralpayment"), a = $("#addPaymentsError");
"success" == e.status && e.referrer ? (t.prop("disabled", ""), t.closest(".form-group").show()) : (t.prop("disabled", "disabled"), 
t.closest(".form-group").hide()), "error" == e.status ? (a.html(e.message), a.removeClass("hidden")) : (a.addClass("hidden"), 
o.prop("disabled", ""));
}
});
}), $(".dropdown-load").on("show.bs.dropdown", function(e) {
var o = $(".dropdown-menu", this);
o.data("loaded") || custom.ajax({
url: $(this).data("load") + window.location.search,
type: "GET",
success: function(e, t, a) {
o.html(e).data("loaded", !0);
},
error: function(e, t, a) {
console.log("Something was wrong...", t, a, e), o.parents(".dropdown-load").removeClass("open");
}
});
});
}
}, customModule.reportsController = {
run: function(e) {
if (e.months && $("#datetimepicker-tickets").datetimepicker({
viewMode: "months",
maxDate: new Date(),
format: "MM/YYYY"
}), e.users) {
var t = "", a = {
ajax: {
url: "/admin/users/get-users",
type: "POST",
dataType: "json",
data: {
q: "{{{q}}}"
}
},
preserveSelected: !0,
minLength: 2,
locale: {
emptyTitle: "All users"
},
cache: !1,
preprocessData: function(e) {
var t, a = e.length, o = [];
if (a) for (t = 0; t < a; t++) o.push($.extend(!0, e[t], {
text: e[t].login,
value: e[t].id
}));
return o;
}
}, o = $("#ajax-select-multiple");
o.length && (o.selectpicker().filter(".with-ajax").ajaxSelectPicker(a), o.trigger("change").data("AjaxBootstrapSelect").list.cache = {}, 
$(document).on("input", ".with-ajax .bs-searchbox input", function() {
t = $(this).val();
}), o.on("shown.bs.select", function(e) {
$(".with-ajax .bs-searchbox input").val(t);
}));
}
e.enabledServices && this.enableServices(e.enabledServices);
},
enableServices: function(e) {
var a = $(".selectpicker_service select");
void 0 !== e && ($("option", a).attr("disabled", !0), $.each(e, function(e, t) {
$('option[value="' + t + '"]', a).removeAttr("disabled");
}), $("option[disabled]", a).removeAttr("selected")), a.removeAttr("disabled").selectpicker("refresh");
}
}, customModule.settingsBonusesController = {
run: function(e) {
var i, r, l, s, d = e.modal_titles, c = e.submit_titles;
$('[data-toggle="tooltip"]').tooltip(), window, i = $("#editBonusModal"), r = i.find("form"), 
l = i.find(":submit"), s = custom.freezeForm(r), r.submit(function(e) {
e.preventDefault(), custom.sendFrom(l, r, {
data: $(this).serialize(),
callback: function(e) {
i.modal("hide"), location.reload();
}
});
}), i.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget), a = t.data("action_url"), o = t.data("get_url"), n = o ? 1 : 0;
custom.restoreForm(s, r), r.attr("action", a), r.find(".error-summary").addClass("hidden"), 
i.find(".modal-title").html(d[n]), l.html(c[n]), n && (custom.showModalLoader(!0), 
custom.ajax({
url: o,
type: "GET",
success: function(e, t, a) {
if (!e.data || !_.isObject(e.data)) return i.modal("hide"), void console.log("Undefined data...", t, a);
!function(e) {
r.find("#editbonusform-amount").val(e.amount), r.find("#editbonusform-method").val(e.method), 
r.find("#editbonusform-deposit_from").val(e.deposit_from), r.find("#editbonusform-status").val(e.status);
}(e.data), custom.showModalLoader(!1);
},
error: function(e, t, a) {
custom.showModalLoader(!1), i.modal("hide"), console.log("Something was wrong...", t, a, e);
}
}));
});
}
}, customModule.settingsGeneralController = {
run: function(e) {
$("input:file").on("change", function() {
var t = $(this).attr("data-target");
if (this.files && this.files[0]) {
var e = new FileReader();
e.onload = function(e) {
$(t).attr("src", e.target.result);
}, $(t).parent().find(".setting-block__image-remove").addClass("hidden"), $(t).closest(".image_container").removeClass("hidden"), 
e.readAsDataURL(this.files[0]);
}
}), $("#editgeneralform-affiliate_system").change(function() {
$("#affiliate").toggleClass("hidden");
}), $("#editgeneralform-child_panels_selling").change(function() {
$("#child_panels").toggleClass("hidden");
}), $("#editgeneralform-ticket_system").change(function() {
$("#ticket_per_user").toggleClass("hidden");
}), $("#editgeneralform-registration_page").change(function() {
$("#free_balance").toggleClass("hidden");
}), $("#editgeneralform-free_balance").change(function() {
$("#free_balance_amount").toggleClass("hidden");
}), window, $(".delete_image_action").click(function(e) {
var t = $(this).attr("href"), o = $(this).closest(".image_container").find(".modal-loader"), a = $(this).closest(".setting-block__image-remove");
e.preventDefault(), o.removeClass("hidden"), a.addClass("hidden"), custom.ajax({
url: t,
type: "POST",
success: function(e, t, a) {
o.addClass("hidden"), location.reload();
},
error: function(e, t, a) {
o.addClass("hidden"), location.reload();
}
});
});
}
}, customModule.settingsPaymentsController = {
run: function(e) {
var s = this;
$("#addPaymentMethod").click(function(e) {
e.preventDefault();
var t = $(this).data("url"), a = $("#addPaymentMethodForm"), o = $("#addPaymentMethodModal"), n = $("#addPaymentMethodError", a);
return $("select", a).prop("selectedIndex", 0), a.attr("action", t), n.addClass("hidden"), 
n.html(""), o.modal("show"), !1;
}), $(document).on("click", "#addPaymentMethodBtn", function(e) {
e.preventDefault();
var t = $(this), a = $("#addPaymentMethodForm");
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#addPaymentMethodModal").modal("hide"), location.reload();
}
}), !1;
}), $(".edit-payment-method").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("url"), o = $("#editPaymentMethodForm"), n = $("#editPaymentMethodModal"), i = $("#editPaymentMethodError", o), r = t.data("details"), l = $("#editPaymentMethodDescription", n);
return $("#editPaymentMethodAlert", o).remove(), "object" == typeof r.alert && r.alert && $(".modal-body", o).prepend('<div class="alert alert-' + r.alert.type + '" role="alert" id="editPaymentMethodAlert">' + r.alert.message + "</div>"), 
$("select", o).prop("selectedIndex", 0), o.attr("action", a), i.addClass("hidden"), 
i.html(""), $(".field-editpaymentmethodform-take_fee_from_user", o).hide(), l.addClass("hidden"), 
$(".description-content", l).html(""), $("#editPaymentMethodLabel", n).html(r.title + " (ID: " + r.id + ")"), 
$("#editpaymentmethodform-name", n).val(r.name), $("#editpaymentmethodform-minimal", n).val(r.minimal), 
$("#editpaymentmethodform-maximal", n).val(r.maximal), $("#editpaymentmethodform-new_users", n).val(r.new_users), 
$("#editpaymentmethodform-take_fee_from_user", n).val(r.take_fee_from_user), r.is_enabled_take_fee_from_user && $(".field-editpaymentmethodform-take_fee_from_user", o).show(), 
"string" == typeof r.description && r.description.length && ($(".description-content", l).html(r.description), 
l.removeClass("hidden")), s.renderOptions(n, r.options), $("#edit-payment-method-options-gateway", n).data("changed", !1).trigger("change"), 
n.modal("show"), !1;
}), $(document).on("submit", "#editPaymentMethodForm", function(e) {
e.preventDefault();
var t = $(this), a = $("#editPaymentMethodForm");
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#editPaymentMethodModal").modal("hide"), location.reload();
}
}), !1;
}), $(document).on("click", ".add-multi-input", function(e) {
e.preventDefault();
var t = $(this), a = $(t.data("id"));
return a.length && a.append(s.renderMultiInput(t.data(), "")), !1;
}), $(document).on("click", ".add-amount", function(e) {
e.preventDefault();
var t = $(this), a = $(t.data("id"));
return a.length && a.append(s.renderAmountInput(t.data(), {
amount: "",
description: ""
})), !1;
}), $(document).on("change", ".toggle-payment-method", function(e) {
e.preventDefault();
var t = $(this);
return custom.ajax({
method: "POST",
url: t.data("action"),
success: function(e) {
if ("error" == e.status) return t.prop("checked", !t.prop("checked")), !1;
t.parents("tr").toggleClass("grey");
}
}), !1;
}), $(document).on("change", "#edit-payment-method-options-amount", function(e) {
e.preventDefault();
var t = $("#editPaymentMethodModal"), a = $(this);
return $("#amount_container_row, #editPaymentMethodMinMax", t).addClass("hidden"), 
$("#amount_container_row", t).find("input.amount-description").prop("required", !1), 
!0 === a.data("new_gates") || (1 == a.val() ? ($("#amount_container_row", t).removeClass("hidden"), 
$("#amount_container_row", t).find("input.amount-description").prop("required", !0), 
$("#multi_input_container_descriptions", t).addClass("hidden"), $("#multi_input_container_descriptions", t).find("input").prop("required", !1), 
$(".add-multi-input", t).addClass("hidden")) : ($("#editPaymentMethodMinMax", t).removeClass("hidden"), 
$("#multi_input_container_descriptions", t).removeClass("hidden"), $("#multi_input_container_descriptions", t).find("input").prop("required", !0), 
$(".add-multi-input", t).removeClass("hidden"))), !1;
}), $(document).on("change", "#edit-payment-method-options-gateway", function(e) {
e.preventDefault();
var t = $("#edit-payment-method-options-amount");
t.length || (t = $("<input/>", {
id: "edit-payment-method-options-amount",
type: "hidden"
}), $(this).append(t));
var a = t.parent(".form-group"), o = $(this), n = o.val(), i = n && "#1" === n.substr(-2, 2);
return a.toggleClass("hidden", i), t.data("new_gates", i), i ? t.val(1) : o.data("changed") && t.val(0), 
o.data("changed", !0), t.trigger("change"), !1;
}), $(document).on("click", ".remove__paypal-description", function(e) {
return e.preventDefault(), $(this).parents(".form-group__paypal-description").remove(), 
!1;
}), $(document).on("click", ".remove__generator-row", function(e) {
return e.preventDefault(), $(this).parents(".form-group__generator-row").remove(), 
!1;
}), $('[data-toggle="tooltip"]').tooltip(), $("#sortable").sortable({
handle: ".table__drag",
placeholder: "table__drag-placeholder",
start: function(e, t) {
$(this).attr("data-previndex", t.item.index());
},
update: function(e, t) {
var a = 1 * t.item.index(), o = 1 * $(this).attr("data-previndex"), n = $(".table__drag", t.item).data("action");
$(this).removeAttr("data-previndex"), $.post(n, {
position: 1 + a,
old_position: 1 + o
});
}
}), $("#addPaymentMethod, .edit-payment-method, .toggle-payment-method").removeAttr("disabled");
},
renderOptions: function(e, t) {
var o = this;
if ($("#editPaymentMethodOptions", e).html(""), "undefined" !== t && t.length) {
var n = "", i = "";
$.each(t, function(e, a) {
"function" == typeof templates["admin/payment_settings_" + a.type] && ("multi_input" == a.type ? (i = "", 
$.each(a.values, function(e, t) {
i += o.renderMultiInput(a, t);
}), n += templates["admin/payment_settings_" + a.type + "_container"]({
data: a,
content: i
})) : "amounts" == a.type ? (i = "", $.each(a.values, function(e, t) {
i += o.renderAmountInput(a, t, e);
}), n += templates["admin/payment_settings_" + a.type + "_container"]({
data: a,
content: i
})) : n += templates["admin/payment_settings_" + a.type]({
data: a
}));
}), $("#editPaymentMethodOptions", e).html(n), $("#editPaymentMethodOptions textarea", e).summernote({
dialogsInBody: !0,
minHeight: 200,
toolbar: [ [ "style", [ "style", "bold", "italic" ] ], [ "lists", [ "ul", "ol" ] ], [ "para", [ "paragraph" ] ], [ "color", [ "forecolor", "backcolor", "clear" ] ], [ "insert", [ "link", "picture", "video" ] ], [ "codeview", [ "codeview" ] ] ],
disableDragAndDrop: !0,
styleTags: [ "p", "h1", "h2", "h3", "h4", "h5", "h6" ],
popover: {
image: [ [ "custom", [ "imageAttributes" ] ], [ "imagesize", [ "imageSize100", "imageSize50", "imageSize25" ] ], [ "float", [ "floatLeft", "floatRight", "floatNone" ] ], [ "remove", [ "removeMedia" ] ] ]
},
dialogsFade: !0,
imageAttributes: {
icon: '<i class="note-icon-pencil"/>',
removeEmpty: !0,
disableUpload: !0
}
});
}
},
renderMultiInput: function(e, t, a) {
return templates["admin/payment_settings_multi_input"]({
data: e,
value: t,
index: a
});
},
renderAmountInput: function(e, t, a) {
return templates["admin/payment_settings_amounts"]({
data: e,
value: t,
index: a
});
}
}, customModule.settingsProvidersController = {
run: function(e) {
var t, a, o, u = e.form_fields, s = e.balance_url, d = e.balance_info, c = e.balance_request_timeout, m = e.balance_timeout;
$('[data-toggle="tooltip"]').tooltip(), window, t = $("#addProviderModal"), a = t.find("form"), 
o = t.find(":submit"), a.submit(function(e) {
e.preventDefault(), custom.sendFrom(o, a, {
data: $(this).serialize(),
callback: function(e) {
t.modal("hide"), location.reload();
}
});
}), t.on("show.bs.modal", function(e) {
a.find(":text").val(""), a.find(".error-summary").addClass("hidden");
}), function(e) {
var i, r, l, s = $("#editProviderModal"), d = s.find("form"), t = s.find(":submit"), o = (s.find(".delete_provider"), 
s.find(".error-summary"));
function c() {
o.addClass("hidden"), o.html("");
}
d.submit(function(e) {
e.preventDefault(), custom.sendFrom(t, d, {
data: $(this).serialize(),
callback: function(e) {
s.modal("hide"), location.reload();
}
});
}), $(document).on("click", ".delete_provider_submit", function() {
_.defer(_.bind(function() {
custom.showModalLoader(!0), c(), custom.ajax({
url: l,
type: "POST",
data: {
id: ""
},
success: function(e, t, a) {
custom.showModalLoader(!1), "success" === e.status ? (s.modal("hide"), location.reload()) : "error" === e.status && (o.html(e.message), 
o.removeClass("hidden"));
},
error: function() {
custom.showModalLoader(!1), s.modal("hide"), console.log("Something was wrong...", textStatus, errorThrown, jqXHR);
}
});
}), this);
}), s.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget), a = t.data("action_url"), o = t.data("get_url"), n = t.closest("tr").attr("id");
r = t.data("authkeys_field"), l = t.data("delete_url"), d.attr("action", a), s.find("#provider_field").val(n), 
d.find(".form_field").hide(), d.find(".form_field :text").val(""), c(), custom.showModalLoader(!0), 
custom.ajax({
url: o,
type: "GET",
success: function(e, t, a) {
if (!e.data || !_.isObject(e.data)) return s.modal("hide"), void console.log("Undefined data...", t, a);
!function(o) {
_.isNumber(r) || (r = 0), i = u[r] || u[0], _.each(i, function(e, t) {
var a = d.find(".form-group." + t);
a.show().find("label").html(e), a.find(":text").val(o[t]);
});
}(e.data), custom.showModalLoader(!1);
},
error: function(e, t, a) {
custom.showModalLoader(!1), s.modal("hide"), console.log("Something was wrong...", t, a, e);
}
});
});
}(window), function(e) {
var t = $("#live-search"), a = $(".providers_list .list_item");
function o(e) {
var t = e.match(/^http.?:\/\/[^/]+/i);
if (!t) return null;
var a = document.createElement("a");
return a.href = t[0], a.hostname;
}
t.jQueryClearButton(), t.on("input", function(e) {
var t = $(this).val().trim();
o(t) && (t = o(t)), a.each(function() {
$(this).find(".name").text().search(new RegExp(t, "i")) < 0 ? $(this).hide() : $(this).show();
});
}), t.keyup(function(e) {
27 === e.which && (t.val(""), t.trigger("input")), 13 === e.which && e.preventDefault();
}), $(".live_search_container").on("click", ".clear-button-live-search", function(e) {
_.defer(function() {
t.trigger("input");
});
});
var n = function() {
var a = [];
$(".providers_list tr.unload").each(function(e, t) {
a.push($(t).data("provider-id"));
});
var n = $(".providers_list");
return 0 < a.length ? ($.ajax({
type: "POST",
url: s,
data: {
"providerIds[]": a
},
success: function(e) {
if (e.data) {
var t = e.data;
for (i = 0; i < t.length; i++) {
var a = n.find("tr[data-provider-id=" + t[i].provider_id + "]"), o = d;
t[i].balance && (o = t[i].balance), a.find("td").eq(1).html(o), a.removeClass("unload");
}
t.length && $('[data-toggle="tooltip"]').tooltip();
}
}
}), !0) : (r && clearInterval(r), l && clearTimeout(l), !1);
};
if (n()) var r = setInterval(n, 1e3 * c), l = setTimeout(function() {
clearInterval(r), $(".providers_list tr.unload").each(function(e, t) {
var a = $(t);
a.removeClass("unload"), a.find("td").eq(1).html(d);
}), $('[data-toggle="tooltip"]').tooltip();
}, 1e3 * m);
}(window);
}
}, customModule.subscriptionsController = {
run: function(o) {
$(".js_action").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("params");
custom.confirm(o.confirm_message, "", function() {
return custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
location.reload();
}
}), !1;
});
}), $("#subscriptionDetails").on("show.bs.modal", function(e) {
var o = $(this), t = $(e.relatedTarget).data("params");
custom.ajax({
url: t.get_details_url,
type: "GET",
success: function(e, t, a) {
if (void 0 === e.details) return o.modal("hide"), void console.log("Something was wrong...", t, a);
$("#body_subscription").empty().append(templates["admin/subscriptions_details"]({
details: e.details
}));
},
error: function(e, t, a) {
o.modal("hide"), console.log("Something was wrong...", t, a, e);
}
});
}), $("#subscriptionFailDetails").on("show.bs.modal", function(e) {
var o = $(this), t = $(e.relatedTarget).data("params");
custom.ajax({
url: t.get_details_url,
type: "GET",
success: function(e, t, a) {
if (void 0 === e.details) return o.modal("hide"), void console.log("Something was wrong...", t, a);
$("#body_fail_details").empty().append(templates["admin/subscriptions_fail_details"]({
details: e.details
}));
},
error: function(e, t, a) {
o.modal("hide"), console.log("Something was wrong...", t, a, e);
}
});
}), $("#subscriptionErrorDetails").on("show.bs.modal", function(e) {
var o = $(this), t = $(e.relatedTarget).data("params");
custom.ajax({
url: t.get_details_url,
type: "GET",
success: function(e, t, a) {
if (void 0 === e.details) return o.modal("hide"), void console.log("Something was wrong...", t, a);
$("#body_error_details").empty().append(templates["admin/subscriptions_error_details"]({
details: e.details
}));
},
error: function(e, t, a) {
o.modal("hide"), console.log("Something was wrong...", t, a, e);
}
});
}), $("#datePickerExpiry").datetimepicker({
format: "YYYY-MM-DD",
minDate: new Date()
}), $("#subscription-expiry-remove").on("click", function() {
var e = $(this).attr("data-target");
$(e).val("");
}), $("#editExpiry").on("show.bs.modal", function(e) {
var t = $(this), a = $(e.relatedTarget).data("params");
t.find("#datePickerExpiry").val(a.expiry), t.find("#subscription-expiry-id").val(a.id);
}), $("#editExpiry").find("form").submit(function(e) {
e.preventDefault();
var t = $(this), a = t.find(":submit");
custom.sendFrom(a, t, {
data: t.serialize(),
callback: function() {
location.reload();
}
});
}), $(".js_mass_action").click(function(e) {
e.preventDefault();
var t = $(this), a = t.data("params");
a || (a = {}), a.orders = [], $(".mass_item:checkbox:checked").each(function() {
a.orders.push($(this).val());
}), custom.confirm(o.confirm_message, "", function() {
return custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
location.reload();
}
}), !1;
});
}), $(".dropdown-load").on("show.bs.dropdown", function(e) {
var o = $(".dropdown-menu", this);
o.data("loaded") || custom.ajax({
url: $(this).data("load") + window.location.search,
type: "GET",
success: function(e, t, a) {
o.html(e).data("loaded", !0);
},
error: function(e, t, a) {
console.log("Something was wrong...", t, a, e), o.parents(".dropdown-load").removeClass("open");
}
});
});
}
}, customModule.tasksController = {
run: function(e) {
$(".taskDetails").click(function() {
!function(e) {
$.ajax({
url: e,
type: "GET",
dataType: "json",
success: function(e) {
!function(e) {
$("#task-provider").html(e.provider), $("#task-response").val(e.response), $("#last-updated").val(e.updated_at), 
$("#taskDetails").modal("show");
}(e);
}
});
}($(this).data("action"));
});
var a, o, n = $("#submitActionModal"), i = n.find("#actionSubmitButton"), r = {};
i.click(function(e) {
e.preventDefault(), custom.sendBtn(i, {
data: r,
type: "POST",
dataType: "json",
callback: function() {
n.modal("hide"), location.reload();
}
});
}), n.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget);
a = t.data("action"), o = t.data("status"), r = {}, void 0 !== a ? (t.hasClass("mass_action") && (r.tasks = [], 
$(".mass_item:checkbox:checked").each(function() {
r.tasks.push($(this).val());
})), o && (r.status = o), i.attr("href", a)) : n.modal("hide");
}), n.on("hide.bs.modal", function(e) {
$(this).find("#actionSubmitButton").attr("href", "");
}), $(".dropdown-load").on("show.bs.dropdown", function(e) {
var o = $(".dropdown-menu", this);
o.data("loaded") || custom.ajax({
url: $(this).data("load"),
type: "GET",
success: function(e) {
o.html(e).data("loaded", !0);
},
error: function(e, t, a) {
o.parents(".dropdown-load").removeClass("open"), "abort" !== t && (console.log("Something was wrong...", t, a, e), 
custom.notify({
0: {
type: "danger",
text: a
}
}));
}
});
}), $(".js-show-details").on("click", function(e) {
e.preventDefault(), $("#myModalLabelTaskDetail").html($(this).data("title")), $("#taskDetailContent .modal-body-data").html(""), 
$("#taskDetailContent .modal-loader-wrap").show(), $("#taskDetail").modal("show"), 
custom.ajax({
url: $(this).data("action"),
type: "GET",
dataType: "json",
success: function(e) {
$("#taskDetailError").addClass("hidden"), $("#taskDetailContent .modal-body-data").html(custom.buildFields("taskDetailItem", e)), 
$("#taskDetailContent .modal-loader-wrap").hide();
},
error: function(e, t, a) {
"abort" !== t && (console.log("Something was wrong...", t, a, e), $("#taskDetailError").removeClass("hidden").text(a), 
$("#taskDetailContent .modal-loader-wrap").hide());
}
});
});
}
}, customModule.appearanceThemeFileController = {
run: function(o) {
var e = {};
switch (o.extension) {
case "twig":
e = {
mode: "text/html",
lineNumbers: !0,
profile: "xhtml",
lineWrapping: !0,
extraKeys: {
"Ctrl-Q": function(e) {
e.foldCode(e.getCursor());
}
},
foldGutter: !0,
gutters: [ "CodeMirror-linenumbers", "CodeMirror-foldgutter" ],
onKeyEvent: function(e, t) {
if ((122 == t.keyCode || 27 == t.keyCode) && "keydown" == t.type) return t.stop(), 
a();
}
};
break;

case "css":
e = {
mode: "text/css",
lineNumbers: !0,
lineWrapping: !0,
extraKeys: {
"Ctrl-Q": function(e) {
e.foldCode(e.getCursor());
}
},
foldGutter: !0,
gutters: [ "CodeMirror-linenumbers", "CodeMirror-foldgutter" ],
onKeyEvent: function(e, t) {
if ((122 == t.keyCode || 27 == t.keyCode) && "keydown" == t.type) return t.stop(), 
a();
}
};
break;

case "js":
e = {
mode: "text/javascript",
lineNumbers: !0,
lineWrapping: !0,
extraKeys: {
"Ctrl-Q": function(e) {
e.foldCode(e.getCursor());
}
},
foldGutter: !0,
gutters: [ "CodeMirror-linenumbers", "CodeMirror-foldgutter" ],
onKeyEvent: function(e, t) {
if ((122 == t.keyCode || 27 == t.keyCode) && "keydown" == t.type) return t.stop(), 
a();
}
};
break;

default:
e = {
lineNumbers: !0,
lineWrapping: !0,
foldGutter: !0,
gutters: [ "CodeMirror-linenumbers", "CodeMirror-foldgutter" ],
onKeyEvent: function(e, t) {
if ((122 == t.keyCode || 27 == t.keyCode) && "keydown" == t.type) return t.stop(), 
a();
}
};
}
function a() {
var e = $(".CodeMirror-scroll");
e.hasClass("fullscreen") ? (e.removeClass("fullscreen"), e.height(a.beforeFullscreen.height), 
e.width(a.beforeFullscreen.width), editor.refresh(), $(".fullscreen-blockFull").remove()) : (a.beforeFullscreen = {
height: e.height(),
width: e.width()
}, e.addClass("fullscreen"), e.height("100%"), e.width("100%"), editor.refresh(), 
e.append('<div class="fullscreen-blockFull"><a href="#" class="btn btn-sm btn-default fullScreenButtonOff"><span class="fa fa-compress" style="font-size: 18px; position: absolute; left: 6px; top: 4px;"></span></a> </div>'));
}
$("body").hasClass("dark-mode") ? e.theme = "material-darker" : e.theme = "default", 
window.CodeMirrorEditor = CodeMirror.fromTextArea(document.getElementById("editthemeform-code"), e), 
$(document).on("click", ".fullScreenButton", function(e) {
a();
}), $(document).on("click", ".fullScreenButtonOff", function(e) {
a();
}), $(document).keyup(function(e) {
27 == e.keyCode && 1 <= $(".fullscreen").length && a();
}), $("#editFile").submit(function(e) {
$("body").addClass("page-loader");
}), $(".js-confirm").click(function(e) {
var t = $(this), a = t.data("params");
custom.confirm(o.confirm_message, "", function() {
$("body").addClass("page-loader"), custom.sendBtn(t, {
data: a,
type: "POST",
callback: function() {
window.location = location.href;
}
});
}), e.preventDefault();
});
}
}, customModule.ticketsController = {
run: function(o) {
$(document).on("click", "#createTicketButton", function(e) {
e.preventDefault();
var t = $(this), a = $("#createTicketForm");
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#createTicketModal").modal("hide"), location.reload();
}
}), !1;
}), $(document).on("click", "#editMessageButton", function(e) {
e.preventDefault();
var t = $(this), a = $("#editTicketMessageForm");
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#editMessage").modal("hide"), location.reload();
}
}), !1;
}), $("#confirmAction").on("show.bs.modal", function(e) {
$("#TicketsFormStatus").val($(e.relatedTarget).data("id"));
}), $("#editMessage").on("show.bs.modal", function(e) {
var t = $(e.relatedTarget).data("link"), a = $("#editMessage"), n = $(".modal-body", a);
n.html('<span class="spinner"><i class="fa fa-spinner fa-spin"></i></span>'), custom.ajax({
url: t,
type: "GET",
success: function(e) {
n.html(e.content);
},
error: function(e, t, a) {
if ("abort" !== t) {
console.log("Something was wrong...", t, a, e);
var o = $("<div/>", {
class: "error-summary alert alert-danger"
}).text(a);
n.html("").append(o);
}
}
});
}), $("#confirmTicket").on("show.bs.modal", function(e) {
var t, a = $(e.relatedTarget);
$("#confirmTicketTitle").html(o[a.data("title")]), $("#confirmTicketLink").attr("href", a.data("link")), 
t = !!a.data("submit_danger"), $("#confirmTicketLink").toggleClass("btn-danger", t);
}), $(document).on("click", "#checkActionYes", function(e) {
$("#bulkTicketForm").submit();
}), $("#editTicketSubject").on("show.bs.modal", function(e) {
var t = $(e.relatedTarget);
$("#edit-ticket-subject").val(t.data("subject")), $("#editSubjectForm").attr("action", t.data("url"));
}), $("#editSubjectForm").on("submit", function(e) {
e.preventDefault();
var t = $("#editSubjectBtn"), a = $(this);
return custom.sendFrom(t, a, {
data: a.serialize(),
callback: function(e) {
$("#editTicketSubject").modal("hide"), location.reload();
}
}), !1;
});
}
}, customModule.usersControllerExport = {
run: function(e) {
e.exportFromDate || new Date();
var t = e.exportToDate || new Date();
e.checkExportStatusUrl;
window, $('[data-toggle="tooltip"]').tooltip(), $(".selectpicker").selectpicker({
style: "btn-default",
size: "auto"
}), $("#exportFrom").datetimepicker({
format: "YYYY-MM-DD",
maxDate: t
}), $("#exportTo").datetimepicker({
format: "YYYY-MM-DD",
maxDate: t
}), $("#customizeFieldsModal .cancel_button").click(function(e) {
$("#customizeFieldsModal input:checkbox").prop("checked", !0);
});
}
}, customModule.usersController = {
run: function(d) {
var t, a, o, n, i, r, l, s, c, u, m, f, p, h, v, g, b, y, w, k, x, C, M, T, S, D, F, E, L, j, P, O = d.passwordLength || 8;
function A(t, e) {
t.find(".user_list_item").remove();
var a = _.template('<option class="user_list_item" data-tokens="<%= login %><%= id %><%- custom_rates %>" value="<%- id %>"><%= login %> (<%= custom_rates %>)</option>');
_.each(e, function(e) {
t.append(a({
id: e.id,
login: e.login,
custom_rates: e.custom_rates
}));
}), t.selectpicker("refresh");
}
$(".edit_rates_btn").prop("disabled", !1), window, t = $("#createUserModal"), a = t.find("form"), 
o = t.find(":submit"), n = custom.freezeForm(a), a.submit(function(e) {
e.preventDefault(), custom.sendFrom(o, a, {
data: $(this).serialize(),
callback: function(e) {
t.modal("hide"), location.reload();
}
});
}), a.find(".generate_password_btn").click(function(e) {
a.find(".form_field_password").val(custom.generatePassword(O));
}), t.on("hide.bs.modal", function(e) {
custom.restoreForm(n, a), t.find(".error-summary").addClass("hidden");
}), t.on("show.bs.modal", function(e) {
console.log($(this)), $(this).find('input[type="text"]').val([]), console.log($(this).find('input[type="text"]'));
}), function(e) {
d.passwordLength;
var o, n, i, r = $("#editUserModal"), s = r.find("form"), t = r.find(":submit"), a = r.find(".generate_apikey_btn"), l = custom.freezeForm(s);
s.submit(function(e) {
e.preventDefault(), custom.sendFrom(t, s, {
data: $(this).serialize(),
callback: function(e) {
r.modal("hide"), location.reload();
}
});
}), a.click(function(e) {
custom.ajax({
url: o,
type: "GET",
success: function(e, t, a) {
e && _.isString(e) && r.find(".form_field_apikey").val(e);
},
error: function(e, t, a) {
console.log("Something was wrong...", t, a, e);
}
});
}), r.on("shown.bs.modal", function(e) {
s.attr("action", n);
}), r.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget), a = t.closest("tr").attr("id");
n = t.data("action_url"), i = t.data("get_url"), o = t.data("generate_apikey_url"), 
custom.restoreForm(l, s), r.find(".modal-title .item-id").html(a), custom.ajax({
url: i,
type: "GET",
success: function(e, t, a) {
if (void 0 === e.user) return r.modal("hide"), void console.log("Unexpected user data...", t, a);
!function(e) {
var t, a, o, n, i = JSON.parse(e.payments || "{}"), r = {
"UpdateUserForm[username]": e.login,
"UpdateUserForm[email]": e.email,
"UpdateUserForm[skype]": e.skype,
"UpdateUserForm[first_name]": e.first_name,
"UpdateUserForm[last_name]": e.last_name,
"UpdateUserForm[apikey]": e.apikey
}, l = {};
s.find("input").each(function() {
a = this.name, (t = $(this)) && "checkbox" === t.attr("type") && (n = a.match(/(\[([^[]+)\])(\[([^[]+)\])/), 
_.isArray(n) && void 0 !== n[4] && (o = n[4], l[a] = i.hasOwnProperty(o) ? 0 | i[o] : 1));
}), r = _.extend(r, l), custom.restoreForm(JSON.stringify(r), s);
}(e.user);
},
error: function(e, t, a) {
r.modal("hide"), console.log("Something was wrong...", t, a, e);
}
});
});
}(window), window, l = $("#submitActionModal"), s = l.find("#actionSubmitButton"), 
c = {}, s.click(function(e) {
e.preventDefault(), "POST" === r && custom.sendBtn(s, {
data: c,
type: "POST",
callback: function(e) {
l.modal("hide"), location.reload();
}
});
}), l.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget);
if (i = t.data("action_url"), r = t.data("action_type"), c = {}, void 0 === i) return l.modal("hide"), 
void console.log("Undefined submit modal dialog action url!");
t.hasClass("mass_action") && "POST" === r && (c.users = [], $(".mass_item:checkbox:checked").each(function() {
c.users.push($(this).val());
})), s.attr("href", i);
}), l.on("hide.bs.modal", function(e) {
$(this).find("#actionSubmitButton").attr("href", "");
}), window, u = $("#setPassword"), m = u.find("form"), f = u.find(":submit"), p = m.find(".form_field_password"), 
h = m.find(".form_field_username"), v = m.find(".form_fields"), m.submit(function(e) {
e.preventDefault(), custom.sendFrom(f, m, {
data: $(this).serialize(),
callback: function(e) {
u.modal("hide"), location.reload();
}
});
}), m.find(".generate_password_button").click(function(e) {
p.val(custom.generatePassword(O));
}), u.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget), a = t.data("action_url"), o = t.data("username");
u.find(".modal-title .item-id").html(t.closest("tr").attr("id")), v.val(""), void 0 !== a && void 0 !== o ? (m.attr("action", a), 
h.val(o)) : console.log("Undefined submit modal dialog action url!");
}), function(e) {
var o, n, i, r, l = $("#editRatesModal"), s = l.find("form"), t = l.find(".submit_button"), d = l.find(".rates_list_container"), a = l.find(".detele_all_button"), c = l.find(".select_service_container"), u = (l.find(".clear_search"), 
l.find(".search_custom_rates")), m = [], f = 0;
function p(a, o) {
d.animate({
scrollTop: a.offset().top - d.offset().top + d.scrollTop()
}, 500, function() {
var e = o || "#DDEDF6", t = a.css("background-color");
a.css("backgroundColor", e).animate({
backgroundColor: t
}, 1e3, function() {
a.css("backgroundColor", t);
});
});
}
d.on("click", ".delete_rate_button", function(e) {
var t = $(this).closest(".rate_item");
t.remove(), b(--f);
}), d.on("click", ".rate_type_button", function(e) {
var t = $(this).closest(".rate_item"), a = 0 | t.find(".field_percent").val(), o = 0 | !a, n = t.find(".field_price"), i = t.data("dollar_price"), r = t.data("percent_price"), l = t.data("raw_price");
t.find(".field_percent").val(o).change(), o ? n.val(null === r ? 100 : r) : n.val(null === i ? l : i);
}), d.on("change", ".field_price", function(e) {
var t = $(this).closest(".rate_item"), a = 0 | t.find(".field_percent").val(), o = $(this).val();
a ? t.data("percent_price", o) : t.data("dollar_price", o);
}), d.on("change", ".field_percent", function(e) {
var t = $(this).closest(".rate_item"), a = 0 | t.find(".field_percent").val(), o = a ? "%" : "$";
t.find(".rate_type_button").text(o), y(t, a);
});
var h = _.debounce(function(e) {
var t = $(".rates_list_container .rate_item");
t.each(function() {
$(this).text().search(new RegExp(e, "i")) < 0 ? $(this).hide() : $(this).show();
}), d.toggleClass("custom-rates__service-search", !!t.filter(":visible").length);
}, 200);
function v() {
m = function(e) {
var t = [];
return _.each(e, function(e) {
_.isArray(e.services) && (t = _.union(t, e.services));
}), t;
}(r), c.append(function(e) {
var t, a, o = $("#add_custom_rate_item_js_template");
if (0 === o.length) throw "Undefined services list template";
return t = _.template(o.html()), (a = $($.parseHTML(t({
groupedServices: e
})))).find(".field_service").selectpicker(), a.on("changed.bs.select", function(e, t, a, o) {
var n = $(this).find("option").eq(t).val(), i = function() {
return $("#item_" + n);
};
if (i().length) p(i()); else {
var r = g(m, n);
d.append(w({
id: null,
sid: n,
price: r.price,
percent: "0"
})), _.defer(function() {
p(i(), "#DDEDF6"), $('[data-toggle="tooltip"]').tooltip();
});
}
i().find(".field_price").focus();
}), a;
}(r)), 0 < i.length && (_.each(i, function(e) {
_.defer(function() {
d.append(w(e));
});
}), _.defer(function() {
d.find(".field_price").trigger("change"), d.find(".field_percent").trigger("change"), 
$('[data-toggle="tooltip"]').tooltip();
})), _.delay(custom.showModalLoader, 500, !1);
}
function g(e, t) {
return _.find(e, function(e) {
return parseInt(e.id) === parseInt(t);
});
}
function b(e) {
a.attr("disabled", !e).prop("disabled", !e), t.prop("disabled", !e && !i);
}
function y(e, t) {
var a = e.find(".field_price");
t ? a.inputmask("integer", {
integerDigits: 8,
allowMinus: !1,
autoGroup: !1,
min: 0,
step: 1,
placeholder: "0",
rightAlign: !1,
oncleared: function() {
a.val(0);
}
}) : a.inputmask("numeric", {
digits: 3,
integerDigits: 17,
enforceDigitsOnBlur: !0,
allowMinus: !1,
autoGroup: !1,
min: 0,
step: .001,
placeholder: "0.000",
rightAlign: !1,
oncleared: function() {
a.val(0);
}
});
}
function w(e) {
var t, a, o, n = $("#custom_rate_item_js_template");
if (0 === n.length) throw "Undefined services list template";
t = _.template(n.html()), o = g(m, e.sid);
var i = 0 | e.percent;
return (a = $($.parseHTML(t({
rate_id: e.id,
service_id: e.sid,
custom_rate: e.price,
percent: i,
service_name: o.service_name,
service_rate: o.price,
provider_rate: o.provider_rate,
provider_rate_tooltip: o.provider_rate_tooltip,
activity: 0 | o.act
})))).data("dollar_price", i ? null : e.price), a.data("percent_price", i ? e.price : null), 
a.data("raw_price", o.price), y(a, 0 | e.percent), b(++f), a;
}
function k() {
u.val("").trigger("keyup");
}
s.submit(function(e) {
e.preventDefault(), custom.sendFrom(t, s, {
data: $(this).serialize(),
callback: function(e) {
l.modal("hide"), _.delay(function() {
location.reload();
}, 500);
}
});
}), $(document).on("click", ".delete_all_submit", function() {
d.empty(), b(0);
}), u.keydown(function(e) {
if (13 === e.keyCode) return e.preventDefault(), !1;
27 === e.keyCode && (e.preventDefault(), e.stopImmediatePropagation(), k());
}), u.keyup(function(e) {
var t = $(this).val().trim();
h(t);
}), l.on("click", ".clear-button-live-search", function(e) {
k();
}), l.on("shown.bs.modal", function() {
_.defer(function() {
u.jQueryClearButton();
});
}), l.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget);
o = t.data("action_url"), n = t.data("get_rates_url");
var a = t.closest("tr").attr("id");
l.find(".modal-title .item-id").html(a), l.find(".error-summary").addClass("hidden"), 
void 0 !== o ? (m = r = i = null, b(f = 0), d.empty(), c.empty(), u.val(""), custom.showModalLoader(!0), 
custom.ajax({
url: n,
type: "GET",
success: function(e, t, a) {
if (r = e.services, i = e.custom_rates, void 0 === r || void 0 === i) return l.modal("hide"), 
void console.log("Unexpected custom rates data...", t, a);
v();
},
error: function(e, t, a) {
custom.showModalLoader(!1), l.modal("hide"), console.log("Something was wrong...", t, a, e);
}
}), s.attr("action", o)) : console.log("Undefined submit modal dialog action url!");
});
}(window), window, w = $("#copyRatesModal"), k = w.find("form"), x = w.find(":submit"), 
C = w.find(".users_from_list"), M = w.find(".current_user_name"), T = w.find(".form_field_to"), 
k.submit(function(e) {
e.preventDefault(), custom.sendFrom(x, k, {
data: $(this).serialize(),
callback: function(e) {
w.modal("hide"), location.reload();
}
});
}), C.change(function(e) {
var t, a = $(this).val();
t = void 0 === y || null == a, x.prop("disabled", t), k.attr("action", g.replace("from_id", a).replace("to_id", y));
}), w.on("show.bs.modal", function(e) {
var t, a = $(e.relatedTarget);
y = a.data("user_id"), g = a.data("action_url"), b = a.data("get_users_url"), t = a.data("username"), 
w.find(".modal-title .item-id").html(a.closest("tr").attr("id")), void 0 !== y && void 0 !== g && void 0 !== b || w.modal("hide"), 
custom.ajax({
url: b,
type: "GET",
success: function(e, t, a) {
e || w.modal("hide"), A(C, e);
},
error: function(e, t, a) {
console.log("Something was wrong...", t, a, e);
}
}), C.val("").change(), C.find("option").prop("disabled", !1), C.find('option[value=""]').prop("disabled", !0), 
C.find("option[value='" + y + "']").prop("disabled", !0), C.selectpicker("refresh"), 
M.val(t), T.val(y);
}), function(e) {
var t = document.querySelector(".checkAll"), o = t.closest("tr"), n = document.querySelectorAll(".selectOrder"), i = document.querySelector(".countOrders"), r = 0;
function a() {
r = 0;
var a = !1;
return n.forEach(function(e) {
var t = e.closest("tr");
e.checked ? (r++, a = !0, t.classList.add("active")) : t.classList.remove("active");
}), a ? (t.checked = !0, i.innerText = r + " users ", o.classList.add("show-action-menu"), 
!0) : (t.checked = !1, o.classList.remove("show-action-menu"), !1);
}
t.addEventListener("change", function() {
r = 0, this.checked ? (n.forEach(function(e) {
e.disabled || (e.closest("tr").classList.add("active"), o.classList.add("show-action-menu"), 
e.checked = !0, r++);
}), i.innerText = r + " users ") : (n.forEach(function(e) {
e.closest("tr").classList.remove("active"), o.classList.remove("show-action-menu"), 
e.checked = !1;
}), r = 0, this.checked = !1, i.innerText = "");
}), n.forEach(function(e) {
e.addEventListener("change", a);
});
}(window), window, S = $("#copyRatesMassModal"), D = S.find("form"), F = S.find(":submit"), 
E = S.find(".users_from_list"), L = S.find(".users_to_list"), j = L.clone(), D.submit(function(e) {
e.preventDefault(), L.prop("disabled", !1).find("option").prop("selected", !0), 
custom.sendFrom(F, D, {
data: $(this).serialize(),
callback: function(e) {
S.modal("hide"), location.reload();
}
}), L.prop("disabled", !0).find("option").prop("selected", !1);
}), E.change(function(e) {
var t, a = $(this).val();
t = null == a, F.prop("disabled", t);
}), S.on("show.bs.modal", function(e) {
var t = $(e.relatedTarget).data("get_users_url");
E.val("").change(), L.empty(), $(".mass_item:checkbox:checked").each(function() {
L.append(j.find("option[value='" + $(this).val() + "']").clone());
}), custom.ajax({
url: t,
type: "GET",
success: function(e, t, a) {
e || S.modal("hide"), A(E, e);
},
error: function(e, t, a) {
console.log("Something was wrong...", t, a, e);
}
});
}), window, (P = $("#viewActivityLogModal")).on("show.bs.modal", function(e) {
var t = $(e.relatedTarget), a = (t.data("user_id"), t.data("get_log_url")), o = $(".activity_log tbody", P).empty();
void 0 !== P.find(".modal-title .item-id").html(t.closest("tr").attr("id")) && void 0 !== a || P.modal("hide"), 
custom.ajax({
url: a,
type: "GET",
success: function(e, t, a) {
e && _.isArray(e) || P.modal("hide"), o.empty().append(templates["admin/users_activity_log_rows"]({
rows: e
}));
},
error: function(e, t, a) {
P.modal("hide"), console.log("Something was wrong...", t, a, e);
}
});
});
}
};