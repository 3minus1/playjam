
$(document).ready(function(){

	var tag_object_array = [];
	$('.tags').children('p').each(function(){
		var new_tag_object = {};
		new_tag_object['tag'] = $(this).html();
		tag_object_array.push(new_tag_object); 
	});

	$('.chips-initial').material_chip({
  		data: tag_object_array
 	 });
	
	tag_object_array.forEach(function(item,index){
		$('#create-playlist-form').append('<input type="hidden" name="tags[]" value="'+item.tag+'">');
	});

	$('.chips-placeholder').material_chip({
	    placeholder: 'Enter tags',
	    secondaryPlaceholder: 'Enter tags',
	});

	$('.chips').on('chip.add', function(e, chip){
   		 $('#create-playlist-form').append('<input type="hidden" name="tags[]" value="'+chip.tag+'">');
 	});

	$('.chips').on('chip.delete', function(e, chip){
	     var tag = chip.tag;
	     $('input[name="tags[]"]').each(function() {
	        if ($(this).val() === tag)
	            $(this).remove();
	     });
	});
});



	


	
