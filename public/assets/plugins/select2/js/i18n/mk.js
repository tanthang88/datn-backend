/*! Select2 4.0.13 | http://github.com/select2/select2/blob/master/LICENSE.md */

!function(){if(jQuery&&jQuery.fn&&jQuery.fn.select2&&jQuery.fn.select2.amd)var n=jQuery.fn.select2.amd;n.define("select2/i18n/mk",[],function(){return{inputTooLong:function(n){var e=(n.input.length,n.maximum,"Ве молиме внесете "+n.maximum+" помалку карактер");return 1!==n.maximum&&(e+="и"),e},inputTooShort:function(n){var e=(n.minimum,n.input.length,"Ве молиме внесете уште "+n.maximum+" карактер");return 1!==n.maximum&&(e+="и"),e},loadingMore:function(){return"Вчитување резултати…"},maximumSelected:function(n){var e="Можете да изберете само "+n.maximum+" ставк";return 1===n.maximum?e+="а":e+="и",e},noResults:function(){return"Нема пронајдено совпаѓања"},searching:function(){return"Пребарување…"},removeAllItems:function(){return"Отстрани ги сите предмети"}}}),n.define,n.require}();