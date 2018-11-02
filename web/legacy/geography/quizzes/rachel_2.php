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
				buttonCoords[0] = new Array(395,175);
				buttonCoords[1] = new Array(41,282);
				buttonCoords[2] = new Array(171,235);
				buttonCoords[3] = new Array(205,287);
			var qParams1Messages = new Array(
				'Siberia is in Russia.',
				'Siberia is a large region in what is now the Russian Federation which covers over ¾ of the country.',
				'Siberia has long been a place where Russia exiled people.  Jews were first sent to Siberia in the 1600’s during the Russo-Polish War.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Find <em>Siberia<\/em>, the region where the Dershowitz family was taken by Soviet soldiers.',
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
