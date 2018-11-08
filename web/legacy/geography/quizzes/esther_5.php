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
				buttonCoords[0] = new Array(454,171);
				buttonCoords[1] = new Array(217,269);
				buttonCoords[2] = new Array(380,192);
				buttonCoords[3] = new Array(414,282);
			var qParams1Messages = new Array(
				'Stutthof is in Poland.',
				'Stutthof is in north central Poland close to the Baltic Sea.',
				'Stutthof was a large camp with locations throughout northern Poland.  It was the site of 60,000 deaths.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 5:',
				mqQuestion:'Find <em>Stutthof<\/em>, where Esther was transferred to a concentration camp.',
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
