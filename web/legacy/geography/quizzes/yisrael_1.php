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
				buttonCoords[0] = new Array(513,226);
				buttonCoords[1] = new Array(331,277);
				buttonCoords[2] = new Array(459,303);
				buttonCoords[3] = new Array(562,290);
			var qParams1Messages = new Array(
				'Gora Kalwaria is located in Poland.',
				'Gora Kalwaria is in central Poland. The closest big city to Gur is Warsaw, the capital of Poland.',
				'Poland had the largest population of Jews in Europe before the war.<br><br><a class="next-question" href="'+$legacyURL+'?name=yisrael&question=2">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Find <em>Gora Kalwaria (Gur)<\/em>, the area where Yisrael grew up.',
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
