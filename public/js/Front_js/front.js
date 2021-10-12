//Bootsshop-----------------------//
$(document).ready(function(){
	/* carousel of home page animation */
	$('#myCarousel').carousel({
	  interval: 4000
	})
	 $('#featured').carousel({
	  interval: 4000
	})
	$(function() {
		$('#gallery a').lightBox();
	});
	$('#hover_top_menu').click(function()
	{
$('#hover_top_menu-1').css('background-color', 'green');	
});


	
	$('.subMenu > a').click(function(e)
	{
		e.preventDefault();
		var subMenu = $(this).siblings('ul');
		var li = $(this).parents('li');
		var subMenus = $('#sidebar li.subMenu ul');
		var subMenus_parents = $('#sidebar li.subMenu');
		if(li.hasClass('open'))
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				subMenu.slideUp();
			} else {
				subMenu.fadeOut(250);
			}
			li.removeClass('open');
		} else 
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				subMenus.slideUp();			
				subMenu.slideDown();
			} else {
				subMenus.fadeOut(250);			
				subMenu.fadeIn(250);
			}
			subMenus_parents.removeClass('open');		
			li.addClass('open');	
		}
	});
	var ul = $('#sidebar > ul');
	$('#sidebar > a').click(function(e)
	{
		e.preventDefault();
		var sidebar = $('#sidebar');
		if(sidebar.hasClass('open'))
		{
			sidebar.removeClass('open');
			ul.slideUp(250);
		} else 
		{
			sidebar.addClass('open');
			ul.slideDown(250);
		}
	});

		$('.topmenu > a').click(function(e)
	{
		e.preventDefault();
		var TopsubMenu = $(this).siblings('ul');
		var Tli = $(this).parents('li');
		var TopsubMenus = $('#topsidebar li.topmenu ul');
		var TopsubMenus_parents = $('#topsidebar li.topmenu');
		if(Tli.hasClass('open'))
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				TopsubMenu.slideUp();
			} else {
				TopsubMenu.fadeOut(250);
			}
			Tli.removeClass('open');
		} else 
		{
			if(($(window).width() > 768) || ($(window).width() < 479)) {
				TopsubMenus.slideUp();			
				TopsubMenu.slideDown();
			} else {
				TopsubMenus.fadeOut(250);			
				TopsubMenu.fadeIn(250);
			}
			TopsubMenus_parents.removeClass('open');		
			Tli.addClass('open');	
		}
	});



		var tul = $('#topsidebar > ul');
	$('#topsidebar > a').click(function(e)
	{
		e.preventDefault();
		var topsidebar = $('#topsidebar');
		if(topsidebar.hasClass('open'))
		{
			topsidebar.removeClass('open');
			tul.slideUp(250);
		} else 
		{
			topsidebar.addClass('open');
			tul.slideDown(250);
		}
	});

});
