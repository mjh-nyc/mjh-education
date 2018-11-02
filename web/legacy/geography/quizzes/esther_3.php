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
				buttonCoords[0] = new Array(563,161);
				buttonCoords[1] = new Array(332,241);
				buttonCoords[2] = new Array(507,223);
				buttonCoords[3] = new Array(599,263);
			var qParams1Messages = new Array(
				'During the war Vilna (Vilnius) passed between Soviet, Lithuanian, and German hands.',
				'Vilna is now the capital of Lithuania.',
				'During the war about 90% of the Jewish population was murdered by the Nazis and Lithuanian collaborators who helped Nazis decimate the Jewish population.'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 3:',
				mqQuestion:'Find the location of the <em>Vilna ghetto<\/em> where Esther and her family were forced to live.',
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
