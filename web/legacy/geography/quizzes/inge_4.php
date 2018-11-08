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
				buttonCoords[0] = new Array(350,247);
				buttonCoords[1] = new Array(248,241);
				buttonCoords[2] = new Array(306,211);
				buttonCoords[3] = new Array(451,232);
			var qParams1Messages = new Array(
				'When she was transported to Oederan, Inge had to cross the Polish border to back into Germany.',
				'Oederan is located in eastern Germany near Leipzig.',
				'Inge was forced to labor in a munitions factory in Oederan.  Oederan was a factory and railroad town beginning in the 1800s.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 4:',
				mqQuestion:'Inge was moved from Auschwitz to the <em> Oederan labor camp</em> .  Locate this camp on the map.',
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
