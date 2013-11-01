	<script>
		$('select[multiple="multiple"]').chosen();
		$('select[name="households_absent"]')
		    .chosen({max_selected_options: 0})
		    .change(function() {
                var that = this;
		        var $select = $(that);
	            var $option = $select.find('option[value="' + that.value + '"]');
	            var name = $option.text();

                $('<li>').html(
                    $('<a>')
                        .attr('href', '../household/' + that.value)
                        .text(name))
                    .prependTo('.present_households');

	            var month = $('select[name="month"] option:selected').val();
	            var year = $('select[name="year"] option:selected').val();
	            $.post(
	                '../ajax/serve_household',
	                {
                        'household_id': that.value,
	                    'month': month,
                        'year': year
	                },
                    function (success) {
                        if (success) {
                            $option.remove();
                            $select.trigger('chosen:updated');
                        }
                        else {
                            alert('There was an error.');
                        }
                    }
                );
		    });
        $('select.report-date').change(function () {
            $('.present_households').html('');
		    $('select[name="households_absent"]').html('');

	        var month = $('select[name="month"] option:selected').val();
	        var year = $('select[name="year"] option:selected').val();

	        $.post(
	            '../ajax/get_report',
	            {
	                'month': month,
                    'year': year
	            },
                function (response) {
                    if (response) {
                        var json = $.parseJSON(response);
                        add_absent_households(json.absent_households);
                        prepend_households(json.present_households);
                    }
                    else {
                        alert('There was an error.');
                    }
                }
            );
        });
        function add_absent_households(households) {
            for (var i = 0; i < households.length; i++) {
                var household = households[i];

                $('<option>')
                    .attr('val', household.household_id)
                    .text(household.first_name + ' ' + household.last_name)
                        .appendTo('select[name="households_absent"]');
                $('select[name="households_absent"]')
                    .trigger('chosen:updated');
            }
        }
        function prepend_households(households) {
            for (var i = 0; i < households.length; i++) {
                var household = households[i];

                $('<li>').html(
                    $('<a>')
                        .attr('href', '../household/' + household.household_id)
                        .text(household.first_name + ' ' + household.last_name))
                    .prependTo('.present_households');
            }
        }
	</script>
	</body>
</html>
<!-- SDG -->
