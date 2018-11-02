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
				buttonCoords[0] = new Array(227,285);
				buttonCoords[1] = new Array(117,421);
				buttonCoords[2] = new Array(320,375);
				buttonCoords[3] = new Array(336,254);
			var qParams1Messages = new Array(
				'Paris is in northern France.',
				'France borders Spain, Belgium, Luxembourg, Switzerland, and Italy.',
				'From 1940 - 1942, France was divided in two.  The Occupied Zone in the north and west of France, was controlled by the Nazis.  The Free Zone in the south was run by Vichy France, a regime which collaborated with Nazi Germany, until it was occupied by Germany and Italy, in November 1942.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Identify <em>Paris<\/em>, the capital of France near where Yvonne and Renée spent their early years.',
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
