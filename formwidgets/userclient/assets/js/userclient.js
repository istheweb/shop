/*
 * This is a sample JavaScript file used by {{ name }}
 *
 * You can delete this file if you want
 */

+function ($) { "use strict";

    // RECORDFINDER CLASS DEFINITION
    // ============================

    var UserFinder = function(element, options) {
        var self       = this
        this.options   = options
        this.$el       = $(element)

        this.$el.on('dblclick', function () {
            $('.btn:first', self.$el).trigger('click')
        })
    }

    UserFinder.DEFAULTS = {
        refreshHandler: null,
        dataLocker: null
    }

    UserFinder.prototype.updateRecord = function(linkEl, recordId) {

        if (!this.options.dataLocker) return
        var self = this
        $(this.options.dataLocker).val(recordId)

        this.$el.loadIndicator({ opaque: true })
        this.$el.request(this.options.refreshHandler, {
            success: function(data) {
                this.success(data)
                $(self.options.dataLocker).trigger('change')
            }
        })

        $(linkEl).closest('.userfinder-popup').popup('hide')
    }

    // RECORDFINDER PLUGIN DEFINITION
    // ============================

    var old = $.fn.userFinder

    $.fn.userFinder = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result
        this.each(function () {
            var $this   = $(this)
            var data    = $this.data('oc.userfinder')
            var options = $.extend({}, UserFinder.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data) $this.data('oc.userfinder', (data = new UserFinder(this, options)))
            if (typeof option == 'string') result = data[option].apply(data, args)
            if (typeof result != 'undefined') return false
        })

        return result ? result : this
    }

    $.fn.userFinder.Constructor = UserFinder

    // RECORDFINDER NO CONFLICT
    // =================

    $.fn.userFinder.noConflict = function () {
        $.fn.userFinder = old
        return this
    }

    // RECORDFINDER DATA-API
    // ===============
    $(document).render(function () {
        $('[data-control="userfinder"]').userFinder()
    })

}(window.jQuery);