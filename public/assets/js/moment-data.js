$(".tgl").replaceWith(function(){
    moment.locale('id');
    var text = moment($.trim($(this).text()), "MM/DD/YY HH:mm").format('DD MMM YY, HH:mm');
    return '<span>' + text + '</span>';
})