var jQuery_1_8_2 = jQuery_1_8_2 || $.noConflict();
(function ($, undefined) {
	$(function () {
		"use strict";
		var $frmCreateQuestion = $("#frmCreateQuestion"),
			$frmUpdateQuestion = $("#frmUpdateQuestion"),
			datagrid = ($.fn.datagrid !== undefined),
			dialog = ($.fn.dialog !== undefined),
			$dialogDelete = $("#dialogDelete"),
			spinner = ($.fn.spinner !== undefined),
			tipsy = ($.fn.tipsy !== undefined),
			tabs = ($.fn.tabs !== undefined),
			$tabs = $("#tabs"),
			tOpt = {
				select: function (event, ui) {
					$(":input[name='tab_id']").val(ui.panel.id);
					if(ui.panel.id == 'tabs-4'){
						$('#statistic_container').html('<img src="'+myLabel.loader_img+'backend/loader.gif" />');
						$.ajax({
							type: "GET",
							dataType: 'html',
							url: 'index.php?controller=pjAdminPolls&action=pjActionStatistics&id=' + $('#post_id').val(),
							success: function (res) {
								$('#statistic_container').html(res);
							}
						});
					}
				}
			};
		
		$(".field-int").spinner({
			min: 0
		});
		if (tipsy) {
			$(".listing-tip").tipsy({
				offset: 1,
				opacity: 1,
				html: true,
				gravity: "nw",
				className: "tipsy-listing"
			});
			$(".poll-tip").tipsy({
				offset: 1,
				opacity: 1,
				html: true,
				gravity: "nw",
				className: "tipsy-poll"
			});
		}
		
		if ($tabs.length > 0 && tabs) {
			$tabs.tabs(tOpt);
		}
		
		if ($frmCreateQuestion.length > 0) {
			$frmCreateQuestion.validate({
				errorPlacement: function (error, element) {
					error.insertAfter(element.parent());
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em"
			});
		}
		if ($frmUpdateQuestion.length > 0) {
			$frmUpdateQuestion.validate({
				errorPlacement: function (error, element) {
					if(element.attr('name') == 'install_width')
					{
						error.insertAfter(element.parent().parent());
					}else{
						error.insertAfter(element.parent());
					}
					
				},
				onkeyup: false,
				errorClass: "err",
				wrapper: "em",
				ignore: "",
				invalidHandler: function (event, validator) {
				    if (validator.numberOfInvalids()) {
				    	var index = $(validator.errorList[0].element, this).closest("div[id^='tabs-']").index();
				    	if ($tabs.length > 0 && tabs && index !== -1) {
				    		$tabs.tabs(tOpt).tabs("option", "active", index-1);
				    	}
				    }
				}
			});
			fireSortable();
			setInstallCode();
		}
		
		function fireSortable()
		{
			$("#tblAnswerList").sortable({
				handle : '.pj-table-icon-move',
			    update : function () {
			    	$.ajax({
						type: "POST",
						dataType: 'json',
						data: $('#tblAnswerList').sortable('serialize'),
						url: 'index.php?controller=pjAdminPolls&action=pjActionSortAnswer&id=' + myLabel.question_id,
						success: function (res) {
							if(res.code == '200')
							{
								
							}
						}
					});
			    }
		    });
		}
		function addAnswerRow(){
			var $c = $("#tblAnswerClone tbody").clone(),
				$n = 'new_' + Math.ceil(Math.random() * 99999),
				r = $c.html().replace(/\{INDEX\}/g, $n);
			$("#tblAnswerList").append(r);
			$("#count_" + $n).spinner({
				min: 0
			});
		}
		if(myLabel.number_of_answers == '0')
		{
			addAnswerRow();
		}
		if ($dialogDelete.length > 0 && dialog) {
			$dialogDelete.dialog({
				modal: true,
				autoOpen: false,
				resizable: false,
				draggable: false,
				buttons: {
					"Delete": function () {
						$.ajax({
							type: "GET",
							dataType: 'json',
							url: $('#delete_answer_url').text(),
							success: function (res) {
								if(res.code == '200')
								{
									var $tr = $('#answer_row_' + $('#answer_row_index').text());
									$tr.css("backgroundColor", "#FFB4B4").fadeOut("slow", function () {
										$tr.remove();
										$dialogDelete.dialog("close");
									});
									$('#selectupto_answers').html(res.html);
								}
							}
						});
					},
					"Cancel": function () {
						$(this).dialog("close");
					}
				}
			});
		}
		
		function formatDefault (str, obj) {
			if (obj.role_id == 3) {
				return '<a href="#" class="pj-status-icon pj-status-' + (str == 'F' ? '0' : '1') + '" style="cursor: ' +  (str == 'F' ? 'pointer' : 'default') + '"></a>';
			} else {
				return '<a href="#" class="pj-status-icon pj-status-1" style="cursor: default"></a>';
			}
		}
		function setInstallCode()
		{
			var opt = $("input[name='poll_width']:checked").val();
			if(opt == 'fixed')
			{
				$(".fixed-size-container").show();
				var text = $('#install_clone').text();
				text = "<div style=\"width: "+$('#install_width').val()+"px;\">\n" + text + "\n</div>";
				$('#install_code').val(text);
			}
			if(opt == 'auto')
			{
				$(".fixed-size-container").hide();
				$('#install_width').val('250');
				$('#install_code').val($('#install_clone').text());
			}
		}
		if ($("#grid").length > 0 && datagrid) {
			
			var $grid = $("#grid").datagrid({
				buttons: [{type: "edit", url: "index.php?controller=pjAdminPolls&action=pjActionUpdate&id={:id}"},
				          {type: "delete", url: "index.php?controller=pjAdminPolls&action=pjActionDeletePoll&id={:id}"},
				          {type: "preview", url: "index.php?controller=pjAdminPolls&action=pjActionUpdate&id={:id}&tab_id=tabs-3"},
				          ],
				columns: [{text: myLabel.question, type: "text", sortable: true, editable: true, width: 380, editableWidth: 360},
				          {text: myLabel.total_votes, type: "text", sortable: true, editable: false, width: 100},
				          {text: myLabel.status, type: "select", sortable: true, editable: true, width: 100,options: [
				                                                                                     {label: myLabel.active, value: "T"}, 
				                                                                                     {label: myLabel.inactive, value: "F"}
				                                                                                     ], applyClass: "pj-status"}],
				dataUrl: "index.php?controller=pjAdminPolls&action=pjActionGetPoll",
				dataType: "json",
				fields: ['question', 'total_votes', 'status'],
				paginator: {
					actions: [
					   {text: myLabel.delete_selected, url: "index.php?controller=pjAdminPolls&action=pjActionDeletePollBulk", render: true, confirmation: myLabel.delete_confirmation},
					   {text: myLabel.revert_status, url: "index.php?controller=pjAdminPolls&action=pjActionStatusPoll", render: true}
					],
					gotoPage: true,
					paginate: true,
					total: true,
					rowCount: true
				},
				saveUrl: "index.php?controller=pjAdminPolls&action=pjActionSavePoll&id={:id}",
				select: {
					field: "id",
					name: "record[]"
				}
			});
		}
		
		
		$(document).on("click", ".btn-all", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$(this).addClass("pj-button-active").siblings(".pj-button").removeClass("pj-button-active");
			var content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			$.extend(cache, {
				status: "",
				q: ""
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminPolls&action=pjActionGetPoll", "created", "DESC", content.page, content.rowCount);
			return false;
		}).on("click", ".btn-filter", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $this = $(this),
				content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache"),
				obj = {};
			$this.addClass("pj-button-active").siblings(".pj-button").removeClass("pj-button-active");
			obj.status = "";
			obj[$this.data("column")] = $this.data("value");
			$.extend(cache, obj);
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminPolls&action=pjActionGetPoll", "created", "DESC", content.page, content.rowCount);
			return false;
		}).on("click", ".pj-status-1", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			return false;
		}).on("click", ".pj-status-0", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$.post("index.php?controller=pjAdminPolls&action=pjActionSetActive", {
				id: $(this).closest("tr").data("object")['id']
			}).done(function (data) {
				$grid.datagrid("load", "index.php?controller=pjAdminPolls&action=pjActionGetPoll");
			});
			return false;
		}).on("submit", ".frm-filter", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $this = $(this),
				content = $grid.datagrid("option", "content"),
				cache = $grid.datagrid("option", "cache");
			$.extend(cache, {
				q: $this.find("input[name='q']").val()
			});
			$grid.datagrid("option", "cache", cache);
			$grid.datagrid("load", "index.php?controller=pjAdminPolls&action=pjActionGetPoll", "created", "DESC", content.page, content.rowCount);
			return false;
		}).on("click", ".pj-form-field-icon-date", function (e) {
			var $dp = $(this).parent().siblings("input[type='text']");
			if ($dp.hasClass("hasDatepicker")) {
				$dp.datepicker("show");
			} else {
				$dp.trigger("focusin").datepicker("show");
			}
		}).on("focusin", ".datepick", function (e) {
			var minDateTime, maxDateTime,
				$this = $(this),
				custom = {},
				o = {
					firstDay: $this.attr("rel"),
					dateFormat: $this.attr("rev"),
					timeFormat: $this.attr("lang"),
					stepMinute: 5
			};
			switch ($this.attr("name")) {
			case "start_time":
				if($(".datepick[name='stop_time']").val() != '')
				{
					maxDateTime = $(".datepick[name='stop_time']").datetimepicker({
						firstDay: $this.attr("rel"),
						dateFormat: $this.attr("rev"),
						timeFormat: $this.attr("lang")
					}).datetimepicker("getDate");
					$(".datepick[name='stop_time']").datepicker("destroy").removeAttr("id");
					if (maxDateTime !== null) {
						custom.maxDateTime = maxDateTime;
					}
				}
				break;
			case "stop_time":
				if($(".stop_time[name='start_time']").val() != '')
				{
					minDateTime = $(".datepick[name='start_time']").datetimepicker({
						firstDay: $this.attr("rel"),
						dateFormat: $this.attr("rev"),
						timeFormat: $this.attr("lang")
					}).datetimepicker("getDate");
					$(".datepick[name='start_time']").datepicker("destroy").removeAttr("id");
					if (minDateTime !== null) {
						custom.minDateTime = minDateTime;
					}
				}
				break;
			}
			
			$(this).datetimepicker($.extend(o, custom));
			
		}).on("change", "#use_interval", function(e){
			
			if($(this).val() == 'T')
			{
				$('.time-container').css('display', 'block');
			}else{
				$('.time-container').css('display', 'none');
			}
		}).on("focusin", ".textarea_install", function (e) {
			$(this).select();
		}).on("click", ".btnAddAnswer", function () {
			addAnswerRow();
		}).on("click", ".phppoll-remove", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var $tr = $(this).closest("tr");
			$tr.css("backgroundColor", "#FFB4B4").fadeOut("slow", function () {
				$tr.remove();
			});			
			return false;
		}).on("click", ".phppoll-delete", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var href = $(this).attr('href'),
				row_index = $(this).attr('rev');
			
			$('#delete_answer_url').text(href);
			$('#answer_row_index').text(row_index);
			$dialogDelete.dialog('open');
		}).on("click", "#pj-skin-preview", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$('#tab_id').val('tabs-3');
			$frmUpdateQuestion.submit();
		}).on("change", "#multiple_vote", function (e) {
			if($('#limit_answers').length > 0)
			{
				if($(this).val() == 'T')
				{
					$('#limit_answers').parent().parent().parent().css('display', 'block');
				}else{
					$('#limit_answers').parent().parent().parent().css('display', 'none');
				}
			}
		}).on("change", "#theme", function (e) {
			var question_id = $frmUpdateQuestion.find("input[name='id']").val();
			$.ajax({
				type: "GET",
				dataType: 'json',
				url: 'index.php?controller=pjAdminPolls&action=pjActionSaveTheme&id=' + question_id + '&skin=' + $(this).val(),
				success: function (res) {
					if(res.code == '200')
					{
						window.location.href = "index.php?controller=pjAdminPolls&action=pjActionUpdate&id=" + question_id + "&tab_id=tabs-3";
					}
				}
			});
		}).on("change", "input[name='poll_width']", function (e) {
			setInstallCode();
		}).on("change keyup", "input[name='install_width']", function (e) {
			if($(this).valid())
			{
				setInstallCode();
			}
		});
	});
})(jQuery_1_8_2);