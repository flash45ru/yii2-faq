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
        $.post(
            url,
            {data: searchText},
            function (response){
                $('[data-role=faq-view]').html(response);
            }
        );
    },

    load: function(url) {
        $('[data-role=faq-view]').load(url, function() {
            $('[data-role=faq-view]').fadeIn();
        });
    }
};

$(document).ready(function () {

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
    
    $('[data-role=faq-load]').on('click',function () {
        usesgraphcrt.faq.load($(this).data('url'));
    });
    
});

usesgraphcrt.faq.init();
