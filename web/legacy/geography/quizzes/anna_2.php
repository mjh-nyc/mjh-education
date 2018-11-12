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
				buttonCoords[0] = new Array(380,455);
				buttonCoords[1] = new Array(145,465);
				buttonCoords[2] = new Array(204,406);
				buttonCoords[3] = new Array(328,398);
			var qParams1Messages = new Array(
				'Unlike Rome, Alvito is not on the coast.',
				'When Anna’s family left Rome, they traveled east and slightly to the south.',
				'Four battles were fought in Monte Cassino during the war. During these battles Allied bombs destroyed the monastery in that town which was nearly 1,500 years old.<br><br><a class="next-question" href="'+$legacyURL+'?name=anna&question=3">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Locate <em>Alvito<\/em>, near the mountain village of Monte Cassino where Anna and her family hid from the Nazis.',
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
