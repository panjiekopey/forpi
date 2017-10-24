/**
 * Scripts for Admin Panel
 */

$(document).ready(function() {
	console.log("Admin Panel");

	// Sortable
	var el = $('.sortable');
	for (var i=0; i<el.length; i++) {
		var sortable = Sortable.create(el[i]);
	}

	// Spectrum color picker
	$(".colorpicker").spectrum({
		// options here
	});

	// Active/Inactive Karyawan
	$(".navigation_active").live('click', function(){
		var str = $(this).html();
		var $this = $(this);
		$.ajax({
			url: $(this).attr('target'),
			dataType: 'json',
			success: function(response){
				if(str == 'Active'){
					str = 'Inactive';
				}else{
					str = 'Active';
				}
				if(response.success){
					$this.html(str);
				}
			}
		});
	});
});
