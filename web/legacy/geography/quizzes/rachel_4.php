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
				buttonCoords[0] = new Array(160,243);
				buttonCoords[1] = new Array(85,227);
				buttonCoords[2] = new Array(183,214);
				buttonCoords[3] = new Array(459,317);
			var qParams1Messages = new Array(
				'Krakow is in Poland.',
				'Krakow is in south central Poland.',
				'Before the war, Krakow was an exciting cosmopolitan city which was home to between to some 70,000 Jews.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 4:',
				mqQuestion:'Find <em>Krakow<\/em>, the city where Rachel and her sisters stayed after returning to Poland.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqTryAgain: 'Try again.',
				mqRightMessage: 'Good job.',
				mqMessages: qParams1Messages,
				mqThankYouMessage:'Thank you for participating!',					
				mqBackgroundA: 'geography_western_asia_map.png',
				mqBackgroundB: 'geography_western_asia_map.png',
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
