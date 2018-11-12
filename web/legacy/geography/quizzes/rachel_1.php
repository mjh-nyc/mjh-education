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
				buttonCoords[0] = new Array(168,240);
				buttonCoords[1] = new Array(43,281);
				buttonCoords[2] = new Array(80,236);
				buttonCoords[3] = new Array(310,195);
			var qParams1Messages = new Array(
				'Limanowa can be found in Poland.',
				'Limanowa is in south central Poland, not far from Krakow.',
				'The Nazis established a ghetto in Limanowa where half of the Jewish population of the town was murdered.<br><br><a class="next-question" href="'+$legacyURL+'?name=rachel&question=2">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Find Rachel\'s hometown, <em>Limanowa<\/em>.',
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
