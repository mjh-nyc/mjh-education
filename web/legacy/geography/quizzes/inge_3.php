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
				buttonCoords[0] = new Array(475,259);
				buttonCoords[1] = new Array(381,212);
				buttonCoords[2] = new Array(530,327);
				buttonCoords[3] = new Array(532,195);
			var qParams1Messages = new Array(
				'Auschwitz is located in Poland.  The major to city closest to Auschwitz is Krakow.',
				'Auschwitz is in south central Poland.',
				'In Auschwitz-Birkenau, 1.3 million people were killed, 90% of whom were Jews.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Inge was transported by cattle car from Terezin to Auschwitz. Identify the location of <em>Auschwitz</em> (Oswiecim in Polish).',
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
