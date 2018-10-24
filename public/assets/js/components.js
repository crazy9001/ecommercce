/**
 * Created by MINH on 9/30/2017.
 */
function initComponent() {
    autosize($('textarea'));

    //Initialize Select2 Elements
    $(".select2").select2({width: '100%'});

    //Flat red color scheme for iCheck
    $('input[c-type="icheck"]').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    // Bootstrap switch
    $(".switch").bootstrapSwitch();

    //Price
    $("input.price").on('keyup', function () {
        var n = parseInt($(this).val().replace(/\D/g, ''), 10);
        $(this).val(n.toLocaleString());
    });
    $("input.price").trigger('keyup');

    //Datetime
    $('.daterange').daterangepicker({
        "timePicker24Hour": true,
        "timePickerIncrement": 30,
        "timePicker": true,
        "opens": "left",
        "showWeekNumbers": true,
        "showISOWeekNumbers": true,

        ranges: {
            'Hôm nay': [moment().startOf('days'), moment().endOf('days')],
            'Ngày mai': [moment().subtract(-1, 'days').startOf('days'), moment().subtract(-1, 'days').endOf('days')],
            'Tuần này': [moment().startOf('week'), moment().endOf('week')],
            'Tháng này': [moment().startOf('month'), moment().endOf('month')],
            'Tháng sau': [moment().subtract(-1, 'month').startOf('month'), moment().subtract(-1, 'month').endOf('month')]
        },
        "locale": {
            "format": "DD/MM/YYYY HH:mm",
            "separator": " - ",
            "applyLabel": "OK",
            "cancelLabel": "Hủy",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Tùy chọn",
            "weekLabel": "W",
            "daysOfWeek": [
                "CN",
                "T2",
                "T3",
                "T4",
                "T5",
                "T6",
                "T7"
            ],
            "monthNames": [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12"
            ],
            "firstDay": 1
        }
    });

    $('.datetime').daterangepicker({
        "timePicker24Hour": true,
        "timePickerIncrement": 10,
        "timePicker": true,
        "opens": "left",
        "autoApply": true,

        "showWeekNumbers": true,
        "showISOWeekNumbers": true,
        "singleDatePicker": true,
        "locale": {
            "format": "DD/MM/YYYY HH:mm",
            "applyLabel": "OK",
            "cancelLabel": "Hủy",
            "weekLabel": "W",
            "daysOfWeek": [
                "CN",
                "T2",
                "T3",
                "T4",
                "T5",
                "T6",
                "T7"
            ],
            "monthNames": [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12"
            ],
            "firstDay": 1
        }
    });


    $('.filemanager_single').filemanager('image');
    $('.filemanager_multi').filemanager('image', true);

    $(document).on('click', '.thumb_item a.close', function () {
        var value = $(this).data('value');
        var $target_input = $('#' + $(this).data('input'));
        $(this).closest('.thumb_item').remove();
        var value_arr = $target_input.val().split(",");
        value_arr.splice(value_arr.indexOf(value) , 1);
        $target_input.val(value_arr.join(','));
    });

}


$(document).ready(function () {
    initComponent();
    //SEO
    var seo_title = 'Tiêu đề seo website không vượt quá 70 kí tự (tốt nhất từ 60-70 kí tự)';
    var seo_description = 'Miêu tả seo website không vượt quá 155 kí tự (tốt nhất từ 100-155 kí tự). Là những đoạn mô tả ngắn gọn về website, bài viết...';

    var $title = $('#title');
    var $slug = $('#slug');
    var $seo_title = $('#seo_title');
    var $seo_description = $('#seo_description');

    var flag_slug = $slug.val() ? false : true;
    var flag_seo_title = $seo_title.val() ? false : true;

    $title.keyup(function () {
        var value = $(this).val();
        if (!$slug.val()) {
            flag_slug = true;
        }
        if (flag_slug) {
            var slug = createUrl(value);
            $('#slug').val(slug);
            $('.slug').html(slug);
        }
        if (flag_seo_title) {
            $('#seo_title').html(value);
        }
        return false;
    });
    $seo_title.keyup(function () {
        var value = $(this).val();
        $('.title').html(value);
        return false;
    });
    $seo_description.keyup(function () {
        var value = $(this).val();
        if (value == '') {
            $('.seo_description').html(seo_description);
            return false;
        }
        $('.seo_description').html(value);
        return false;
    });

});