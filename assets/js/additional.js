$(document).ready(function () {
	$(function () {
		$("span.togglepassword").click(function () {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});

		$("span.toggle_confirmpassword").click(function () {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle_confirm"));
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	});

	$(".option-select").chosen();
	if (islogin == 1) {
		var val_provid;
		function show_kab(val_provid) {
			$.ajax({
				type: "post",
				dataType: "json",
				url: baseurl + "auth/option_kabupaten",
				data: {
					provid: val_provid,
					"<?php echo $this->security->get_csrf_token_name(); ?>:":
						"<?php echo $this->security->get_csrf_hash(); ?>",
				},
				success: function (response) {
					$("#kab").html(response);
					$("#kab").trigger("chosen:updated");
				},
				error: function () {
					alert("Invalid!");
				},
			});
		}

		val_provid = $("#prov option:selected").val();
		show_kab(val_provid);

		$("#prov").change(function () {
			val_provid = $(this).val();
			show_kab(val_provid);
		});

		var val_kabid;

		function show_kec(val_kabid) {
			$.ajax({
				type: "post",
				dataType: "json",
				url: baseurl + "auth/option_kecamatan",
				data: {
					kabid: val_kabid,
					"<?php echo $this->security->get_csrf_token_name(); ?>:":
						"<?php echo $this->security->get_csrf_hash(); ?>",
				},
				success: function (responses) {
					$("#kec").html(responses);
					$("#kec").trigger("chosen:updated");
				},
				error: function () {
					alert("Invalid!");
				},
			});
		}

		val_kabid = kabupatenid;
		show_kec(val_kabid);

		$("#kab").change(function () {
			val_kabid = $(this).val();
			show_kec(val_kabid);
		});
	}

	$(".mobile-version").hide();
	$(".desktop-version").show();
	$(window).resize(function () {
		if ($(window).width() <= 480) {
			$(".desktop-version").hide();
			$(".mobile-version").show();
		} else {
			$(".mobile-version").hide();
			$(".desktop-version").show();
		}
	});

	$(function () {
		// $(".datepicker").datetimepicker(
		//     {
		//         timepicker:false,
		//         format:"Y-m-d"
		//     }
		// );

		$(".datepicker")
			.datepicker({
				format: "dd-MM-yyyy",
				autoclose: true,
				todayHighlight: true,
				endDate: "today",
				maxDate: "0",
			})
			.on("changeDate", function () {
				var selectedate = $(this).val();
				if (selectedate > current_date) {
					$(".datepicker").val(current_date);
					return false;
				} else {
					return true;
				}
			})
			.keyup(function (e) {
				if (e.keyCode == 8 || e.keyCode == 46) {
					$.datepicker._clearDate(this);
				}
			});
	});

	// $('.filter').on('change', function()
	// {
	//     var param_url;
	//     var filtercategory = $(this).attr('data-filter');
	//     var queryString = window.location.search;
	//     var href = window.location.href;
	//     var length_categoryid = $("input[name=category_id]").filter(':checked').length;
	//     var length_size = $("input[name=size]").filter(':checked').length;
	//     if(filtercategory == 'category')
	//     {
	//         if ($(this).is(':checked')) {
	//             if(queryString == '' && length_categoryid <= 1)
	//             {
	//                 param_url = '?category_id='+$(this).val();
	//             } else if (queryString != '' && length_categoryid > 1 && href.indexOf('category_id') != -1) {
	//                 param_url = href+','+$(this).val();
	//             } else if(queryString != '' && length_categoryid <= 1) {
	//                 param_url = href+'&category_id='+$(this).val();;
	//             }
	//         } else if (!$(this).is(':checked')) {
	//             if(length_categoryid <= 0)
	//             {
	//                 if(href.indexOf('category_id') != -1){
	//                     param_url = href.replace('category_id='+$(this).val(),'');
	//                     param_url = param_url.replace('&','');
	//                 }
	//             } else if(length_categoryid >= 2) {
	//                 if(href.indexOf('category_id') != -1){
	//                     param_url = href.replace($(this).val()+',','');
	//                 }
	//             } else if(length_categoryid == 1) {
	//                 if(href.indexOf('category_id') != -1){
	//                     param_url = href.replace($(this).val(),'');
	//                     param_url = param_url.replace(',','');
	//                 }
	//             }
	//         }
	//     }

	//     if(filtercategory == 'size')
	//     {
	//     }
	//     alert(param_url);
	//     window.history.replaceState(null, null, param_url);
	// });
});
