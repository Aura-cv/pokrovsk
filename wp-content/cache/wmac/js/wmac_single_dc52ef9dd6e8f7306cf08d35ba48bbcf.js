jQuery(document).ready(function($){$('.posts').each(function(){var t=$(this).find('.desc p').text();if(!t.indexOf('For the sake of viewer convenience, the content is shown below in the alternative language. You may click the link to switch the active language.')){$(this).find('.desc p').text('');}});$('.slider .full .item:first, .slider .switch .item:first').addClass('slick-current slick-active');$('.slider .switch .item').click(function(){var i=$(this).index();$('.slider .switch .item').removeClass('slick-current slick-active');$(this).addClass('slick-current slick-active');$('.slider .full .item').removeClass('slick-current slick-active');$('.slider .full .item').eq(i).addClass('slick-current slick-active');});$('.slide-arrow.arrow-right').click(function(){if(!$('.slider .full .item:last').hasClass('slick-current')){$('.slider .full .slick-current').removeClass('slick-current slick-active').next('.item').addClass('slick-current slick-active');}else{$('.slider .full .item').removeClass('slick-current slick-active');$('.slider .full .item').eq(0).addClass('slick-current slick-active');}});$('.slide-arrow.arrow-left').click(function(){if(!$('.slider .full .item:first').hasClass('slick-current')){$('.slider .full .slick-current').removeClass('slick-current slick-active').prev('.item').addClass('slick-current slick-active');}else{$('.slider .full .item').removeClass('slick-current slick-active');$('.slider .full .item').eq(4).addClass('slick-current slick-active');}});$('.tabs > ul > li').click(function(){var i=$(this).index();if(!$(this).hasClass('active')){$('.news .list .col').slideUp(500);$('.news .list .col').eq(i).slideDown(500);$('.tabs > ul > li').removeClass('active');$(this).addClass('active');}});$('.video .list').slick({arrows:true,autoplay:true,slidesToShow:4,focusOnSelect:true,autoplaySpeed:5000,slickPause:true,pauseOnFocus:true,responsive:[{breakpoint:1230,settings:{slidesToShow:3}},{breakpoint:788,settings:{slidesToShow:2}},{breakpoint:590,settings:{slidesToShow:1}}]});$(window).load(function(){if($('#masonry-grid').length){var container=document.querySelector('#masonry-grid');var gutter=0;var msnry=new Masonry(container,{columnWidth:'.menu-item-type-custom',gutter:gutter,itemSelector:'.menu-item-type-custom'});}});$('.checkbox .text').on("click",function(){var p=$(this).parents('.checkbox');p.toggleClass('active');p.next('p').find('input').slideToggle();});$('.form .l2').click(function(){var p=$(this).parent('.form');p.find('.wrap').slideToggle();if(p.hasClass('active')){p.removeClass('active');}else{p.addClass('active');}});$('.search').click(function(){$('.searchform, .wrapbg').addClass('active');$('.searchform input[type="search"]').focus();});$('.searchform .close, .wrapbg').click(function(){$('.searchform, .wrapbg').removeClass('active');$('.leaderspage .modal').slideUp();});$('nav .menu > li > a, nav .menu .menu-item-has-children .menu-item-has-children > a, footer ul .menu-item-type-custom > a').click(function(e){e.preventDefault();});if($(window).width()<1020){$('nav li.menu-item-has-children').children('a').click(function(e){e.preventDefault();});}
$('.butmenu').click(function(){$('.menu').toggleClass('active');$(this).toggleClass('active');});$('.cats').each(function(){if($(this).find('li').length>1){$(this).find('li:first').hide();}});$('img.alignnone').each(function(){if($(this).parent()=='p'){$(this).unwrap();}});var lightbox=$('.photos .item a').simpleLightbox({'captions':false,});$('.social .icon').click(function(){$('.social .list').slideToggle();});$('.leaderspage .but.dov').click(function(){var p=$(this).parents('.leader');p.find('.modal.dov').slideToggle();$('.wrapbg').addClass('active');});$('.leaderspage .but.nap').click(function(){var p=$(this).parents('.leader');p.find('.modal.nap').slideToggle();$('.wrapbg').addClass('active');});$('.radio .first').addClass('active');$('.radio .wpcf7-list-item').click(function(){$('.radio .wpcf7-list-item').removeClass('active');$(this).addClass('active');$(this).find('input').prop('checked',true);});$('.pay').click(function(){$(this).hide();});$("table").wrap("<div class='table'></div>");$('.d-pages .list a').addClass('l3');});