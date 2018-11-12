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
				buttonCoords[0] = new Array(356,277);
				buttonCoords[1] = new Array(378,202);
				buttonCoords[2] = new Array(453,292);
				buttonCoords[3] = new Array(529,266);
			var qParams1Messages = new Array(
				'Regensburg was located not far from the border with Czechoslovakia.',
				'Regensburg is not close to any sea or ocean.',
				'After liberation, the Jewish population in Europe was a fraction of what it had been before the war.<br><br><a class="next-question" href="'+$legacyURL+'?name=moshe&question=4">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Locate <em>Regensburg, Germany<\/em>, where Moshe and his brother went after they were liberated by the Allies.',
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
