function openWin() {
    geoWindow = window.open("", "geoWindow", "width=670, height=470");   // Opens a new window
}

function closeWin() {
    geoWindow.close();   // Closes the new window
}

var MQS = {
	
	MQ_OBJECTS: [],	
	TRANSITION_SPEED: 200,	
		
	init: function(qC) {
		
		var i=1;
		var countLimit = (qC+1);
		while(i < countLimit) {
			$('#content').append('<div class=\"coa-quiz\" id=\"coa-quiz-'+i+'\"><div class=\"coa-quiz-heading\"></div><div class=\"coa-quiz-question\" id=\"quiz-top\"></div><div class=\"coa-quiz-graphics\"><div class=\"coa-quiz-bg-image-1\"></div><div class=\"coa-quiz-bg-image-2\"></div><div class=\"coa-quiz-options\"><div class=\"coa-quiz-correct\"></div></div><div class=\"coa-quiz-feedback\"><div class=\"coa-quiz-feedback-bg\"></div><div class=\"coa-quiz-feedback-text\"></div></div></div></div>');
			i++;
		};
	
	},
		
	mqObj: function(pObj) {
		this.mqID = pObj.mqID;
		this.objName = '#coa-quiz-' + this.mqID;
		qRef = $(this.objName);
		this.wrongAnswers = 0;
		this.quizDone = false;
		this.quizFailed = false;
		this.quizOptions = pObj.mqOptions;
		this.quizNextLink = pObj.mqNextLink;
		var qObj = this;
		
		this.bg1val = 'url(/legacy/images/quiz/'+pObj.mqBackgroundA+') 0 0 no-repeat';
		
		this.bg2val = 'url(/legacy/images/quiz/'+pObj.mqBackgroundB+') 0 0 no-repeat';

		//this.bg1val = 'url(/app/themes/mjh-edu/resources/assets/images/geography_europe_map.png) 0 0 no-repeat';
		//this.bg2val = 'url(/app/themes/mjh-edu/resources/assets/images/geography_europe_map.png) 0 0 no-repeat'; 
		
		var cssPositionString = pObj.mqMapTitleBgOffsetLeft + 'px ' + pObj.mqMapTitleBgOffsetTop + 'px';
		qRef.find('.coa-quiz-feedback').css('background-position',cssPositionString);
		
		qRef.find('.coa-quiz-bg-image-1').css('background',this.bg1val);
		qRef.find('.coa-quiz-bg-image-2').css('background',this.bg2val);

		qRef.find('.coa-quiz-correct').html(this.mqRightMessage);
		qRef.find('.coa-quiz-heading').html(pObj.mqHeading);
		
		qRef.find('.coa-quiz-question').html(pObj.mqQuestion);
		for (var i=0; i<pObj.mqOptions.length; i++) {
			var optionID = Number(i) + 1;
			qRef.find('.coa-quiz-options').append('<a href=\"#quiz-top\" class=\"option-'+optionID+'\" title=\"'+pObj.mqOptions[i]+'\">'+pObj.mqOptions[i]+'</a>');
		}
		var optionsEl = qRef.find('.coa-quiz-options').children();
		for (var i=0; i<pObj.mqOptions.length; i++) {
			var halfSmallIcon = 6;
			var halfBigIcon = 15;
			var aEl = '.coa-quiz-options a.option-'+ (Number(i) + 1);
			qRef.find(aEl).css('left', pObj.mqButtonCoords[i][0] - halfSmallIcon);
			qRef.find(aEl).css('top', pObj.mqButtonCoords[i][1] - halfSmallIcon);
			if ((Number(i) + 1) == pObj.mqRightAnswerID) {
				var coordsCorrectX = pObj.mqButtonCoords[i][0] - halfBigIcon;
				var coordsCorrectY = pObj.mqButtonCoords[i][1] - halfBigIcon;
				qRef.find('.coa-quiz-correct').css('left', coordsCorrectX);
				qRef.find('.coa-quiz-correct').css('top', coordsCorrectY);
			}
		}
		qRef.find('.coa-quiz-options a').click(function(){
				
			var topParent = $(this).parent().parent().parent();

			topParent.find('.coa-quiz-feedback').css('display', 'block');
			topParent.find('.coa-quiz-feedback-bg').css('display', 'block');

			var thisParentID = topParent.attr('id');
			var thisParentIDNo = thisParentID.substr(thisParentID.indexOf('coa-quiz-') + 9);
			var thisOptionID = $(this).attr('class');
			thisOptionID = thisOptionID.substr(thisOptionID.indexOf('option-')+7);
			var messageID = Number(thisOptionID-1);
			/*
			topParent.find('.coa-quiz-feedback').fadeIn(MQS.TRANSITION_SPEED);
			*/
			if (qObj.quizDone == false) {
				topParent.find('.coa-quiz-feedback-text').html(
					'<p>'+pObj.mqMessages[messageID]+'</p>'
				);
			}
			if (qObj.quizDone == true) {
				
				/* PASS: QUIZ ALREADY COMPLETED */
				topParent.find('.coa-quiz-bg-image-1').fadeOut();
				if (qObj.quizFailed == false) {
					topParent.find('.coa-quiz-feedback-text').html(
						'<p class=\"congratulations\">' + pObj.mqRightMessage + '</p>'
					);	
					topParent.find('.coa-quiz-feedback-text').append(
						'<p>'+pObj.mqMessages[2]+'</p>'
					);
					topParent.find('.coa-quiz-feedback-text').append(
						qObj.quizNextLink
					);
				}
				topParent.find('.coa-quiz-correct').fadeIn(MQS.TRANSITION_SPEED);
				return false;	
				
			} else {
			
				if (pObj.mqRightAnswerID == thisOptionID) {
		
					/* PASS: CORRECT ANSWER */
					
					topParent.find('.coa-quiz-bg-image-1').fadeOut();
					topParent.find('.coa-quiz-feedback-text').html('<p class=\"congratulations\">'+pObj.mqRightMessage+'</p>');
					topParent.find('.coa-quiz-feedback-text').append(
						'<p>'+pObj.mqMessages[2]+'</p>'
					);
					topParent.find('.coa-quiz-feedback-text').append(
						qObj.quizNextLink
					);
					var qid = $("#the_question_id").attr('val');
					
					var data = {
						action: 'complete_quiz_question',
						page_id: $("#the_story_id").attr('val'),
						question_id: qid
					};
							
					//$.post( ajaxurl, data, function( response ) {
						qObj.quizDone = true;
						//MQS.markDone( qid, response, topParent );
						topParent.find('.coa-quiz-correct').fadeIn(MQS.TRANSITION_SPEED);
						MQS.deactivateButtons(thisParentIDNo);
						//return false;
					//});
					
				} else {
				
					/* WRONG ANSWER */
					$(this).addClass('option-selected');
					
					qObj.wrongAnswers++;
					if (qObj.wrongAnswers == 1) {
						topParent.find('.coa-quiz-feedback-text').html('<p class=\"congratulations\">'+pObj.mqTryAgain+'</p>');
						topParent.find('.coa-quiz-feedback-text').append(
							'<p>'+pObj.mqMessages[0]+'</p>'
						);
					} else if (qObj.wrongAnswers == 2) {
						topParent.find('.coa-quiz-feedback-text').html('<p class=\"congratulations\">'+pObj.mqTryAgain+'</p>');
						topParent.find('.coa-quiz-feedback-text').append(
							'<p>'+pObj.mqMessages[1]+'</p>'
						);
					} else {
						var qid = $("#the_question_id").attr('val');
					
						var data = {
							action: 'complete_quiz_question',
							page_id: $("#the_story_id").attr('val'),
							question_id: qid
						};
							
						qObj.quizFailed = true;
						qObj.quizDone = true;
						
						
						topParent.find('.coa-quiz-bg-image-1').fadeOut();
						topParent.find('.coa-quiz-feedback-text').html(
							'<p>'+pObj.mqMessages[2]+'</p>'
						);
						
						//MQS.markDone( qid, response, topParent );

						topParent.find('.coa-quiz-feedback-text').append(
							qObj.quizNextLink
						);
						topParent.find('.coa-quiz-correct').fadeIn(MQS.TRANSITION_SPEED);
						MQS.deactivateButtons(thisParentIDNo);
						
					}
					return false;	
					
				}
			}	
		});
	
	},	
	
	markDone: function( qid, response, topParent ) {
		response = $.parseJSON( response );
		
		var geoqid = '#geoq-' + qid;
		var alreadyid = geoqid + ' span.completed-icon';
		if ( response['checkme'] == 'yes' && $(alreadyid).length == 0 ) {
			var comp = '<span class="completed-icon"></span>';
			$(geoqid).append(comp);
		}
		
		// Quiz is complete. Show Completed link
		if(response['clink'] != '') { 
			if ( $('#quiz-complete').length == 0 ) {
				$( '#geolinks' ).append( response['cicon'] );
			}
			
			topParent.find( '.coa-quiz-feedback-text' ).append( response['clink'] );
		} else {
			topParent.find( '.coa-quiz-feedback-text' ).append( response['nlink'] );
		}
	
		if ( $('#is_answered').attr('val') != '1' ) {
			$('#geo-checkmarks li:last-child').remove();
			var newcheck = '<li class="completed">Completed</li>';
		}
		
		$('#geo-checkmarks').prepend(newcheck);
	},
	
	makeMQ: function(qP) {
		for(var i=0; i<arguments.length; i++) {
			var thisParamObj = arguments[i];
			MQS.MQ_OBJECTS.push(new MQS.mqObj(thisParamObj));
		}
	},
	
	deactivateButtons: function(qID) {

		var theID = (Number(qID)-1);
		var theObject = MQS.MQ_OBJECTS[theID];
		var objName = '#coa-quiz-' + qID;
		var qRef = $(objName);

		for (var i=0; i<theObject.quizOptions.length; i++) {
			var aEl = '.coa-quiz-options a.option-'+ (Number(i) + 1);
			if (qRef.find(aEl).hasClass('option-selected')) {
				qRef.find(aEl).removeClass('option-selected');
			}
			qRef.find(aEl).addClass('option-deactivated');
			
			qRef.find(aEl).css('cursor','default');
		}
	
	}
};

