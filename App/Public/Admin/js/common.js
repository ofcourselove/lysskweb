function ajaxForm(dom) {
    var url = $(dom).attr('action');
    var data = $(dom).serialize();
    $.ajax({
        url: url,
        data: data,
        type: 'post',
        dataType: 'json',
        success: function(i) {
            layer.alert(i.info);
            if (i.status == 1) {
                window.location.href = i.url;
            }
        }
    })
    return false;
}

function ajaxBtn(dom) {
    var url = $(dom).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function(i) {
            layer.alert(i.info);
            if (i.status == 1) {
                window.location.href = i.url;
            }
        }
    })
    return false;
}