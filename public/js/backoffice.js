$(document).ready(function(){
	 $(".button-collapse").sideNav();

	 $('#subnav').hide();

	 $('ul li.mainNav').click(function(){
	 	$current = $(this).prop('id');
	 	$currentClass = $(this).prop('class','mainNav '+$current);
	 	$(this).addClass('active');
	 	if($current !== $currentClass){
	 		$('#subnav').removeAttr('class');
	 	}
	 	$getActive = $('.active').length;
	 	if($getActive > 1){
	 		$('.active').removeClass('active');
	 		$(this).addClass('active');
	 	}
	 	if($current == 'customers'){
	 		$(this).removeClass('active');
	 		$(this).addClass('active_spec');
	 		$('#subnav').slideUp("fast");
	 	} else {
	 		$('.active_spec').removeClass('active_spec');
	 		$('#subnav').slideToggle("fast");
	 		$('#subnav').slideDown("fast");
	 		$('#subnav').toggleClass($current);
	 	}

	 	$menuList = ['pages', 'medias', 'design', 'products', 'orders', 'parameters'];
	 	$getSubmenu = $.inArray($current, $menuList);

	 	if($getSubmenu !== -1){
            setTimeout(function(){
                $('#subnav').load('menus/'+$current+'_submenu.html');
            }, 100);
	 	}

	 });
	 $('#user_settings').webuiPopover({url:'#user_submenu', placement: 'bottom'});

});
