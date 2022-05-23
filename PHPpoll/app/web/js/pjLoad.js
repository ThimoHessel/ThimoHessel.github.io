(function (window, undefined) {
	var d = window.document;
	JABB.Ajax.xhrFields = {
		withCredentials: true
	};
	function stivaPHPpoll(options) {
		if (!(this instanceof stivaPHPpoll)) {
			return new stivaPHPpoll(options);
		}
		this.options = {};
		this.poll_container = null;
		this.error_message = null;
		this.init(options);
		return this;
	}
	
	stivaPHPpoll.prototype = {
			
		bindResult: function()
		{
			var self = this,
				return_arr = JABB.Utils.getElementsByClass("phpboll-button-return", self.poll_container, "A");
			
			if(return_arr.length > 0)
			{
				JABB.Utils.addEvent(return_arr[0], "click", function (e) {
					if (e.preventDefault) {
						e.preventDefault();
					}
					self.loadAnswers();
				});
			}
		},
		bindPoll: function()
		{
			var self = this,
				vote_arr = JABB.Utils.getElementsByClass("phpboll-button-vote", self.poll_container, "BUTTON"),
				view_arr = JABB.Utils.getElementsByClass("phpboll-button-view", self.poll_container, "A"),
				arr = JABB.Utils.getElementsByClass("phppoll-vote-element", self.poll_container, "INPUT");
			
			if(vote_arr.length > 0){
				JABB.Utils.addEvent(vote_arr[0], "click", function (e) {
					if (e.preventDefault) {
						e.preventDefault();
					}
					var pair = [],
						post = null,
						choose = false;
					for (var i = 0, len = arr.length; i < len; i++) 
					{
						if(arr[i].checked)
						{
							pair.push("&" + arr[i].getAttribute("name") + "_" + arr[i].value + "=1");
							choose = true;
						}else{
							pair.push("&" + arr[i].getAttribute("name") + "_" + arr[i].value + "=0");
						}
					}
					
					if(choose == true)
					{
						self.error_message.style.display = 'none';
						post = pair.join("");
						JABB.Ajax.sendRequest(self.options.set_vote_url, function (req) {
							self.poll_container.innerHTML = req.responseText;
							self.bindResult();
						}, post);
					}else{
						self.error_message.style.display = 'block';
					}
				});
			}
			
			if(view_arr.length > 0){
				JABB.Utils.addEvent(view_arr[0], "click", function (e) {
					if (e.preventDefault) {
						e.preventDefault();
					}
					JABB.Ajax.sendRequest(self.options.load_result_url, function (req) {
						self.poll_container.innerHTML = req.responseText;
						self.bindResult();
					});
				});
			}
			
			if(arr.length > 0){
				for (var i = 0, len = arr.length; i < len; i++){
					var limit = parseInt(self.options.limit_answers, 10);
					JABB.Utils.addEvent(arr[i], "click", function (e) {
						var $this = this,
							checkedcount = 0;
						for (var j = 0, len = arr.length; j < len; j++) 
						{
							var label_id = arr[j].id,
								label = d.getElementById(label_id.replace("answer_", "phppoll_element_label_"));
							if(self.options.multiple_vote == 'T')
							{
								checkedcount+=(arr[j].checked)? 1 : 0;
								if (checkedcount > limit){
									$this.checked=false;
									self.error_message.style.display = 'none';
									self.limit_message.style.display = 'block';
								}else{
									self.limit_message.style.display = 'none';
								}
							}
							if(arr[j].checked){
								JABB.Utils.addClass(label, 'pjPollAnswerChecked');
							}else{
								JABB.Utils.removeClass(label, 'pjPollAnswerChecked');
							}
						}
					});
				}
				
			}
		},
		loadAnswers: function()
		{
			var self = this;
			JABB.Ajax.sendRequest(self.options.load_answer_url, function (req) {
				self.poll_container.innerHTML = req.responseText;
				self.error_message = d.getElementById(self.options.error_container_id);
				self.limit_message = d.getElementById(self.options.limitation_container_id);
				self.bindPoll();
			});
		},
		init: function (stivaObj) {
			var self = this;
			self.options = stivaObj;
			if(self.options.poll_status == 'T')
			{
				self.poll_container = d.getElementById(self.options.container_id);
				if(self.options.stop_poll == 'F')
				{
					self.loadAnswers();
				}else{
					JABB.Ajax.sendRequest(self.options.load_result_url, function (req) {
						self.poll_container.innerHTML = req.responseText;
					});
				}
			}
		}
	}
	return (window.stivaPHPpoll = stivaPHPpoll);
})(window);