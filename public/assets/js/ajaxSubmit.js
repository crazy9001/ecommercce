/**
 * Created by MINH on 9/28/2017.
 */

/* Ajax submit
*
* Server return [
*   'code' => -1, //-1: error, 0: warning, 1: success, other: info
*   'msg' => 'Cập nhật thành công!',
*   'redirect' => '/link', // (nếu có)
* ]
*
*/
function _ajax(url, method, data) {
    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function (response) {
            if (response.redirect) {
                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 1500);
            } else if (response.reload) {
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }else if (response.datatable) {
                return DataTableCallback();
            } else {
                notifyAjax(response);
            }
        }
    });
}

/*Form Submit ajax*/
$('body form.ajax_submit').submit(function (event) {
    event.preventDefault(); // Prevent the form from submitting via the browser
    var form = $(this);
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    var data = new FormData(form[0]);
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: data,
        cache: false,
        contentType: false,
        processData: false,
    }).done(function (response) {
        // Optionally alert the user of success here...
        if (response.redirect) {
            setTimeout(function () {
                window.location.href = response.redirect
            }, 1500);
        } else {
            notifyAjax(response);
        }
    }).fail(function (response) {
        // Optionally alert the user of an error here...
        if (response.redirect) {
            setTimeout(function () {
                window.location.href = response.redirect
            }, 1500);
        } else {
            notifyAjax(response);
        }
    });
});

/*Xóa phần tử*/
$(document).on('click', '.btn-action-delete-element', function () {
    var data = $(this).data();
    var action = $(this).attr('action');
    data._token = _token;
    swal({
            title: "Bạn có chắc xóa?",
            text: "Bạn sẽ không khôi phục được dữ liệu này!",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Hủy",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Đồng ý",
            closeOnConfirm: true
        },
        function () {
            _ajax(action, 'DELETE', data)
        });
});

/*Cập nhật Ẩn hiện nhanh*/
$(document).on('click', '.btn-action-active', function (e) {
    var action = $(this).attr('action');
    var data = $(this).data();
    data._token = _token;
    _ajax(action, 'POST', data);
    return;
});

/*Cập nhật đã xem nhanh*/
$(document).on('click', '.btn-action-read', function (e) {
    var action = $(this).attr('action');
    var data = $(this).data();
    data._token = _token;
    _ajax(action, 'PUT', data);
    return;
});

/*Cập nhật sắp xếp*/
$(document).on('click', 'a.move', function (e) {
    var action = $(this).attr('href');
    _ajax(action, 'GET',{});
    return;
});




