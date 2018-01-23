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
	 		$('#subnav').slideUp("slow");
	 	} else {
	 		$('.active_spec').removeClass('active_spec');
	 		$('#subnav').slideToggle("slow");
	 		$('#subnav').slideDown("slow");
	 		$('#subnav').toggleClass($current);
	 	}

	 	$menuList = ['pages', 'medias', 'design', 'products', 'orders', 'parameters'];
	 	$getSubmenu = $.inArray($current, $menuList);

	 	if($getSubmenu !== -1){
	 		$('#subnav').load('menus/'+$current+'_submenu.html');
	 	}

	 });

	$('#user_settings').click(function(e){
           $('#user_submenu').show({width:300,autoHide:false});
    });
})