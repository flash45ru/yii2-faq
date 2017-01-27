if (typeof usesgraphcrt == "undefined" || !usesgraphcrt) {
    var usesgraphcrt = {};
}

usesgraphcrt.faq = {
    
    init: function() {
        $(document).on('click','.usesgraphcrt-faq-search', this.search);
    },

    search: function() {
        var searchText = $('[data-role=search-text]').val(),
            url = $('.usesgraphcrt-faq-search').data('url');
            url.replace("#","");
        $.post(
            url,
            {data: searchText},
            function (response){
                $('[data-role=faq-view]').html(response);
            }
        );
    },

    getUrlVar: function () {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    },

    load: function(url) {
        $('[data-role=faq-view]').load(url, function() {
            $('[data-role=faq-view]').fadeIn();
        });
    }
};

$(document).ready(function () {

    if (location.hash) {
        url = location.hash.replace("#/","");
        $(document).find("[data-id = "+usesgraphcrt.faq.getUrlVar()["id"]+"]").closest('li').addClass('active');
        usesgraphcrt.faq.load(location.hash.replace("#/",""));
    }

    $(".sub > a").click(function() {
        var ul = $(this).next(),
            clone = ul.clone().css({"height":"auto"}).appendTo(".mini-menu"),
            height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";
        clone.remove();
        ul.animate({"height":height});
        return false;
    });

    $('.mini-menu > ul > li > a').click(function(){
        $('.sub a').removeClass('active');
        $(this).addClass('active');
    }),

    $('.faq-menu ul li a').click(function(){
        $('.faq-menu ul li').removeClass('active');
        $(this).closest('li').addClass('active');
    });

    $('[data-role=search-text]').keydown(function(e) {
        if (e.which == 13) {
            usesgraphcrt.faq.search();
        }
    });
    
    $('[data-role=faq-load]').on('click',function () {
        url = $(this).data('url');
        usesgraphcrt.faq.load(url.replace("#",""));
        window.history.pushState(1,'title',url.replace(/\/faq/g,''));
    });
    
});

usesgraphcrt.faq.init();
