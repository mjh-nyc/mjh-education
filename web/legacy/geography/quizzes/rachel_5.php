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
				buttonCoords[0] = new Array(61,301);
				buttonCoords[1] = new Array(37,260);
				buttonCoords[2] = new Array(166,228);
				buttonCoords[3] = new Array(258,262);
			var qParams1Messages = new Array(
				'Marseilles is in southern France.',
				'Marseilles is on the Mediterranean Sea.',
				'Marseilles is the third largest city in France. Much of the city was rebuilt after the war because it was bombed by both the Allied and Axis powers.<br><br><a class="next-question" href="'+$legacyURL+'?name=rachel&question=done">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 5:',
				mqQuestion:'Locate <em>Marseilles<\/em>, France where Rachel and her sisters boarded the “Exodus.”',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqTryAgain: 'Try again.',
				mqRightMessage: 'Good job.',
				mqMessages: qParams1Messages,
				mqThankYouMessage:'Thank you for participating!',					
				mqBackgroundA: 'geography_western_asia_map.png',
				mqBackgroundB: 'geography_western_asia_map.png',
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
