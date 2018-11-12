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
				buttonCoords[0] = new Array(487,219);
				buttonCoords[1] = new Array(387,273);
				buttonCoords[2] = new Array(540,331);
				buttonCoords[3] = new Array(556,171);
			var qParams1Messages = new Array(
				'Warsaw is the capital of Poland.',
				'Warsaw is located on the Vistula River.',
				'Before WW II, Warsaw was the largest Jewish community in Europe, with over 350,000 Jews, 1/3 of the city’s total population. During the war, 80% of Warsaw was destroyed.  After the war it was rebuilt and is a thriving city once again.<br><br><a class="next-question" href="'+$legacyURL+'?name=esther&question=3">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Find <em>Warsaw<\/em>, the city where the Shalpins moved in order to get the paperwork and permission needed for immigration to Palestine.',
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
