var wpxs_imgs = {};
var wpxs_selected = new Array();
var wpxs_opened = false;
var wpxs_current = '';

jQuery(document).ready(function (jQuery) {
    jQuery('#wpxs_search').click(function () {
        wpxs_search(1);
    });

    jQuery('.wpxs_btn').live('click', function () {
        eid = jQuery(this).attr('data-editor');
        jQuery('#wpxs_eid').val(eid)
    });

    jQuery('.wpxs_btn').live('click', function () {
        if (wpxs_opened) {
            jQuery.colorbox({
                width: "930px",
                height: "460px",
                inline: true,
                href: "#wpxs_popup",
                scrolling: false,
                fixed: true
            });
        } else {
            jQuery.colorbox({
                width: "648px",
                height: "460px",
                inline: true,
                href: "#wpxs_popup",
                scrolling: false,
                fixed: true
            });
        }
    });

    jQuery('#wpxs_page-select').live('change', function () {
        wpxs_search(jQuery(this).val());
    });

    jQuery('#wpxs_insert').live('click', function () {
        for (var i = 0; i < wpxs_selected.length; i++) {
            vinsert = '';
            valign = '';
            valign2 = '';
            eid = jQuery('#wpxs_eid').val();
            if (jQuery('#wpxs_align').val() != '') {
                valign = ' align="' + wpxs_escape_html(jQuery('#wpxs_align').val()) + '"';
                valign2 = ' class="' + wpxs_escape_html(jQuery('#wpxs_align').val()) + '"';
            }
            var cid = wpxs_selected[i];
            if (wpxs_imgs[cid].img_caption != '') {
                vinsert = '[caption id="" ' + valign + ']';
            }
            if (jQuery('#wpxs_link').val() == 1) {
                vinsert += '<a href="' + wpxs_escape_html(wpxs_imgs[cid].img_site) + '" title="' + wpxs_escape_html(wpxs_imgs[cid].img_title) + '"';
            }
            if (jQuery('#wpxs_link').val() == 2) {
                vinsert += '<a href="' + wpxs_escape_html(wpxs_imgs[cid].img_full) + '" title="' + wpxs_escape_html(wpxs_imgs[cid].img_title) + '"';
            }
            if ((jQuery('#wpxs_link').val() != 0) && jQuery('#wpxs_blank').is(':checked')) {
                vinsert += ' target="_blank"';
            }
            if ((jQuery('#wpxs_link').val() != 0) && jQuery('#wpxs_nofollow').is(':checked')) {
                vinsert += ' rel="nofollow"';
            }
            if (jQuery('#wpxs_link').val() != 0) {
                vinsert += '>';
            }
            vinsert += '<img ' + valign2 + ' src="' + wpxs_escape_html(wpxs_imgs[cid].img_full) + '" width="' + wpxs_escape_html(wpxs_imgs[cid].img_width.toString()) + '" height="' + wpxs_escape_html(wpxs_imgs[cid].img_height.toString()) + '" title="' + wpxs_escape_html(wpxs_imgs[cid].img_title) + '" alt="' + wpxs_escape_html(wpxs_imgs[cid].img_title) + '"/>';
            if (jQuery('#wpxs_link').val() != 0) {
                vinsert += '</a>';
            }
            if (wpxs_imgs[cid].img_caption != '') {
                vinsert += ' ' + wpxs_escape_html(wpxs_imgs[cid].img_caption) + '[/caption]';
            }
            vinsert += '\n';
            if (!tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden()) {
                wpxs_insert_caret(eid, vinsert);
            } else {
                tinyMCE.activeEditor.execCommand('mceInsertContent', 0, vinsert);
            }
        }
        jQuery.colorbox.close();
    });

    jQuery('#wpxs_featured').live('click', function () {
        vffurl = jQuery('#wpxs_url').val();
        jQuery('#wpxs_featured_url').val(vffurl);
        jQuery('#postimagediv div.inside img').remove();
        jQuery('#postimagediv div.inside').prepend('<img src="' + vffurl + '" width="270"/>');
        jQuery.colorbox.close();
    });

    jQuery('#remove-post-thumbnail').live('click', function () {
        jQuery('#wpxs_featured_url').val('');
    });

    jQuery('.wpxs_item-overlay').live('click', function (event) {
        var checkbox = jQuery(this).parent().find(':checkbox');
        var checkbox_id = jQuery(this).attr('rel');

        jQuery.colorbox.resize({width: '930px', height: '460px'});
        wpxs_opened = true;
        wpxs_current = checkbox_id;

        if (event.ctrlKey) {

            if (!checkbox.is(':checked')) {
                wpxs_selected.push(checkbox_id);
            } else {
                wpxs_selected.splice(wpxs_selected.indexOf(checkbox_id), 1);
            }

            checkbox.attr('checked', !checkbox.is(':checked'));
        } else {
            if (!checkbox.is(':checked')) {
                wpxs_selected = [checkbox_id];
                jQuery('#wpxs_popup').find('input:checkbox').removeAttr('checked');
                checkbox.attr('checked', !checkbox.is(':checked'));
            }
        }

        jQuery('#wpxs_use-image').show();
        jQuery('#wpxs_title').val(wpxs_imgs[checkbox_id].img_title);
        jQuery('#wpxs_caption').val(wpxs_imgs[checkbox_id].img_caption);
        jQuery('#wpxs_width').val(wpxs_imgs[checkbox_id].img_width);
        jQuery('#wpxs_height').val(wpxs_imgs[checkbox_id].img_height);
        jQuery('#wpxs_site').val(wpxs_imgs[checkbox_id].img_site);
        jQuery('#wpxs_url').val(wpxs_imgs[checkbox_id].img_full);
        jQuery('#wpxs_view').html('<img src="' + wpxs_imgs[checkbox_id].img_full + '"/>');
        jQuery('#wpxs_error').html('');

        jQuery('#wpxs_insert').val('Insert (' + wpxs_selected.length + ')');
    });

    jQuery('#wpxs_title').change(function () {
        wpxs_change_value(wpxs_current, 'img_title', jQuery(this).val());
    });

    jQuery('#wpxs_caption').change(function () {
        wpxs_change_value(wpxs_current, 'img_caption', jQuery(this).val());
    });

    jQuery('#wpxs_width').change(function () {
        wpxs_change_value(wpxs_current, 'img_width', jQuery(this).val());
    });

    jQuery('#wpxs_height').change(function () {
        wpxs_change_value(wpxs_current, 'img_height', jQuery(this).val());
    });
});

