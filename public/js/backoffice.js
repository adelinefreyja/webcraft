function ucFirst(string) {
	return string.substring(0, 1).toUpperCase() + string.substring(1).toLowerCase();
};

$(document).ready(function(){
	 $(".button-collapse").sideNav();
	 $('.tooltipped').tooltip({delay: 10});
	 $('#subnav').hide();

	 $('ul li.mainNav').click(function(){
		var	$current = $(this).prop('id');
	 	var $currentClass = $(this).prop('class','mainNav '+$current);
	 	$(this).addClass('active');
	 	if($current !== $currentClass){
	 		$('#subnav').removeAttr('class');
	 	}

	 	var $getActive = $('.active').length;

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

	 	function getSubmenu($current) {

            var $menuList = ['pages', 'medias', 'design', 'products', 'orders', 'parameters'];
            var $getSubmenu = $.inArray($current, $menuList);

	 		if ($getSubmenu !== -1) {
            	return true;
        	} else {
        		return false;
        	}
	 	}

	 	var $currentItem = ucFirst($current);
		console.log($currentItem);

       	if (getSubmenu($current) && $currentItem) {

            $("li.submenu:not(" + $currentItem + ")").addClass('hide');
            $('li.submenu.' + $currentItem + '.hide').removeClass('hide');
        } else {
        	$('li.submenu').addClass('hide');
        }
	 });


    $('select').material_select();

	$('#user_settings').webuiPopover({url:'#user_submenu', placement: 'bottom'});
});
