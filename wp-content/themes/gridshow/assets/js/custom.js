jQuery(document).ready(function($) {
    'use strict';

    if(gridshow_ajax_object.secondary_menu_active){

        $(".gridshow-nav-secondary .gridshow-secondary-nav-menu").addClass("gridshow-secondary-responsive-menu");

        $( ".gridshow-secondary-responsive-menu-icon" ).on( "click", function() {
            $(this).next(".gridshow-nav-secondary .gridshow-secondary-nav-menu").slideToggle();
        });

        $(window).on( "resize", function() {
            if(window.innerWidth > 1112) {
                $(".gridshow-nav-secondary .gridshow-secondary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
                $(".gridshow-secondary-responsive-menu > li").removeClass("gridshow-secondary-menu-open");
            }
        });

        $( ".gridshow-secondary-responsive-menu > li" ).on( "click", function(event) {
            if (event.target !== this)
            return;
            $(this).find(".sub-menu:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-secondary-menu-open");
            $(this).find(".children:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-secondary-menu-open");
        });

        $( "div.gridshow-secondary-responsive-menu > ul > li" ).on( "click", function(event) {
            if (event.target !== this)
                return;
            $(this).find("ul:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-secondary-menu-open");
        });

    }

    if(gridshow_ajax_object.headnavi_menu_active){

        $(".gridshow-nav-headnavi .gridshow-headnavi-nav-menu").addClass("gridshow-headnavi-responsive-menu");

        $( ".gridshow-headnavi-responsive-menu-icon" ).on( "click", function() {
            $(this).next(".gridshow-nav-headnavi .gridshow-headnavi-nav-menu").slideToggle();
        });

        $(window).on( "resize", function() {
            if(window.innerWidth > 1112) {
                $(".gridshow-nav-headnavi .gridshow-headnavi-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
                $(".gridshow-headnavi-responsive-menu > li").removeClass("gridshow-headnavi-menu-open");
            }
        });

        $( ".gridshow-headnavi-responsive-menu > li" ).on( "click", function(event) {
            if (event.target !== this)
            return;
            $(this).find(".sub-menu:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-headnavi-menu-open");
            $(this).find(".children:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-headnavi-menu-open");
        });

        $( "div.gridshow-headnavi-responsive-menu > ul > li" ).on( "click", function(event) {
            if (event.target !== this)
                return;
            $(this).find("ul:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-headnavi-menu-open");
        });

    }

    if(gridshow_ajax_object.primary_menu_active){

        // grab the initial top offset of the navigation 
        var gridshowstickyNavTop = $('.gridshow-primary-menu-container').offset().top;
        
        // our function that decides weather the navigation bar should have "fixed" css position or not.
        var gridshowstickyNav = function(){
            var gridshowscrollTop = $(window).scrollTop(); // our current vertical position from the top
                 
            // if we've scrolled more than the navigation, change its position to fixed to stick to top,
            // otherwise change it back to relative

            if(window.innerWidth > 1112) {
                if (gridshowscrollTop > gridshowstickyNavTop) {
                    $('.gridshow-primary-menu-container').addClass('gridshow-fixed');
                } else {
                    $('.gridshow-primary-menu-container').removeClass('gridshow-fixed'); 
                }
            }
        };

        gridshowstickyNav();
        // and run it again every time you scroll
        $(window).on( "scroll", function() {
            gridshowstickyNav();
        });

        $(".gridshow-nav-primary .gridshow-primary-nav-menu").addClass("gridshow-primary-responsive-menu");

        $( ".gridshow-primary-responsive-menu-icon" ).on( "click", function() {
            $(this).next(".gridshow-nav-primary .gridshow-primary-nav-menu").slideToggle();
        });

        $(window).on( "resize", function() {
            if(window.innerWidth > 1112) {
                $(".gridshow-nav-primary .gridshow-primary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
                $(".gridshow-primary-responsive-menu > li").removeClass("gridshow-primary-menu-open");
            }
        });

        $( ".gridshow-primary-responsive-menu > li" ).on( "click", function(event) {
            if (event.target !== this)
            return;
            $(this).find(".sub-menu:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-primary-menu-open");
            $(this).find(".children:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-primary-menu-open");
        });

        $( "div.gridshow-primary-responsive-menu > ul > li" ).on( "click", function(event) {
            if (event.target !== this)
                return;
            $(this).find("ul:first").toggleClass('gridshow-submenu-toggle').parent().toggleClass("gridshow-primary-menu-open");
        });

    }

    if($(".gridshow-header-social-icon-search").length){
        $(".gridshow-header-social-icon-search").on('click', function (e) {
            e.preventDefault();
            //document.getElementById("gridshow-search-overlay-wrap").style.display = "block";
            $("#gridshow-search-overlay-wrap").fadeIn();
            const gridshow_focusableelements = 'button, [href], input';
            const gridshow_search_modal = document.querySelector('#gridshow-search-overlay-wrap');
            const gridshow_firstfocusableelement = gridshow_search_modal.querySelectorAll(gridshow_focusableelements)[0];
            const gridshow_focusablecontent = gridshow_search_modal.querySelectorAll(gridshow_focusableelements);
            const gridshow_lastfocusableelement = gridshow_focusablecontent[gridshow_focusablecontent.length - 1];
            document.addEventListener('keydown', function(e) {
              let isTabPressed = e.key === 'Tab' || e.keyCode === 9;
              if (!isTabPressed) {
                return;
              }
              if (e.shiftKey) {
                if (document.activeElement === gridshow_firstfocusableelement) {
                  gridshow_lastfocusableelement.focus();
                  e.preventDefault();
                }
              } else {
                if (document.activeElement === gridshow_lastfocusableelement) {
                  gridshow_firstfocusableelement.focus();
                  e.preventDefault();
                }
              }
            });
            gridshow_firstfocusableelement.focus();
        });
    }

    if($(".gridshow-search-closebtn").length){
        $(".gridshow-search-closebtn").on('click', function (e) {
            e.preventDefault();
            //document.getElementById("gridshow-search-overlay-wrap").style.display = "none";
            $("#gridshow-search-overlay-wrap").fadeOut();
        });
    }

    if(gridshow_ajax_object.fitvids_active){
        $(".entry-content, .widget").fitVids();
    }

    if(gridshow_ajax_object.backtotop_active){
        if($(".gridshow-scroll-top").length){
            var gridshow_scroll_button = $( '.gridshow-scroll-top' );
            gridshow_scroll_button.hide();

            $( window ).on( "scroll", function() {
                if ( $( window ).scrollTop() < 20 ) {
                    $( '.gridshow-scroll-top' ).fadeOut();
                } else {
                    $( '.gridshow-scroll-top' ).fadeIn();
                }
            } );

            gridshow_scroll_button.on( "click", function() {
                $( "html, body" ).animate( { scrollTop: 0 }, 300 );
                return false;
            } );
        }
    }

    if(gridshow_ajax_object.sticky_sidebar_active){
        $('.gridshow-main-wrapper, .gridshow-sidebar-one-wrapper').theiaStickySidebar({
            containerSelector: ".gridshow-content-wrapper",
            additionalMarginTop: 0,
            additionalMarginBottom: 0,
            minWidth: 960,
        });

        $(window).on( "resize", function() {
            $('.gridshow-main-wrapper, .gridshow-sidebar-one-wrapper').theiaStickySidebar({
                containerSelector: ".gridshow-content-wrapper",
                additionalMarginTop: 0,
                additionalMarginBottom: 0,
                minWidth: 960,
            });
        });
    }

});