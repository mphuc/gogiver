$(function() {
    $("[data-countdown]").each(function() {
        var a = $(this),
            b = $(this).data("countdown");
        a.countdown(b, function(b) {
            a.html(b.strftime('<span style="color:#797979;"> </span>%D Days %H:%M:%S'))
        })
    })
}), $(document).ready(function() {
    var g = {
        ajaxSumTreeMember: function(a) {
            $.ajax({
                url: $(".downline-tree").data("link"),
                type: "GET",
                data: {
                    id: $(".downline-tree").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetPin: function(a) {
            $.ajax({
                url: $(".pin-balence").data("link"),
                type: "GET",
                data: {
                    id: $(".pin-balence").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxAnalytics: function(a, b) {
            $.ajax({
                url: a.data("link"),
                type: "GET",
                data: {
                    id: a.data("id"),
                    level: a.data("level")
                },
                async: !1,
                success: function(a) {
                    a = $.parseJSON(a), b(a)
                }
            })
        },
        ajaxGetTotalPD: function(a) {
            $.ajax({
                url: $(".pd-count").data("link"),
                type: "GET",
                data: {
                    id: $(".pd-count").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetTotalGD: function(a) {
            $.ajax({
                url: $(".gd-count").data("link"),
                type: "GET",
                data: {
                    id: $(".gd-count").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetR_Wallet: function(a) {
            $.ajax({
                url: $(".r-wallet").data("link"),
                type: "GET",
                data: {
                    id: $(".r-wallet").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetC_Wallet: function(a) {
            $.ajax({
                url: $(".c-wallet").data("link"),
                type: "GET",
                data: {
                    id: $(".c-wallet").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetM_Wallet: function(a) {
            $.ajax({
                url: $(".m-wallet").data("link"),
                type: "GET",
                data: {
                    id: $(".m-wallet").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetTotal_Binary_Left: function(a) {
            $.ajax({
                url: $(".total_left").data("link"),
                type: "GET",
                data: {
                    id: $(".total_left").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetTotal_PD_Left: function(a) {
            $.ajax({
                url: $(".total_pd_left").data("link"),
                type: "GET",
                data: {
                    id: $(".total_pd_left").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetTotal_Binary_Right: function(a) {
            $.ajax({
                url: $(".total_right").data("link"),
                type: "GET",
                data: {
                    id: $(".total_right").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        },
        ajaxGetTotal_PD_Right: function(a) {
            $.ajax({
                url: $(".total_pd_right").data("link"),
                type: "GET",
                data: {
                    id: $(".total_pd_right").data("id")
                },
                async: !1,
                success: function(b) {
                    b = $.parseJSON(b), a(b)
                }
            })
        }
    };


    g.ajaxGetPin(function(a) {
        _.has(a, "success") && $(".pin-balence").animateNumber({ number: _.values(a)[0] }, 2000), _.each($(".pin-balence").data(), function(a, b) {
            $(".pin-balence").removeAttr("data-" + b)
        }), $(".tile-image-pin-balance + div.tile-footer").css({
            "background-image": "none"
        })
    }), g.ajaxGetTotalPD(function(a) {
        _.has(a, "success") && $(".pd-count").animateNumber({ number: _.values(a)[0] }, 2000), _.each($(".pd-count").data(), function(a, b) {
            $(".pd-count").removeAttr("data-" + b)
        }), $(".tile-image-ph + div.tile-footer").css({
            "background-image": "none"
        })
    }), g.ajaxGetR_Wallet(function(a) {
        _.has(a, "success") && $(".r-wallet").html(_.values(a)[0] ), _.each($(".r-wallet").data(), function(a, b) {
            $(".r-wallet").removeAttr("data-" + b)
        }), $("div.tile-image-r-wallet + div.tile-footer").css({
            "background-image": "none"
        })
    }), g.ajaxGetC_Wallet(function(a) {
        _.has(a, "success") && $(".c-wallet").html(_.values(a)[0] ), _.each($(".c-wallet").data(), function(a, b) {
            $(".r-wallet").removeAttr("data-" + b)
        }), $(".tile-image-c-wallet + div.tile-footer").css({
            "background-image": "none"
        })
    }), g.ajaxGetM_Wallet(function(a) {
        _.has(a, "success") && $(".m-wallet").html(_.values(a)[0] ), _.each($(".m-wallet").data(), function(a, b) {
            $(".m-wallet").removeAttr("data-" + b)
        }), $(".tile-image-m-wallet + div.tile-footer").css({
            "background-image": "none"
        })
    }), g.ajaxGetTotalGD(function(a) {
        _.has(a, "success") && $(".gd-count").animateNumber({ number: _.values(a)[0] }, 2000), _.each($(".gd-count").data(), function(a, b) {
            $(".gd-count").removeAttr("data-" + b)
        }), $(".tile-image-gh + div.tile-footer").css({
            "background-image": "none"
        })
    }), g.ajaxSumTreeMember(function (a){
        _.has(a, "success") && $(".downline-tree").animateNumber({ number: _.values(a)[0] }, 2000), _.each($(".downline-tree").data(), function(a, b) {
            $(".downline-tree").removeAttr("data-" + b)
        })
    })
});