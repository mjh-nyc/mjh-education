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
				buttonCoords[0] = new Array(381,183);
				buttonCoords[1] = new Array(472,230);
				buttonCoords[2] = new Array(533,164);
				buttonCoords[3] = new Array(529,294);
			var qParams1Messages = new Array(
				'Try again. When Elli left Nagymagyar (close to her hometown of Samorin), she traveled northeast.',
				'Try again. Auschwitz (Oswiecim in Polish) is located in the south of Poland.',
				'In Auschwitz-Birkenau, 1.3 million people were killed, 90% of whom were Jews.<br><br><a class="next-question" href="'+$legacyURL+'?name=aza&question=3">Next question</a>'
			);
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 2:',
				mqQuestion:'Locate <em>Auschwitz<\/em>,  the camp where Elli and her family were sent after the ghetto in Nagymagyar was liquidated.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 2,
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
