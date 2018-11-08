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
				buttonCoords[0] = new Array(8,240);
				buttonCoords[1] = new Array(-7,245);
				buttonCoords[2] = new Array(43,242);
				buttonCoords[3] = new Array(73,208);
			var qParams1Messages = new Array(
				'Mississippi shares its western border with Louisiana and Arkansas.',
				'Vicksburg located on the Mississippi river.',
				'550,000 American Jews served in the US military during the war.<br><br><a class="next-question" href="'+$legacyURL+'?name=albert&question=4">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Click on <em>Vicksburg, Mississippi<\/em>, the US city where Albert and his siblings reunited with their parents.',
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
