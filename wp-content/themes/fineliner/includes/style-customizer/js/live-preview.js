jQuery(document).ready(function($) {
    
    /* #Global: Primary Font
    ================================================== */
    wp.customize('uxbarn_sc_global_styles[primary_font]', function(value) {
        value.bind(function(newval) {
            if(newval != '-1') {
                $('#logo h1, #header-search-input, .slider-caption .caption-title, #content-container h1, #content-container h2, #content-container h3, #content-container h4, #content-container h5, .testimonial-inner').not('#sidebar-wrapper h4, #footer-content h5').css('font-family', getCleanValueForGoogleFonts(newval));
            } else {
                $('#header-search-input, .slider-caption .caption-title, #content-container h1, #content-container h2, #content-container h3, #content-container h4, #content-container h5, .testimonial-inner').css('font-family', '');
            }
        } );
    } );
    
    /* #Global: Secondary Font
    ================================================== */
    wp.customize('uxbarn_sc_global_styles[secondary_font]', function(value) {
        value.bind(function(newval) {
            if(newval != '-1') {
                $('#logo p, #root-menu, .slider-caption .caption-body, #content-container, #content-container .columns, #intro p, #footer-content-container, #footer-bar-container, #sidebar-wrapper h4').css('font-family', getCleanValueForGoogleFonts(newval));
            } else {
                $('#logo p, #root-menu, .slider-caption .caption-body, #content-container, #content-container .columns, #intro p, #footer-content-container, #footer-bar-container').css('font-family', '');
            }
        } );
    } );
    
    
    
    /* #Site Background: Bg color
    ================================================== */
    wp.customize('uxbarn_sc_site_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-color', newval);
        } );
    } );
    
    /* #Site Background: Bg image and attributes
    ================================================== */
    wp.customize('uxbarn_sc_site_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_site_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_site_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-position', newval);
        } );
    } );
    
    
    
    /* #Header: Title and tagline
    ================================================== */
    wp.customize('uxbarn_sc_header_styles[site_title_color]', function(value) {
        value.bind(function(newval) {
            $('#logo h1').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_header_styles[site_tagline_color]', function(value) {
        value.bind(function(newval) {
            $('#tagline').css('color', newval);
        } );
    } );
    
    
    
    /* #Home Slider: Controller colors and hovered one
    ================================================== */
    wp.customize('uxbarn_sc_home_slider_styles[controller_color]', function(value) {
        value.bind(function(newval) {
            $('.slider-controller').css('background', newval);
        } );
    } );
    
    
    
    /* #Page Intro: Colors
    ================================================== */
    wp.customize('uxbarn_sc_page_intro_styles[title_color]', function(value) {
        value.bind(function(newval) {
            $('#intro h1, #intro h2').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_page_intro_styles[body_color]', function(value) {
        value.bind(function(newval) {
            $('#intro p').css('color', newval);
        } );
    } );
    
    
    
    /* #Content: Content bg
    ================================================== */
    wp.customize('uxbarn_sc_content_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('#root-container').css('background-color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('#root-container').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('#root-container').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('#root-container').css('background-position', newval);
        } );
    } );
    
    
    
    /* #Sidebar: colors
    ================================================== */
    wp.customize('uxbarn_sc_sidebar_body_styles[heading_color]', function(value) {
        value.bind(function(newval) {
            $('#sidebar-wrapper .widget-item h4').css('color', newval);
        } );
    } );
    
    
    
    /* #Footer: Body colors
    ================================================== */
    wp.customize('uxbarn_sc_footer_body_styles[heading_color]', function(value) {
        value.bind(function(newval) {
            $('#footer-content h5').css('color', newval);
        } );
    } );
    
    
    
    
    
    
    
    
    /* #Utilities
    ================================================== */
    function getCleanValueForGoogleFonts(input) {
        // Clean value only if it's Google Fonts
        if(input.indexOf('[#GF#]') != -1) {
            input = input.replace('[#GF#]', '').split(':');//.replace(/[^a-zA-Z\s]/gi, '');
            input = '\'' + input[0] + '\', sans-serif';
        }
        
        return input;
    }
    

    function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16);}
    function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16);}
    function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16);}
    function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h;}
    
    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
    
        console.log(out);
    
        // or, if you wanted to avoid alerts...
    
        /*var pre = document.createElement('pre');
        pre.innerHTML = out;
        document.body.appendChild(pre)*/
    }
    
});