var all_ids = [],
    all_langs = [],
    owl_datas = [];


window.onload = function () {

    $(".slider").each(function (index, element) {
        if ($(element).attr("id") != "category-slider" && $(element).attr("id") != "govazd-slider") {
            all_ids.push($(element).attr("id"));
            all_langs.push($(element).attr("id"));
        }
    });
    var fillPreviewWithChannel = function (id, lang) {
        var num = +id.split("_")[id.split("_").length - 1].replace(/^\D+/g, '');

        $("." + lang + "-preview").find(".channel-image").attr("src", tvs[num]["path"]);

        //$("." + lang + "-preview").find(".rating-container input").attr("value", tvs[num]["rating"]);
        $("." + lang + "-preview").find(".rating-container input").rating('update', tvs[num]["rating"]);
       // $("." + lang + "-preview").find(".rating-container .rating-stars").css("width", tvs[num]["rating"] / 5 * 100 + "%");
        $("." + lang + "-preview").find(".preview-channel-name").text(tvs[num]["title"]);
        $("." + lang + "-preview").find(".preview-image .list_right a").attr("href", tvs[num]["alias"]);
        $("." + lang + "-preview").find(".preview-channel-info").text(tvs[num]["description"]);
        $("." + lang + "-preview").find(".input-for-id").attr("value", tvs[num]["id"]);
    }

    var good = function () {
        var slide_height = $("#" + all_ids[0] + " .item").height();
        var slide_width = $("#" + all_ids[0] + " .owl-item").width();

        $(".owl-item").unbind('mouseenter mouseleave');

        var itemHovers = function (lang) {
            $("#" + lang + " .owl-item").hover(function () {
                    if ($(document).width() > 479) {
                        if (!$(this).hasClass("first-slide") && !$(this).hasClass("last-slide")) {
                            $("#" + lang + " .owl-wrapper").css("left", -slide_width * 0.25 + "px");
                        } else if ($(this).hasClass("last-slide") && !$(this).hasClass("first-slide")) {
                            $("#" + lang + " .owl-wrapper").css("left", -slide_width * 0.5 + "px");
                        }

                        $(this).width(slide_width * 1.5);
                        $(this).css("margin-top", -slide_height * 0.25 + "px");

                    }
                    $(this).find(".more, .play").addClass("active");
                    var t = $(this).find(".item").attr("id");
                    $("#" + lang + " .item").removeClass("opened");
                    if ($("." + lang + "-preview").hasClass("opened")) {
                        $(this).find(".item").addClass("opened");
                    }
                    fillPreviewWithChannel(t, lang);

                },
                function () {
                    $("#" + lang + " .owl-wrapper").css("left", "0px");
                    $(this).width(slide_width);
                    $(this).css("margin-top", "0px");
                    $(this).find(".more, .play").removeClass("active");
                });
        };

        for (var i = 0; i < all_ids.length; i++) {
            itemHovers(all_langs[i]);
        }

        for (var i = 0; i < all_ids.length; i++) {
            $("#" + all_ids[i] + " .owl-prev," + "#" + all_ids[i] + " .owl-next").height(slide_height);
            $("#" + all_ids[i] + " .owl-wrapper-outer").height(slide_height * 1.6);
            $("#" + all_ids[i] + " .owl-item").width(slide_width);
            $("#" + all_ids[i] + " .owl-wrapper").css("margin-top", slide_height * 0.25 + "px");
            $("#" + all_ids[i] + " .owl-controls .owl-buttons .owl-prev").css("margin-top", slide_height * 0.25 + 3 + "px");
            $("#" + all_ids[i] + " .owl-controls .owl-buttons .owl-next").css("margin-top", slide_height * 0.25 + 3 + "px");
        }

        $("#category-slider .owl-prev,#category-slider .owl-next").height(slide_height);
        $("#category-slider .owl-wrapper-outer").height(slide_height * 1.6);
        $("#category-slider .owl-item").width(slide_width);
        $("#category-slider .owl-wrapper").css("margin-top", slide_height * 0.25 + "px");
        $("#category-slider .owl-controls .owl-buttons .owl-prev").css("margin-top", slide_height * 0.25 + 3 + "px");
        $("#category-slider .owl-controls .owl-buttons .owl-next").css("margin-top", slide_height * 0.25 + 3 + "px");

        $("#queue-scrollbar").perfectScrollbar();

    }

    $("#queue-search").on("keyup", function () {
        var search_word = $(this).val().toLowerCase();
        $(".queue-vid").each(function (index, element) {
            var curr_text = $(element).find(".vid-desc").find(".name").text().toLowerCase();
            if (curr_text.indexOf(search_word) === -1) {
                $(element).addClass("search-hide");
            } else {
                $(element).removeClass("search-hide");
            }
        });
    });

    $("#search-channel-input").on("keyup", function () {
        var search_word = $(this).val().toLowerCase();
        $(".one-channel").each(function (index, element) {
            var curr_text = $(element).find(".one-channel-hover").find("p").text().toLowerCase();
            if (curr_text.indexOf(search_word) === -1) {
                $(element).addClass("search-hide");
            } else {
                $(element).removeClass("search-hide");
            }
        });
    });

    $("#history-search").on("keyup", function () {
        var search_word = $(this).val().toLowerCase();
        $(".history-result").each(function (index, element) {
            var curr_text = $(element).find(".name").text().toLowerCase();
            if (curr_text.indexOf(search_word) === -1) {
                $(element).addClass("search-hide");
            } else {
                $(element).removeClass("search-hide");
            }
        });
    });

    $("#favorites-search").on("keyup", function () {

        var search_word = $(this).val().toLowerCase();
        $(".one-favorite-wrapper").each(function (index, element) {
            var curr_text = $(element).find(".name").text().toLowerCase() + $(element).find(".desc").text().toLowerCase();
            if (curr_text.indexOf(search_word) === -1) {
                $(element).addClass("search-hide");
            } else {
                $(element).removeClass("search-hide");
            }
        });
    });

    $(".history-content input").on("change", function () {
        var checked = false;
        $(".history-content input").each(function (index, element) {
            if ($(element).is(":checked")) {
                checked = true;
                return false;
            }
        });
        if(checked){
            $(".remove-items-history-btn").removeAttr("disabled");
            $(".clear-history-btn").attr("disabled",true);
        }else{
            $(".clear-history-btn").removeAttr("disabled");
            $(".remove-items-history-btn").attr("disabled",true);
        }
    })

    $(".favorites-content .fav-button").on("click",function(){
        $(this).toggleClass("pressed");
    });

    $(".profile-exit").on("click", function () {
        $(".hidden-menu").toggleClass("hide");
        return false;
    });

    $(document).scroll(function () {
        if ($(document).scrollTop() > 0) {
            $(".main-navbar").addClass("scrolled");
        } else {
            $(".main-navbar").removeClass("scrolled");
        }
    });

    /*--- initialize owl carousels ---*/
    var addOwl = function (id, lang) {
        $(id).owlCarousel({
            items: 6,
            lazyLoad: true,
            scrollPerPage: true,
            navigation: true,
            slideSpeed: 400,
            addClassActive: true,
            mouseDrag: false,
            afterAction: function () {
                if (lang) { // setting of next-prev pictures
                    var current_ids = [];
                    $(id + " .item").each(function (index, element) {
                        current_ids.push($(element).attr("id"));
                    });

                    $(id + " .owl-item").removeClass("first-slide last-slide");
                    var count_of_active_slides = $(id + " .owl-item.active").length - 1;
                    var last = current_ids.length - 1;
                    $(id + " .owl-item.active")[0].classList.add("first-slide");
                    $(id + " .owl-item.active")[count_of_active_slides].classList.add("last-slide");


                    var prev_num = current_ids.indexOf($(id + " .first-slide").find(".item").attr("id")) - 1;
                    var next_num = current_ids.indexOf($(id + " .last-slide").find(".item").attr("id")) + 1;

                    if (prev_num == -1) {
                        prev_num = last;
                    }
                    if (next_num - 1 == last) {
                        next_num = 0;
                    }
                    $(id + " .owl-controls .owl-buttons .owl-prev").css("backgroundImage", "url(/images/prev-slide.png), url(" + $("#" + current_ids[prev_num]).find("img").attr("src") + ")");
                    $(id + " .owl-controls .owl-buttons .owl-next").css("backgroundImage", "url(/images/next-slide.png), url(" + $("#" + current_ids[next_num]).find("img").attr("src") + ")");
                }
            }
        });
    };
    for (var i = 0; i < all_ids.length; i++) {
        addOwl("#" + all_ids[i], all_langs[i]);
    }
    /*--- eof initialize owl carousels ---*/

    $("#category-slider").owlCarousel({
        items: 6,
        lazyLoad: true,
        scrollPerPage: true,
        navigation: true,
        slideSpeed: 400,
        addClassActive: true,
        mouseDrag: false,
        afterAction: function () {}
    });
    $("#govazd-slider").owlCarousel({
        items: 2,
        lazyLoad: true,
        scrollPerPage: true,
        navigation: false,
        addClassActive: true,
        mouseDrag: false,
        autoPlay: 2500,
        afterAction: function () {
        }
    });

    for (var i = 0; i < all_ids.length; i++) {
        owl_datas.push($("#" + all_ids[i]).data('owlCarousel'));
    }

    /*--- click on slider item ---*/
    var addClickEventOnItems = function (id) {
        $(id + " .owl-item").on("click", function () {
            $(id + " .item").removeClass("opened");
            $(this).find(".item").addClass("opened");
        });
    };
    for (var i = 0; i < all_ids.length; i++) {
        addClickEventOnItems("#" + all_ids[i]);
    }
    /*--- eof click on slider item ---*/

    /*--- click on more button ---*/
    var moreListener = function (lang) {
        $("." + lang + "_more").on("click", function (e) {
            e.preventDefault();
            if ($("." + lang + "-preview").hasClass("opened")) {
                var parent_id = $(this).closest(".item").attr("id");
                fillPreviewWithChannel(parent_id, lang);

            } else {
                var parent_id = $(this).closest(".item").attr("id");
                fillPreviewWithChannel(parent_id, lang);
                $("." + lang + "-preview").addClass("opened");

            }
        });
    };
    for (var i = 0; i < all_ids.length; i++) {
        moreListener(all_langs[i]);
    }
    /*--- eof click on more button ---*/


    /*--- click on preview's close button ---*/
    var closePreviewListener = function (lang) {
        $("." + lang + "-preview .close-preview").on("click", function () {
            $("." + lang + "-preview").removeClass("opened");
            $("#" + lang + " .item").removeClass("opened");
        });
    }
    for (var i = 0; i < all_ids.length; i++) {
        closePreviewListener(all_langs[i]);
    }
    /*--- eof click on preview's close button ---*/

    good();

    $(window).resize(function () {

        for (var i = 0; i < all_ids.length; i++) {
            owl_datas[i].reinit({
                items: 6,
                lazyLoad: true,
                scrollPerPage: true,
                navigation: true,
                slideSpeed: 400,
                addClassActive: true,
                mouseDrag: false,
            });
        }

        good();
    });

    $('.preview-channel-link').on('click', function(){
        var self = this;
        var obj = {};
        setTimeout(function () {
            if ($(self).closest("#preview_cont").parent().hasClass("tv_slide")) {
                obj.type = "tv_id";
            } else if ($(self).closest("#preview_cont").parent().hasClass("program_slide")) {
                obj.type = "program_id"
            }
            obj.id = +$(self).closest("#preview_cont").find(".input-for-id").val();
            console.log(obj);
            $.ajax({
                type: "POST",
                url: "/site/ajax-favorites",
                data: obj,
                success: function (data) {
                    if(data != 0) {
                        $(self).html("<i style='color: red' class='fa fa-times'></i>");
                    }
                },
            });
        }, 5);
    });

    $(".rating-stars").on("click", function () {
        var self = this;
        var obj = {};
        setTimeout(function () {
            if ($(self).closest("#preview_cont").parent().hasClass("tv_slide")) {
                obj.type = "tv_id";
            } else if ($(self).closest("#preview_cont").parent().hasClass("program_slide")) {
                obj.type = "program_id"
            }
            obj.rating = Math.round(+$(self).next().val());
            obj.id = +$(self).closest("#preview_cont").find(".input-for-id").val();

            $.ajax({
                type: "POST",
                url: "/site/rating",
                data: obj,
                success: function (data) {
                    if(data != 0) {
                        var num = +obj["id"];
                        $(self).closest("#preview_cont").parent().find('#ret_'+num+' span').text(data)
                        tvs[num]["rating"] = +data;
                        $(self).closest(".channel_preview").find(".rating-container input").rating('update', +data);
                    }
                },
            });
        }, 5);
    });
    //$(document).keydown(function(event){
    //    if(event.keyCode==123){
    //        return false;
    //    }
    //    else if (event.ctrlKey && event.shiftKey && event.keyCode==73){
    //        return false;
    //    }
    //});
    //
    //$(document).on("contextmenu",function(e){
    //    e.preventDefault();
    //});
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-73654208-1', 'auto');
    ga('send', 'pageview');

    /*
    *facebook share
    */
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=703658073027422";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

  
};
