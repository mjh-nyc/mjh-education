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
				buttonCoords[0] = new Array(543,268);
				buttonCoords[1] = new Array(353,244);
				buttonCoords[2] = new Array(463,222);
				buttonCoords[3] = new Array(524,364);
			var qParams1Messages = new Array(
				'Lvov was in Poland before WW II, today it is in the Ukraine.',
				'Lvov was in south eastern Poland.',
				'During the war, Lvov was passed back and forth between the German and Soviet armies.  Many of the Jews in Lvov spoke Yiddish, Polish, and German and had to learn Russian in order to get by.<br><br><a class="next-question" href="'+$legacyURL+'?name=marek&question=2">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Find <em>Lvov<\/em>, the city where Marek grew up.',
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
