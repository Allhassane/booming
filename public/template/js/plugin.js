/**
 * Created by remivautrin on 09/07/15.
 */
Selectize.define('hide-options', function (options) {
    var self = this;
    /**
     * Determines if the provided value has been defined.
     *
     * @param {mixed} object
     * @returns {boolean}
     */
    var isset = function(object) {
        return typeof object !== 'undefined';
    };

    /**
     * Converts a scalar to its best string representation
     * for hash keys and HTML attribute values.
     *
     * Transformations:
     *   'str'     -> 'str'
     *   null      -> ''
     *   undefined -> ''
     *   true      -> '1'
     *   false     -> '0'
     *   0         -> '0'
     *   1         -> '1'
     *
     * @param {string} value
     * @returns {string|null}
     */
    var hash_key = function(value) {
        if (typeof value === 'undefined' || value === null) return null;
        if (typeof value === 'boolean') return value ? '1' : '0';
        return value + '';
    };

    /**
     * Escapes a string for use within HTML.
     *
     * @param {string} str
     * @returns {string}
     */
    var escape_html = function(str) {
        return (str + '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    };

    /**
     * Escapes "$" characters in replacement strings.
     *
     * @param {string} str
     * @returns {string}
     */
    var escape_replace = function(str) {
        return (str + '').replace(/\$/g, '$$$$');
    };

    var hook = {};

    /**
     * Wraps `method` on `self` so that `fn`
     * is invoked before the original method.
     *
     * @param {object} self
     * @param {string} method
     * @param {function} fn
     */
    hook.before = function(self, method, fn) {
        var original = self[method];
        self[method] = function() {
            fn.apply(self, arguments);
            return original.apply(self, arguments);
        };
    };

    /**
     * Wraps `method` on `self` so that `fn`
     * is invoked after the original method.
     *
     * @param {object} self
     * @param {string} method
     * @param {function} fn
     */
    hook.after = function(self, method, fn) {
        var original = self[method];
        self[method] = function() {
            var result = original.apply(self, arguments);
            fn.apply(self, arguments);
            return result;
        };
    };

    /**
     * Wraps `fn` so that it can only be invoked once.
     *
     * @param {function} fn
     * @returns {function}
     */
    var once = function(fn) {
        var called = false;
        return function() {
            if (called) return;
            called = true;
            fn.apply(this, arguments);
        };
    };

    /**
     * Wraps `fn` so that it can only be called once
     * every `delay` milliseconds (invoked on the falling edge).
     *
     * @param {function} fn
     * @param {int} delay
     * @returns {function}
     */
    var debounce = function(fn, delay) {
        var timeout;
        return function() {
            var self = this;
            var args = arguments;
            window.clearTimeout(timeout);
            timeout = window.setTimeout(function() {
                fn.apply(self, args);
            }, delay);
        };
    };

    /**
     * Debounce all fired events types listed in `types`
     * while executing the provided `fn`.
     *
     * @param {object} self
     * @param {array} types
     * @param {function} fn
     */
    var debounce_events = function(self, types, fn) {
        var type;
        var trigger = self.trigger;
        var event_args = {};

        // override trigger method
        self.trigger = function() {
            var type = arguments[0];
            if (types.indexOf(type) !== -1) {
                event_args[type] = arguments;
            } else {
                return trigger.apply(self, arguments);
            }
        };

        // invoke provided function
        fn.apply(self, []);
        self.trigger = trigger;

        // trigger queued events
        for (type in event_args) {
            if (event_args.hasOwnProperty(type)) {
                trigger.apply(self, event_args[type]);
            }
        }
    };

    /**
     * A workaround for http://bugs.jquery.com/ticket/6696
     *
     * @param {object} $parent - Parent element to listen on.
     * @param {string} event - Event name.
     * @param {string} selector - Descendant selector to filter by.
     * @param {function} fn - Event handler.
     */
    var watchChildEvent = function($parent, event, selector, fn) {
        $parent.on(event, selector, function(e) {
            var child = e.target;
            while (child && child.parentNode !== $parent[0]) {
                child = child.parentNode;
            }
            e.currentTarget = child;
            return fn.apply(this, [e]);
        });
    };

    /**
     * Determines the current selection within a text input control.
     * Returns an object containing:
     *   - start
     *   - length
     *
     * @param {object} input
     * @returns {object}
     */
    var getSelection = function(input) {
        var result = {};
        if ('selectionStart' in input) {
            result.start = input.selectionStart;
            result.length = input.selectionEnd - result.start;
        } else if (document.selection) {
            input.focus();
            var sel = document.selection.createRange();
            var selLen = document.selection.createRange().text.length;
            sel.moveStart('character', -input.value.length);
            result.start = sel.text.length - selLen;
            result.length = selLen;
        }
        return result;
    };

    /**
     * Copies CSS properties from one element to another.
     *
     * @param {object} $from
     * @param {object} $to
     * @param {array} properties
     */
    var transferStyles = function($from, $to, properties) {
        var i, n, styles = {};
        if (properties) {
            for (i = 0, n = properties.length; i < n; i++) {
                styles[properties[i]] = $from.css(properties[i]);
            }
        } else {
            styles = $from.css();
        }
        $to.css(styles);
    };

    /**
     * Measures the width of a string within a
     * parent element (in pixels).
     *
     * @param {string} str
     * @param {object} $parent
     * @returns {int}
     */
    var measureString = function(str, $parent) {
        if (!str) {
            return 0;
        }

        var $test = $('<test>').css({
            position: 'absolute',
            top: -99999,
            left: -99999,
            width: 'auto',
            padding: 0,
            whiteSpace: 'pre'
        }).text(str).appendTo('body');

        transferStyles($parent, $test, [
            'letterSpacing',
            'fontSize',
            'fontFamily',
            'fontWeight',
            'textTransform'
        ]);

        var width = $test.width();
        $test.remove();

        return width;
    };

    /**
     * Sets up an input to grow horizontally as the user
     * types. If the value is changed manually, you can
     * trigger the "update" handler to resize:
     *
     * $input.trigger('update');
     *
     * @param {object} $input
     */
    var autoGrow = function($input) {
        var currentWidth = null;

        var update = function(e, options) {
            var value, keyCode, printable, placeholder, width;
            var shift, character, selection;
            e = e || window.event || {};
            options = options || {};

            if (e.metaKey || e.altKey) return;
            if (!options.force && $input.data('grow') === false) return;

            value = $input.val();
            if (e.type && e.type.toLowerCase() === 'keydown') {
                keyCode = e.keyCode;
                printable = (
                (keyCode >= 97 && keyCode <= 122) || // a-z
                (keyCode >= 65 && keyCode <= 90)  || // A-Z
                (keyCode >= 48 && keyCode <= 57)  || // 0-9
                keyCode === 32 // space
                );

                if (keyCode === KEY_DELETE || keyCode === KEY_BACKSPACE) {
                    selection = getSelection($input[0]);
                    if (selection.length) {
                        value = value.substring(0, selection.start) + value.substring(selection.start + selection.length);
                    } else if (keyCode === KEY_BACKSPACE && selection.start) {
                        value = value.substring(0, selection.start - 1) + value.substring(selection.start + 1);
                    } else if (keyCode === KEY_DELETE && typeof selection.start !== 'undefined') {
                        value = value.substring(0, selection.start) + value.substring(selection.start + 1);
                    }
                } else if (printable) {
                    shift = e.shiftKey;
                    character = String.fromCharCode(e.keyCode);
                    if (shift) character = character.toUpperCase();
                    else character = character.toLowerCase();
                    value += character;
                }
            }

            placeholder = $input.attr('placeholder');
            if (!value && placeholder) {
                value = placeholder;
            }

            width = measureString(value, $input) + 4;
            if (width !== currentWidth) {
                currentWidth = width;
                $input.width(width);
                $input.triggerHandler('resize');
            }
        };

        $input.on('keydown keyup update blur', update);
        update();
    };
    self.render = function (templateName, data) {
        var value, id, label;
        var html = '';
        var cache = false;
        var self = this;
        var regex_tag = /^[\t \r\n]*<([a-z][a-z0-9\-_]*(?:\:[a-z][a-z0-9\-_]*)?)/i;

        if (templateName === 'option' || templateName === 'item') {
            value = hash_key(data[self.settings.valueField]);
            cache = !!value;
        }

        if (self.isOptionHided(value)) {
            return html;
        }

        // pull markup from cache if it exists
        if (cache) {
            if (!isset(self.renderCache[templateName])) {
                self.renderCache[templateName] = {};
            }
            if (self.renderCache[templateName].hasOwnProperty(value)) {
                return self.renderCache[templateName][value];
            }
        }

        // render markup
        html = self.settings.render[templateName].apply(this, [data, escape_html]);

        // add mandatory attributes
        if (templateName === 'option' || templateName === 'option_create') {
            html = html.replace(regex_tag, '<$1 data-selectable');
        }
        if (templateName === 'optgroup') {
            id = data[self.settings.optgroupValueField] || '';
            html = html.replace(regex_tag, '<$1 data-group="' + escape_replace(escape_html(id)) + '"');
        }
        if (templateName === 'option' || templateName === 'item') {
            html = html.replace(regex_tag, '<$1 data-value="' + escape_replace(escape_html(value || '')) + '"');
        }

        // update cache
        if (cache) {
            self.renderCache[templateName][value] = html;
        }

        return html;
    };
    self.reload = function () {
        var self = this;

        if (self.loadedSearches.hasOwnProperty(self.getValue())) {
            delete self.loadedSearches[self.getValue()];
        }
        self.onSearchChange(self.getValue());
    };

    /**
     * Return true if an option matching the given value is hided
     * @param value
     * @returns {boolean}
     */
    self.isOptionHided = function (value) {
        var key, self = this;
        key = hash_key(value);
        if (self.options.hasOwnProperty(key)) {
            return (self.options[key].hasOwnProperty(self.settings.hideField)
            && self.options[key][self.settings.hideField] === true);
        }
        return false;
    };

    /**
     *
     * @param value
     * @returns {Selectize}
     */
    self.hideOption = function (value) {
        var key, self = this, cache_items, cache_options;
        key = hash_key(value);
        if (self.options.hasOwnProperty(key)) {
            if (!self.options[key].hasOwnProperty(self.settings.hideField)
                || self.options[key][self.settings.hideField] === false) {
                self.options[key][self.settings.hideField] = true;

                cache_items = self.renderCache['item'];
                cache_options = self.renderCache['option'];

                if (cache_items && cache_items.hasOwnProperty(value)) {
                    delete cache_items[value];
                }
                if (cache_options && cache_options.hasOwnProperty(value)) {
                    delete cache_options[value];
                }
            }
        }
        return self;
    };

    self.showOption = function (value) {
        var key, self = this, cache_items, cache_options;
        key = hash_key(value);
        if (self.options.hasOwnProperty(key)) {
            if (self.options[key].hasOwnProperty(self.settings.hideField)
                && self.options[key][self.settings.hideField] === true) {
                self.options[key][self.settings.hideField] = false;

                cache_items = self.renderCache['item'];
                cache_options = self.renderCache['option'];

                if (cache_items && cache_items.hasOwnProperty(value)) {
                    delete cache_items[value];
                }
                if (cache_options && cache_options.hasOwnProperty(value)) {
                    delete cache_options[value];
                }
            }
        }
        console.log(self);
        return self;
    };
    self.showAllOptions = function () {
        var key, self = this, cache_items, cache_options, value;
        cache_items = self.renderCache['item'];
        cache_options = self.renderCache['option'];
        for (key in self.options) {
            if (self.options[key].hasOwnProperty(self.settings.hideField)
                && self.options[key][self.settings.hideField] === true) {
                self.options[key][self.settings.hideField] = false;

                value = self.options[key][self.settings.valueField];

                if (cache_items && cache_items.hasOwnProperty(value)) {
                    delete cache_items[value];
                }
                if (cache_options && cache_options.hasOwnProperty(value)) {
                    delete cache_options[value];
                }
            }
        }
        return self;
    };

    self.hideAllOptions = function () {
        var key, self = this, cache_items, cache_options, value;
        cache_items = self.renderCache['item'];
        cache_options = self.renderCache['option'];
        for (key in self.options) {
            if (!self.options[key].hasOwnProperty(self.settings.hideField)
                || self.options[key][self.settings.hideField] === false) {
                self.options[key][self.settings.hideField] = true;

                value = self.options[key][self.settings.valueField];

                if (cache_items && cache_items.hasOwnProperty(value)) {
                    delete cache_items[value];
                }
                if (cache_options && cache_options.hasOwnProperty(value)) {
                    delete cache_options[value];
                }
            }
        }
        return self;
    };


    // override the setup method to add an extra "click" handler
    this.setup = (function () {
        var original = self.setup;
        return function () {
            original.apply(this, arguments);
            /**
             * A helper method for rendering "item" and
             * "option" templates, given the data.
             *
             * @param {string} templateName
             * @param {object} data
             * @returns {string}
             */
        };
    })();

});