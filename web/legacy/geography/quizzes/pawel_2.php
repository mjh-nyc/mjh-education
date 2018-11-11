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
				buttonCoords[0] = new Array(344,308);
				buttonCoords[1] = new Array(227,271);
				buttonCoords[2] = new Array(166,202);
				buttonCoords[3] = new Array(373,217);
			var qParams1Messages = new Array(
				'Dachau is located in southern Germany.',
				'Dachau is not far from Munich.',
				'Dachau was the first of the Nazi’s numerous concentration camps. It was established in March 1933.<br><br><a class="next-question" href="'+$legacyURL+'?name=pawel&question=3">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Locate <em>Dachau<\/em>, a concentration camp where Pawel was interned.',
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
