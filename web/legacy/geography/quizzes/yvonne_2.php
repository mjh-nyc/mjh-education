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
				buttonCoords[0] = new Array(185,393);
				buttonCoords[1] = new Array(229,285);
				buttonCoords[2] = new Array(308,211);
				buttonCoords[3] = new Array(370,456);
			var qParams1Messages = new Array(
				'Toulouse is in southern France.',
				'Toulouse can be found at the midpoint between the Atlantic Ocean and the Mediterranean Sea.',
				'Jewish children were hidden in many different ways.  Some who could pass as “Aryans” pretended not to be Jewish.  Others were hidden in homes, attics, basements, farms, convents and other locations by people who were willing to put their lives at risk to protect them.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Pinpoint <em>Toulouse<\/em>, where Yvonne and Renée were hidden in the convent.',
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
