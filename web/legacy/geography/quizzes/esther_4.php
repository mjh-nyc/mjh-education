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
				buttonCoords[0] = new Array(543,71);
				buttonCoords[1] = new Array(326,231);
				buttonCoords[2] = new Array(524,139);
				buttonCoords[3] = new Array(528,210);
			var qParams1Messages = new Array(
				'At different times during the war, Estonia was controlled both by the Nazis and the Russians.',
				'Estonia is located south of Finland.',
				'Estonia remained in the Soviet Union at the end of the war, regaining its independence in 1991.<br><br><a class="next-question" href="'+$legacyURL+'?name=esther&question=5">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 4:',
				mqQuestion:'Locate <em>Estonia<\/em>, where Esther and her family worked in labor camps.',
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
