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
				buttonCoords[0] = new Array(310,267);
				buttonCoords[1] = new Array(300,337);
				buttonCoords[2] = new Array(239,283);
				buttonCoords[3] = new Array(418,194);
			var qParams1Messages = new Array(
				'Heidelberg is a city in Germany.',
				'The closest neighboring country to the city of Heidelberg, is France.',
				'Prior to and during the Nazi era, the citizens of Heidelberg were strong supporters of the Nazi political party.<br><br><a class="next-question" href="'+$legacyURL+'?name=pawel&question=done">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 4:',
				mqQuestion:'Locate <em>Heidelberg<\/em>, the city where Pawel met his cousin Roma and attended school.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqRightMessage: 'Good job.',
				mqTryAgain: 'Try again.',
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
