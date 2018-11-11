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
				buttonCoords[0] = new Array(482,347);
				buttonCoords[1] = new Array(121,416);
				buttonCoords[2] = new Array(172,237);
				buttonCoords[3] = new Array(311,196);
			var qParams1Messages = new Array(
				'Tashkent was located in one of the southern most areas of the Soviet territory.',
				'Tashkent is the capital of what is now Uzbekistan.',
				'Jews have a long history in Uzbekistan, going back over 1,500 years.<br><br><a class="next-question" href="'+$legacyURL+'?name=rachel&question=4">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Locate <em>Tashkent<\/em>, the city where Mr. Dershowitz worked on a Soviet collective farm.',
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
