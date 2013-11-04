	<script>
        bind_chosen();
        $('select.report-date').change(function () {
            $('.present_households').html('');
		    $('select[name="households_absent"]').html('');
		    $('#report dd').text('');

            update_report();
        });
        function bind_chosen() {
            $('select[multiple="multiple"]').chosen();
            $('select[name="households_absent"]')
                .chosen({max_selected_options: 0})
                .change(function() {
                    var
                        $choices = $('.chosen-choices'),
                        name = $choices.find('.search-choice span').text().trim(),
                        $selected_option = $('select[name="households_absent"] ' +
                            'option:contains("' + name + '")'),
                        hid = $selected_option.attr('value');

                    $('<li>').html(
                        $('<a>')
                            .attr('href', '../household/' + hid)
                            .text(name))
                        .prependTo('.present_households');

                    var month = $('select[name="month"] option:selected').val();
                    var year = $('select[name="year"] option:selected').val();
                    $.post(
                        '../ajax/serve_household',
                        {
                            'household_id': hid,
                            'month': month,
                            'year': year
                        },
                        function (success) {
                            if (success) {
                                $('.chosen-choices li.search-choice').remove();
                                $choices.trigger('chosen:updated');
                            }
                            else {
                                alert('There was an error.');
                            }
                        }
                    );
                    update_report(true);
                });
        }
        function add_absent_households(households) {
            for (var i = 0; i < households.length; i++) {
                var household = households[i];

                $('<option>')
                    .attr('value', household.household_id)
                    .text(household.first_name + ' ' + household.last_name)
                        .appendTo('select[name="households_absent"]');
                $('select[name="households_absent"]')
                    .trigger('chosen:updated');
            }
        }
        function add_households(households) {
            for (var i = 0; i < households.length; i++) {
                var household = households[i];

                $('<li>').html(
                    $('<a>')
                        .attr('href', '../household/' + household.household_id)
                        .text(household.first_name + ' ' + household.last_name))
                    .appendTo('.present_households');
            }
        }
        function update_report(report_only) {
            if (0 === arguments.length) {
                report_only = false;
            }
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
                        var data = $.parseJSON(response);
                        if (!report_only) {
                            add_absent_households(data.absent_households);
                            add_households(data.present_households);
                        }
                        populate_report_data(data);
                    }
                    else {
                        alert('There was an error.');
                    }
                }
            );
        }
        function populate_report_data(data) {
            $('#age-range1').text(data.ageRange1);
            $('#age-range2').text(data.ageRange2);
            $('#age-range3').text(data.ageRange3);
            $('#age-range4').text(data.ageRange4);
            $('#age-range5').text(data.ageRange5);
            $('#age-range6').text(data.ageRange6);
            $('#total-individuals').text(data.total_individuals);

            $('#males').text(data.male);
            $('#females').text(data.female);

            $('#new-individuals').text(data.new_individuals);
            $('#disabled').text(data.disabled);
            $('#veterans').text(data.veteran);
            $('#total-households').text(data.total_households);
            $('#new-households').text(data.new_households);
            $('#households-year-to-date').text(data.households_year_to_date);
        }
	</script>
	</body>
</html>
<!-- SDG -->