function wpxs_search(page) {
    jQuery('#wpxs_spinner').show();
    jQuery('#wpxs_container').html('');
    jQuery('#wpxs_page').html('');
    idata = {
        action: 'wpxs_search',
        key: jQuery('#wpxs_input').val(),
        page: page,
        wpxs_nonce: wpxs_vars.wpxs_nonce
    };
    jQuery.ajax({
        method: 'POST',
        url: wpxs_vars.wpxs_ajax_url,
        data: idata,
        success: function (response) {
            wpxs_showimages(JSON.parse(response), page);
        },
        error: function () {
            console.log('error');
        },
    });
}

function wpxs_showimages(data, page) {
    jQuery('#wpxs_spinner').hide();
    if (data.photos != 'undefined') {
        for (var i = 0; i < data.photos.length; i++) {
            if (data.photos[i].id != undefined) {
                img_id = data.photos[i].id;
            } else {
                img_id = data.photos[i].id;
            }
            img_ext = data.photos[i].src.original.split('.').pop().toUpperCase().substring(0, 4);
            img_site = data.photos[i].url;
            img_thumb = data.photos[i].src.tiny;
            img_full = data.photos[i].src.original;
            img_width = data.photos[i].width;
            img_height = data.photos[i].height;
            if (data.photos[i].photographer != undefined) {
                img_title = String(data.photos[i].photographer);
            } else {
                img_title = img_id;
            }
            jQuery('#wpxs_container').append('<div class="wpxs_item" bg="' + img_thumb + '"><div class="wpxs_item-overlay" rel="' + img_id + '"></div><div class="wpxs_check"><input type="checkbox" value="' + img_id + '"/></div><span>' +
                img_ext + ' | ' + img_width + 'x' + img_height + '</span></div>'
            )
            wpxs_imgs[img_id] = {
                img_ext: img_ext,
                img_site: img_site,
                img_thumb: img_thumb,
                img_full: img_full,
                img_width: img_width,
                img_height: img_height,
                img_title: img_title,
                img_caption: ''
            };
        }
        jQuery('.wpxs_item').each(function () {
            imageUrl = jQuery(this).attr('bg');
            jQuery(this).css('background-image', 'url(' + imageUrl + ')');
        });
    }
    if (data.total_results != 'undefined') {
        var pages = 'About ' + data.total_results + ' results / Pages: ';
        if (data.total_results / 8 > 1) {
            pages += '<select id="wpxs_page-select" class="wpxs_page-select">';
            for (var j = 1; j < data.total_results / 8 + 1; j++) {
                pages += '<option value="' + j + '"';
                if (j == page) {
                    pages += ' selected';
                }
                pages += '>' + j + '</option> ';
            }
            pages += '</select>';
        }
        jQuery('#wpxs_page').html(pages);
    }
}

function wpxs_isurl(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
        '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
    return pattern.test(str);
}

function wpxs_change_value(img_id, img_field, img_value) {
    wpxs_imgs[img_id][img_field] = img_value;
}

function wpxs_insert_caret(areaId, text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
        "ff" : (document.selection ? "ie" : false));
    if (br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        strPos = range.text.length;
    }
    else if (br == "ff")
        strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0, strPos);
    var back = (txtarea.value).substring(strPos, txtarea.value.length);
    txtarea.value = front + text + back;
    strPos = strPos + text.length;
    if (br == "ie") {
        txtarea.focus();
        var range = document.selection.createRange();
        range.moveStart('character', -txtarea.value.length);
        range.moveStart('character', strPos);
        range.moveEnd('character', 0);
        range.select();
    }
    else if (br == "ff") {
        txtarea.selectionStart = strPos;
        txtarea.selectionEnd = strPos;
        txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}

function wpxs_escape_html(html) {
    var fn = function (tag) {
        var charsToReplace = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&#34;'
        };
        return charsToReplace[tag] || tag;
    }
    if (typeof html !== 'string') {
        return '';
    } else {
        return html.replace(/[&<>"]/g, fn);
    }
}