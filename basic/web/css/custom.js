$(document).ready(function() {
    $('.custom-file-input').on('change', function() {
        realVal = $(this).val();
        lastIndex = realVal.lastIndexOf('\\') + 1;
        if(lastIndex !== -1) {
            realVal = realVal.substr(lastIndex);
            $(this).prev('.mask').find('.fileInputText').val(realVal);
        }
    });
});/**
 * Created by ASI on 18.10.2015.
 */

$(document).ready(function() {
    $('#uploadform-imagefile').change(function() {
        $('#uploadform-imagefile').attr('style', 'opacity: 1; z-index: 1;');
    });
});

function avatar() {
    var path = $('div [class = "item active"] > img').attr('src');
    var arr = [];
    arr = path.split('/');
    var len = arr.length;
    var elem = len - 1;
    return $('#avatar').attr("value", arr[elem]);
}

function delPic() {
    var p = $('div [class = "item active"] > img').attr('src');
    var a = [];
    a = p.split('/');
    var l = a.length;
    var e = l - 1;
    return $('#blabla').attr("value", a[e]);
}

function hello() {
    return $('div [class = "item active"] > img').attr('src');
}

function good() {
    return $('.myinputclass').attr("value", $('div [class = "item active"] > img').attr('src'));
}

function imageID(i, j) {
    var id = '#' + i + '_' + j;
    var n = $(id).attr('src');
}

// this method is selecting necessary image
function tagSel(i)
{
    var image = 'div#car' + i + ' div div.active img';
    return $(image).attr('src');
}

//this method always opens the first picture in the list
function carouselOpen(i)
{
    var sel = '#' + i + '0';
    var sel2 = 'div#car' + i + ' div div.item.active';
    $(sel2).attr('class', 'item');
    $(sel).parent().attr('class', 'item active');
    return true;
}

//this method changes hidden value and sets picture's src attr
function getImage(i)
{
    var sel = 'div#car' + i + ' div div.active img';
    var sel2 = '#avatar_' + i;
    var im = $(sel).attr('src');
    return $(sel2).attr('value', im);
}

function setAvatar(id, i)
{
    var sel1 = '#avatar_' + i;
    var p = $(sel1).attr('value');
    $.ajax({
        url: 'modal?id=' + id,
        type: 'post',
        data: 'img=' + p
    });
}

function currency(id)
{
    var a = $(this).val();
    $.ajax({
        url: 'currency?id=' + id,
        type: 'post',
        success: function( data ) {
            $('select').html( data ).attr('name', a);
        }
    });
}
