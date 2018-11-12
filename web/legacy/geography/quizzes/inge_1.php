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
				buttonCoords[0] = new Array(313,233);
				buttonCoords[1] = new Array(209,342);
				buttonCoords[2] = new Array(454,236);
				buttonCoords[3] = new Array(381,212);
			var qParams1Messages = new Array(
				'Kassel is located near the center of Germany, in the state of Hesse.',
				'Inge had to move west of the Rhine to when she and her family relocated to Cologne.',
				'Approximately 90% of Kassel was destroyed by bombing during the war.<br><br><a class="next-question" href="'+$legacyURL+'?name=inge&question=2">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Identify <em>Kassel<\/em>, the town where Inge was born.',
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
