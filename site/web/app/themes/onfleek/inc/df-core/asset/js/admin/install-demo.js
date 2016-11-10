jQuery(document).ready(function(e) {
    jQuery(".install-button").live("click", function(e) {
        var t = jQuery(this).data("demo-name");
        jQuery("." + t + ".meter span").width("10%");
        var n = window.confirm("You are one click away to install the " + t.toUpperCase() + " demo in your site.\n\nAre you sure you want to do this?");
        if (1 == n) {
            var a = {
                action: "df_install_demo",
                demo_name: t,
                process: "install_xml",
                section: "pages",
                status: "success"
            };
            jQuery("." + t + ".meter span").animate({
                width: "10%"
            }, 8500), jQuery(".df-demo-import-loader").show(), jQuery(".meter." + t).show(), jQuery(".df-words-loading." + t).show(), install_pages(a)
        }
        e.preventDefault()
    }), install_customizer = function(e) {
        e.process = "install_theme_options", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_widgets(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "90%"
            }, 1500)
        }).fail(function() {
            alert("failed install theme-options")
        }).done(function() {
            install_widgets(e)
        })
    }, install_widgets = function(e) {
        e.process = "install_widgets", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", jQuery("." + e.demo_name + ".meter span").animate({
                width: "100%"
            }, 1500)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "100%"
            }, 1500), setTimeout(function() {
                "success" !== e.status ? jQuery(".df-error").show() : jQuery(".df-success").show(), jQuery(".df-demo-import-loader").fadeOut(1600), jQuery(".meter").fadeOut(1600), jQuery("html, body").animate({
                    scrollTop: 0
                }, 1800)
            }, 3e3)
        }).fail(function() {
            alert("failed install widgets")
        })
    }, install_pages = function(e) {
        e.section = "pages", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_post(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "30%"
            }, 1500)
        }).fail(function() {
            alert("failed install page")
        }).done(function() {
            install_post(e)
        })
    }, install_post = function(e) {
        e.section = "post", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_menu(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "40%"
            }, 1500)
        }).fail(function() {
            alert("failed install post")
        }).done(function() {
            install_menu(e)
        })
    }, install_menu = function(e) {
        e.section = "menu", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_media(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "40%"
            }, 1500)
        }).fail(function() {
            alert("failed install menu")
        }).done(function() {
            install_media(e)
        })
    }, install_media = function(e) {
        e.section = "media", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_customizer(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "60%"
            }, 1500)
        }).fail(function() {
            alert("failed install media")
        }).done(function() {
            install_media_2(e)
        })

    }, install_media_2 = function(e) {
        e.section = "media_02", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_customizer(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "75%"
            }, 1500)
        }).fail(function() {
            alert("failed install media")
        }).done(function() {
            install_media_3(e)
        })

    }, install_media_3 = function(e) {
        e.section = "media_03", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_customizer(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "80%"
            }, 1500)
        }).fail(function() {
            alert("failed install media")
        }).done(function() {
            install_media_4(e)
        })

    }, install_media_4 = function(e) {
        e.section = "media_04", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_customizer(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "85%"
            }, 1500)
        }).fail(function() {
            alert("failed install media")
        }).done(function() {
            install_media_5(e)
        })

    }, install_media_5 = function(e) {
        e.section = "media_05", jQuery.post(ajaxurl, e, function(t) {
            t && -1 == t.indexOf("successful") ? (e.status = "failed", install_customizer(e)) : jQuery("." + e.demo_name + ".meter span").animate({
                width: "87%"
            }, 1500)
        }).fail(function() {
            alert("failed install media")
        }).done(function() {
            install_customizer(e)
        })

    } 
});