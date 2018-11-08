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
				buttonCoords[0] = new Array(55,303);
				buttonCoords[1] = new Array(121,328);
				buttonCoords[2] = new Array(480,200);
				buttonCoords[3] = new Array(518,87);
			var qParams1Messages = new Array(
				'Havana is located on Cuba’s largest island.',
				'Havana is on the narrow part of Cuba’s most populous island.',
				'Many Jews who were escaping Nazi occupied Europe stayed in Cuba for a short period before they were given visas, to enter the US.<br><br><a class="next-question" href="'+$legacyURL+'?name=albert&question=3">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Find <em>Havana<\/em>, the capital of Cuba.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqTryAgain: 'Try again.',
				mqRightMessage: 'Good job.',
				mqMessages: qParams1Messages,
				mqThankYouMessage:'Thank you for participating!',					
				mqBackgroundA: 'geography_us_map.png',
				mqBackgroundB: 'geography_us_map.png',
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
