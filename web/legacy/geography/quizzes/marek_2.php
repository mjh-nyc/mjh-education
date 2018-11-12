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
				buttonCoords[0] = new Array(289,372);
				buttonCoords[1] = new Array(182,337);
				buttonCoords[2] = new Array(377,438);
				buttonCoords[3] = new Array(516,247);
			var qParams1Messages = new Array(
				'Turin, (or Turino in Italian) is located in Italy.',
				'Turin is located in the Piedmont region of Northern Italy.',
				'Turin was bombed by the Allies because the factories in the town produced planes, tanks and cars for the Axis countries.<br><br><a class="next-question" href="'+$legacyURL+'?name=marek&question=done">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Locate <em>Turin<\/em>, the city where Marek was able to return to school.',
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
