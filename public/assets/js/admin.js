$( function() {
	$( ".datepicker" ).each(function(index, datepicker) {
		var name = $(datepicker).attr('name');
		var fid = fname = name + '_picker';

		$(datepicker).before($(datepicker).clone().attr('id', fid).attr('name', fname));

		$('#' + fid).datepicker({
			altFormat: 'yy-mm-dd',
			altField: $(datepicker)
		});

		$('#' + fid).datepicker('setDate', 	$.datepicker.parseDate( "yy-mm-dd", $(datepicker).val() ) );

		$(datepicker).attr('type', 'hidden');

	});
} );