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
				buttonCoords[0] = new Array(445,282);
				buttonCoords[1] = new Array(215,253);
				buttonCoords[2] = new Array(342,258);
				buttonCoords[3] = new Array(511,229);
			var qParams1Messages = new Array(
				'Try again. In Elli\’s memoir, <em>I Have lived a Thousand Years<\/em>, she writes about how she used to swim in the Danube river as a child.',
				'Try again. Samorin is near the borders of both Hungary and Austria.',
				'Jews have lived in the region that was called Czechoslovakia (and is now two countries - the Czech Republic and Slovakia) for hundreds of years.  Before the war, there were over 350,000 Jews living there.<br><br><a class="next-question" href="'+$legacyURL+'?name=aza&question=2">Next question</a>'
			);
			var qParams1 = {
				mqID: 1,
				mqHeading: 'Question 1:',
				mqQuestion:'Locate <em>Samorin, Czechoslovakia<\/em>, where Elli grew up.',
				mqOptions: qParams1Questions,
				mqSuggestion: '',	
				mqRightAnswerID: 1,
				mqRightMessage: 'Good job.',
				mqMessages: qParams1Messages,
				mqThankYouMessage:'Thank you for participating!',					
				mqBackgroundA: 'elli-base-map.png',
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
