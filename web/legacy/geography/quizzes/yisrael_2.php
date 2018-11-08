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
				buttonCoords[0] = new Array(463,295);
				buttonCoords[1] = new Array(182,345);
				buttonCoords[2] = new Array(384,334);
				buttonCoords[3] = new Array(520,229);
			var qParams1Messages = new Array(
				'Novaky was located in Czechoslovakia (and is now two countries - the Czech Republic and Slovakia).',
				'Novaky is located in what is now called Slovakia.',
				'After leaving the Novaky labor camp, Yisrael went through Romania, Hungary, Austria, Italy, and was sent to a detention camp on the island of Cyprus, before settling in the country that is now Israel.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Locate <em>Novaky<\/em>, the labor camp where Yisrael was taken when he was discovered by the Hungarian guard.',
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
