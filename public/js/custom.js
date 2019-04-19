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
            var selectedValues = obj[$this.attr('name').replace('[', '').replace(']', '')];
            $this.val(selectedValues).trigger('change');
        }
        if (obj[$this.attr('name')] != null) {
            $this.val(obj[$this.attr('name')]).trigger('change');
        }
    });
};

(function () {
    $('[data-toggle="tooltip"]').tooltip();
})($);