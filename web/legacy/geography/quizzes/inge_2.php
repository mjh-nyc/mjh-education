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
				buttonCoords[0] = new Array(389,258);
				buttonCoords[1] = new Array(81,418);
				buttonCoords[2] = new Array(367,450);
				buttonCoords[3] = new Array(465,229);
			var qParams1Messages = new Array(
				'Czechoslovakia (which is now two countries, the Czech Republic and Slovakia) shares its western border with Germany.',
				'Inge and her family were transported across Germany, to north eastern Czechoslovakia.',
				'Terezin was a fortress and a walled town built by the Hapsburgs in the late 1700s.  The ghetto was established in the fortress and the town.<br><br><a class="next-question" href="'+$legacyURL+'?name=inge&question=3">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'In 1942, Inge and her parents were forced into the Terezin ghetto/camp in Czechoslovakia. Identify the location of the <em>Terezin ghetto<\/em>.',
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
