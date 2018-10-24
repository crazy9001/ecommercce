(function ($) {

    $.fn.filemanager = function (type, multi = false) {
        type = type || 'image';

        this.on('click', function (e) {
            var route = '/filemanager' + '?type=' + type + '&multi=' + multi;
            var target_input = $(this).data('input');
            var $target_input = $('#' + target_input);
            var target_preview = $(this).data('preview');
            var $target_preview = $('#' + target_preview);
            window.open(route, 'FileManager', 'width=1000,height=600');
            window.SetUrl = function (data) {
                if (multi) {
                    var new_data = data.map(function (item) {
                        return item.url;
                    });

                    var value_arr = [];
                    if($target_input.val()){
                        value_arr = $target_input.val().split(",");
                    }

                    var file_path = value_arr.concat(new_data).join(',');

                    $target_input.val(file_path).trigger('change');

                    data.forEach(function (item) {
                        $target_preview.append(
                            $('<div class="thumb_item">').append(
                                $('<a class="close">').data('value', item.url).data('input', target_input).append('×'),
                                $('<img class="img-fix">').attr('src', item.thumb_url)
                            )
                        );
                    });

                    $target_preview.trigger('change');
                    // trigger change event
                } else {
                    $target_input.val(data).trigger('change');
                    $target_preview.attr('src', data).trigger('change');
                }

            };
            return false;
        });
    }

})(jQuery);
