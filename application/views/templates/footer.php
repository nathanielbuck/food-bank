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
	</script>
	</body>
</html>
<!-- SDG -->
