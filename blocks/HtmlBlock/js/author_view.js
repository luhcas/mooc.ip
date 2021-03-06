define(['assets/js/author_view', 'assets/js/url'],
       function (AuthorView, helper) {

    'use strict';

    return AuthorView.extend({

        events: {
            "click button[name=save]":   "onSave",
            "click button[name=cancel]": "switchBack"
        },

        initialize: function(options) {
        },

        postRender: function() {
            this.$("textarea").addToolbar();
        },

        // not used yet
        render: function() {
            return this;
        },

        onSave: function (event) {
            var textarea = this.$("textarea"),
                new_val = textarea.val(),
                view = this;

            //textarea.remove();
            helper
                .callHandler(this.model.id, "foo", {content: new_val})
                .then(
                    // success
                    function () {
                        jQuery(event.target).addClass("accept");
                        view.switchBack();
                    },

                    // error
                    function () {
                        alert("Fehler, TODO!");
                        console.log("fail", arguments);
                    });
        }
    });
});
