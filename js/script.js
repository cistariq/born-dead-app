// <![CDATA[
$(function() {

  // Slider
  $('#coin-slider').coinslider({width:697,height:329,opacity:1});

  // Radius Box
  $('.menu_nav ul li a, .post_content a.rm').css({"border-radius":"20px", "-moz-border-radius":"20px", "-webkit-border-radius":"20px"});
  //$('.article a.com').css({"border-top-right-radius":"10px", "border-bottom-right-radius":"10px", "-moz-border-radius-topright":"10px", "-moz-border-radius-bottomright":"10px", "-webkit-border-top-right-radius":"10px", "-webkit-border-bottom-right-radius":"10px"});
  //$('.content p.pages span, .content p.pages a').css({"border-radius":"16px", "-moz-border-radius":"16px", "-webkit-border-radius":"16px"});
  //$('.menu_nav').css({"border-bottom-left-radius":"16px", "border-bottom-right-radius":"16px", "-moz-border-radius-bottomleft":"16px", "-moz-border-radius-bottomright":"16px", "-webkit-border-bottom-left-radius":"16px", "-webkit-border-bottom-right-radius":"16px"});

});	

// Cufon
Cufon.replace('h1, h2, h3, h4, h5, h6, .article a.com, .menu_nav ul li a, .post_content a.rm', { hover: true });
//Cufon.replace('h1', { color: '-linear-gradient(#fff, #ffaf02)'});
//Cufon.replace('h1 small', { color: '#8a98a5'});

// ]]>