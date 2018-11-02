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
				buttonCoords[0] = new Array(364,276);
				buttonCoords[1] = new Array(404,303);
				buttonCoords[2] = new Array(541,232);
				buttonCoords[3] = new Array(372,184);
			var qParams1Messages = new Array(
				'Try again. Muehldorf located in southern Germany.',
				'Try again. Muehldorf is not far from the German/Austrian border.',
				'Dachau was the first of the Nazi’s numerous concentration camps. It was established in March 1933.'
			);
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 4:',
				mqQuestion:'Locate <em>Muehldorf<\/em>, a sub-camp of Dachau, where Elli and her mother saw Armin again.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqRightMessage: 'Good job.',
				mqMessages: qParams1Messages,
				mqThankYouMessage:'Thank you for participating!',					mqBackgroundA: 'elli-base-map.png',
				mqBackgroundB: 'elli-base-map.png',
				mqButtonCoords: buttonCoords,
				mqMapTitleBgOffsetTop: '0',
				mqMapTitleBgOffsetLeft: '-350'
			};
			MQS.makeMQ(qParams1);
		
		});
	});	
	
});
</script>
