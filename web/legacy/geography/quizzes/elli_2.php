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
				buttonCoords[0] = new Array(381,207);
				buttonCoords[1] = new Array(472,260);
				buttonCoords[2] = new Array(533,194);
				buttonCoords[3] = new Array(529,329);
			var qParams1Messages = new Array(
				'When Elli left Nagymagyar (close to her hometown of Samorin), she traveled northeast.',
				'Auschwitz (Oswiecim in Polish) is located in the south of Poland.',
				'In Auschwitz-Birkenau, 1.3 million people were killed, 90% of whom were Jews.<br><br><a class="next-question" href="'+$legacyURL+'?name=elli&question=3">Next question</a>'
			);
			var qParamsNextLink = '';
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Locate <em>Auschwitz<\/em>,  the camp where Elli and her family were sent after the ghetto in Nagymagyar was liquidated.',
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
