(function($) {
$('form').submit(function(e){
	var thisForm = $(this);
	e.preventDefault();
	$(this).fadeOut(function(){
		$("#loading").fadeIn(function(){
			$.ajax({
				type: 'POST',
				url: thisForm.attr("action"),
				data: thisForm.serialize(),
				success: function(data){
					$("#loading").fadeOut(function(){
						$("#success").text(data).fadeIn();
					 });
				}
			});
		});
	});
});
$('.md-trigger').tipsy({gravity: 's'});
})(jQuery);

$(function(){
  $().ready(function() {
    $('#videobg').tubular({videoId: 'tDvBwPzJ7dY'}); // where idOfYourVideo is the YouTube ID.
  });
});
