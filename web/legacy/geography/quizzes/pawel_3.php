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
				buttonCoords[0] = new Array(352,309);
				buttonCoords[1] = new Array(321,221);
				buttonCoords[2] = new Array(177,331);
				buttonCoords[3] = new Array(539,255);
			var qParams1Messages = new Array(
				'The municipality of Feldafing is located in southern Germany.',
				'Feldafing is not far from Munich and Dachau.',
				'Many survivors stayed in Displaced Persons camps for years after the war before they were able to find countries that would allow them to immigrate.<br><br><a class="next-question" href="'+$legacyURL+'?name=pawel&question=4">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Find <em>Feldafing<\/em>, the Displaced Persons camp where Pawel stayed after the war.',
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