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
				buttonCoords[0] = new Array(330,220);
				buttonCoords[1] = new Array(485,230);
				buttonCoords[2] = new Array(542,169);
				buttonCoords[3] = new Array(600,197);
			var qParams1Messages = new Array(
				'Plaszow is in Poland, near Krakow.',
				'Plaszow can be found in southern Poland.',
				'The Plaszow labor camp was built on the site of two Jewish cemeteries in a suburb of Krakow.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Locate <em>Plaszow<\/em>, the labor camp where Elli and her mother were forced to work in the summer of 1944.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 2,
				mqTryAgain: 'Try again.',
				mqRightMessage: 'Good job.',
				mqMessages: qParams1Messages,
				mqThankYouMessage:'Thank you for participating!',					mqBackgroundA: 'geography_europe_map.png',
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
