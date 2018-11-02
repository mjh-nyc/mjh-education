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
				buttonCoords[0] = new Array(598,100);
				buttonCoords[1] = new Array(515,192);
				buttonCoords[2] = new Array(547,253);
				buttonCoords[3] = new Array(581,129);
			var qParams1Messages = new Array(
				'Berlin is in north eastern Germany.',
				'Berlin is not far from the border with Poland.',
				'After WWII, the city was divided into West Berlin (controlled by the US, UK, and France) and East Berlin (formed by the Soviet Union). The city remained divided until November 1989. Germany was officially reunified in 1990.<br><br><a class="next-question" href="'+$legacyURL+'?name=albert&question=2">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Find <em>Berlin<\/em>, the capital of Germany.',
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
