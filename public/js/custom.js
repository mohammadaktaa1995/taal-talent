function _fill($cont, obj) {
    $($cont).find(':input:not(".select2,[name=_method],[name=_token]")').each(function () {
        var $this = $(this);
        if ($this.prop('type'))
            $this.val(obj[$(this).attr('name')]);
        else
            $this.html(obj[$(this).attr('name')]);
    });
    $($cont).find('.select2').each(function () {
        var $this = $(this), name = $this.attr('name');
        if ($this.attr('multiple')) {
            var langs = obj[$this.attr('name').replace('[', '').replace(']', '')];
            var languages = langs.split(',');
            console.log(languages)
            $this.val(languages).trigger('change');
        }
        if (obj[$this.attr('name')] != null) {
            $this.val(obj[$this.attr('name')]).trigger('change');
        }
    });
};

(function () {
    $('[data-toggle="tooltip"]').tooltip();
})($);