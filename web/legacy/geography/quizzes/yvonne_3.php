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
				buttonCoords[0] = new Array(472,261);
				buttonCoords[1] = new Array(382,215);
				buttonCoords[2] = new Array(531,329);
				buttonCoords[3] = new Array(534,196);
			var qParams1Messages = new Array(
				'Auschwitz (Oswiecim in Polish) is located in Poland.',
				'Auschwitz is in south central Poland.',
				'In Auschwitz-Birkenau, 1.3 million people were killed, 90% of whom were Jews.<br><br><a class="next-question" href="'+$legacyURL+'?name=yvonne&question=4">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Find <em>Auschwitz<\/em>, a camp where both Mr. and Mrs. Ferstenfeld were both interned.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqTryAgain: 'Try again.',
				mqRightMessage: 'Good job.',
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
