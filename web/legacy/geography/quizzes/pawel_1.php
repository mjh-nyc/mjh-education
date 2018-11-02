<script type="text/javascript">
$(document).ready(function(){

	MQS.init(1);

	$(document).ready(function() {
		$(MQS).ready(function() {

			var qParams1Questions = new Array(
				'Option 1',
				'Option 2',
				'Option 3',
				'Option 4' 
			);
			var buttonCoords = [];
				buttonCoords[0] = new Array(468,236);
				buttonCoords[1] = new Array(403,311);
				buttonCoords[2] = new Array(229,268);
				buttonCoords[3] = new Array(553,181);
			var qParams1Messages = new Array(
				'Lodz is located in Poland.',
				'Lodz is located in central Poland, home to the second largest population of Jews in Poland before the war.',
				'The Lodz ghetto was the second largest ghetto established by the Nazis.  People in the Lodz ghetto were forced to act as a massive slave labor force.  The economic value of the work they produced in the ghetto ensured that it was the last ghetto in Poland to be destroyed, in August 1944.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Locate <em>Lodz<\/em>, the city where Pawel grew up.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqRightMessage: 'Good job.',
				mqTryAgain: 'Try again.',
				mqMessages: qParams1Messages,
				mqThankYouMessage:'Thank you for participating!',					
				mqBackgroundA: 'geography_europe_map.png',
				mqBackgroundB: 'geography_europe_map.png',
				mqButtonCoords: buttonCoords,
				mqMapTitleBgOffsetTop: '0',
				mqMapTitleBgOffsetLeft: '-350',
				mqNextLink: qParamsNextLink
			};
			MQS.makeMQ(qParams1);
		
		});
	});	
	
});
</script>
