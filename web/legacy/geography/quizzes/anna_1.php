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
				buttonCoords[0] = new Array(365,448);
				buttonCoords[1] = new Array(227,279);
				buttonCoords[2] = new Array(327,248);
				buttonCoords[3] = new Array(431,403);
			var qParams1Messages = new Array(
				'Rome is located near the coast of Italy.',
				'Rome is about halfway down the Italian “boot.”',
				'Rome is home to one of the oldest Jewish communities in the world.  Jews have been living in Rome since the era of the Roman Empire.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Locate <em>Rome<\/em>, where Anna grew up.',
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
