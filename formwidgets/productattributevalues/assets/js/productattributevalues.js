+function ($) { "use strict";

    var ProductAttributeValues = function (el, options) {
        this.$el = $(el)
        this.options = options
        this.init()
    }
    ProductAttributeValues.prototype.init = function () {
        var self = this
        console.log($('select[name="attributes"]'))
        $('select[name="attributes"]').change(function () {
            var self = this
            console.log("asdfa")
        })
    }

    ProductAttributeValues.prototype.onAttributesChange = function(target){
        console.log("onChangeAttribute")
        console.log(target)
    }

    $.productAttributeValues = new ProductAttributeValues;

}(window.jQuery);