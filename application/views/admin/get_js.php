<!-- START @PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url() ?>assets/js/apps.js"></script>
<script src="<?php echo base_url() ?>assets/js/pages/blankon.form.layout.js"></script>
<script src="<?php echo base_url() ?>assets/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/toastr/toastr.min.js"></script>



<script>
	var locale = "en-US";
	var site = "<?php echo site_url();?>";
	var iframe = null; var div = null;
	//Notif
	$(document).ready(function() {
		get_notif(get_newnotif);
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-top-right",
			"preventDuplicates": false,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		$( "body" ).removeClass( "page-sidebar-minimize" );
	});

	function cetak_(url) {
		if(iframe!=null){ div.removeChild(iframe); }
		if(div!=null){ document.body.removeChild(div); }
		div = document.createElement("div");
		div.id="print";
		iframe = document.createElement("iframe");
		iframe.src = url;
		iframe.name = "frame";
		div.appendChild(iframe);
		document.body.appendChild(div);
	}
	
	function get_newnotif() {
		setTimeout(function(){
			ntf = $("#ntf_container").find("a");
			$.ajax({
				url: "<?php echo site_url('autocomplete/get_newnotif') ?>",
				type: "post",
				data: {jml:ntf.length}
			})
			.done(function (data){
				data = JSON.parse(data);
				notif = "";
				notif_container = $("#ntf_container").html();
				for (var i = 0; i < data.length; i++) {
					row = data[i];
					r = "unread";
					notif = "<a href='"+row.url+"' data-id='"+row.id+"' class='media "+r+"'>"+"<div class='media-object pull-left'><i class='fa fa-info-circle fg-info'></i></div>"+"<div class='media-body'>"+"<span class='media-text'>"+row.pesan+"</span>"+"<span class='media-meta'>"+row.waktu+"</span>"+"</div></a>";
					toastr["success"](row.pesan, "Pesan Baru");
				}
				$("#ntf_container").html(notif+notif_container);
				unread = $("#ntf_container a.unread").length;
				$("#ntf_unread").text(unread);
				get_newnotif();
			})
			.fail(function (jqXHR, textStatus, errorThrown){
				console.error("The following error occurred: "+textStatus+"\nDetail Error: "+jqXHR.responseText, errorThrown);
			});
		}, 3000);
	}

	function get_notif(aksi) {
		$.ajax({
			url: "<?php echo site_url('autocomplete/get_notif') ?>",
			type: "post",
		})
		.done(function (data){
			data = JSON.parse(data);
			$("#ntf_count").text("("+data.length+")");
			var unread = 0;
			$("#ntf_container").html("");
			for (var i = 0; i < data.length; i++) {
				row = data[i];
				r = "unread";
				if (row.read>0) {
					r = "read";
				}
				notif = "<a href='"+row.url+"' data-id='"+row.id+"' class='media "+r+"'>"+"<div class='media-object pull-left'><i class='fa fa-info-circle fg-info'></i></div>"+"<div class='media-body'>"+"<span class='media-text'>"+row.pesan+"</span>"+"<span class='media-meta'>"+row.waktu+"</span>"+"</div></a>";
				$("#ntf_container").append(notif);
				if (row.read==0) {
					unread++;
				}
			}
			$("#ntf_unread").text(unread);
			if (aksi!=undefined) {
				aksi();
			}
		})
		.fail(function (jqXHR, textStatus, errorThrown){
			console.error("The following error occurred: "+textStatus+"\nDetail Error: "+jqXHR.responseText, errorThrown);
		});
	}

	function read_notif() {
		if ($("li.navbar-notification>a.dropdown-toggle").attr("aria-expanded")=="false") {
			read = function() {
				setTimeout(
					function(){ 
						unreads = $("#ntf_container a.unread");
						for (var i = 0; i < unreads.length; i++) {
							if($(unreads[i]).is(":visible")){
								$(unreads[i]).addClass("read");
								set_read($(unreads[i]).data('id'));
							} 
						}
					}, 
					3000);
			}
			get_notif(read);
		}
	}

	function set_read(id) {
		$.ajax({
			url: "<?php echo site_url('autocomplete/set_read') ?>",
			type: "post",
			data: {id:id}
		})
		.done(function (data){
			console.log(data);
		})
		.fail(function (jqXHR, textStatus, errorThrown){
			console.error("The following error occurred: "+textStatus+"\nDetail Error: "+jqXHR.responseText, errorThrown);
		});
	}

	//end notif

	function rp(nom) {
		nm = isNaN(nom)?0:nom;
		if (nm==0) {
			return "0";
		} else {
			nm = nm.toLocaleString("ID", {minimumFractionDigits: 2});
			ex = nm.split(",");
			if (ex[1]=="00") {
				return ex[0];
			} else {
				return nm;
			}
		}
	}

	function init_date() {
		$(".datem").change(function() {
			max = 30;
			m = $(this).val();
			if (m=="") {
				$(this).closest(".input-group").find(".dated").html("<option value=>- Tgl -</option>");
			} else {
				y = $(this).closest(".input-group").find(".datey").val()
				d = new Date(y, m, 0);
				df = parseInt($(this).closest(".input-group").find(".dated").data("default"));
				df = isNaN(df)?0:df;
				$(this).closest(".input-group").find(".dated").html("<option value=>- Tgl -</option>");
				for (var i = 1; i <= d.getDate(); i++) {
					sel = "";
					if (df==i) {sel = "selected";}
					$(this).closest(".input-group").find(".dated").append("<option value="+i+" "+sel+">"+i+"</option>");
				}
			}
		});

		$(".dated").change(function() {
			$(this).data("default",$(this).val());
		});

		$(".datem").change();
	}

	function init_numeric() {
		$(".numeric").keydown(function (e) {
	      // Allow: backspace, delete, tab, escape, enter
	      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
	           // Allow: Ctrl+A, Command+A
	           (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
	           // Allow: home, end, left, right, down, up
	           (e.keyCode >= 35 && e.keyCode <= 40)) {
	               // let it happen, don't do anything
	           return;
	       }
	      // Ensure that it is a number and stop the keypress
	      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	      	e.preventDefault();
	      }
	  });
	}

	function init_rp() {
		$('input.rp').bind("keyup change",function (){
			rpp = parseFloat($(this).val().replace(/[^0-9-,]/g,''));
			rpp = isNaN(rpp)?0:rpp;
			b = $(this).val();
			if (b.substr(b.length - 1)!=",") {
				if ((rpp % 1)<0) {
					$(this).val(rpp.toLocaleString("ID", {minimumFractionDigits: 2}));
				} else {
					if (b.substr(b.length - 2)!=",0") {
						$(this).val(rpp.toLocaleString("ID", {minimumFractionDigits: 0}));
					}
				}
			}
		});
	}

	function init_alpha(){
		$('.alphaonly').keydown(function (e) {
			if (!((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105))) {
				e.preventDefault();
			}
		});
	}

	function showMsg(title,pesan,calback = null) {
		pesan = pesan.replace("<strong>","");
		pesan = pesan.replace("</strong>","");
		ket_p = (title=="Peringatan")?"error":"success";
		if (calback!=null) {
			swal(title, pesan, ket_p).then((value) => {
				calback();
			});
		} else {
			swal(title, pesan, ket_p);
		}
	}

	function init_select2_kar() {
		$('.karyawans2').select2({
			ajax: {
				url: "<?php echo site_url("autocomplete/cari_karyawan") ?>",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term, 
						page: params.page
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;

					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			placeholder: 'Cari data karyawan disini...',
			escapeMarkup: function (markup) { return markup; }, 
			minimumInputLength: 0,
			templateResult: formatKrywn,
			templateSelection: formatKrywnSelection
		});

		function formatKrywn (data) {
			if (data.loading) {
				return data.text;
			}

			if (data.kyfoto!=null) {
				foto = data.kyfoto.substr(0,10)!='data:image'?"<?php echo site_url('upload/foto/no_photo.jpg') ?>":data.kyfoto;
			} else {
				foto = "<?php echo site_url('upload/foto/no_photo.jpg') ?>";
			}

			var markup = "<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__avatar'><img style='width:60px; height:60px;' src='"+foto+"' /></div>" +
			"<div class='select2-result-repository__meta'>" +
			"<div class='select2-result-repository__title'>" + data.text + "</div>";

			markup += "<div class='select2-result-repository__description'>" + data.jbnama+" <strong>DIVISI "+data.dvnama + "</strong></div>";

			markup += "<div class='select2-result-repository__statistics'>" +
			"<div class='select2-result-repository__forks'><i class='fa fa-download'></i> Masuk " + data.kymulai + "</div>" +
			"<div class='select2-result-repository__stargazers'><i class='fa fa-upload'></i> Selesai " + data.kyselesai + "</div>" +
			"<div class='select2-result-repository__watchers'><i class='fa fa-certificate'></i> " + data.kystatus + "</div>" +
			"</div>" +
			"</div></div>";

			return markup;
		}

		function formatKrywnSelection (data) {
			return data.text;
		}

	}

	function init_select2(page) {
		$('.'+page.toLowerCase()+'s2').select2({
			allowClear: true,
			placeholder: 'Pilih '+page+'',
			ajax: {
				url: '<?php echo site_url("autocomplete") ?>/cari_'+page,
				dataType: 'json',
				delay: 250,
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
	}

	function cetak_iframe(url) {
		iframe = document.getElementById("frame");
		iframe.src = url;
		$("#print").modal("show");
	}

	var tableToExcel_iframe = (function() {
		var uri = 'data:application/vnd.ms-excel;base64,'
		, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
		, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
		, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
		return function(table, name, iframe) {
			table = $('#'+table, $('#'+iframe).contents());
			td = $(table).find('td');
			table_html = $(table).html();
			for (var i = 0; i < td.length; i++) {
				if($.isNumeric($(td[i]).text().trim())){
					if ($(td[i]).text().trim().length==16) {
						table_html = table_html.replace($(td[i]).text().trim(), "'"+$(td[i]).text().trim());
					}
				}
			}
			console.log(table_html);
			var ctx = {worksheet: name || 'Worksheet', table: table_html} 
			window.location.href = uri + base64(format(template, ctx))
		}
	})();

	function init_select2_shift() {
		$('.shifts2').select2({
			ajax: {
				url: "<?php echo site_url("autocomplete/cari_shift") ?>",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						q: params.term, 
						page: params.page
					};
				},
				processResults: function (data, params) {
					params.page = params.page || 1;
					return {
						results: data.items,
						pagination: {
							more: (params.page * 30) < data.total_count
						}
					};
				},
				cache: true
			},
			placeholder: 'Cari shift karyawan disini...',
			escapeMarkup: function (markup) { return markup; }, 
			minimumInputLength: 0,
			templateResult: formatShift,
			templateSelection: formatShiftSelection
		});

		function formatShift (data) {
			if (data.loading) {
				return data.text;
			}
			var markup = "<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__meta' style='margin-left:4px'>" +
			"<div class='select2-result-repository__title'>" + data.text + "</div>";
			markup += "<div class='select2-result-repository__description'>" + data.ket_jadwal+"</div>";
			markup += "<div class='select2-result-repository__statistics'>" +
			"<div class='select2-result-repository__forks'>Shift 1 : " + data.shift1 + "</div>" +
			"<div class='select2-result-repository__stargazers'>Shift 2 : " + data.shift2 + "</div>" +
			"<div class='select2-result-repository__watchers'>Shift 3 : " + data.shift3 + "</div>" +
			"</div>" +
			"</div></div>";

			return markup;
		}

		function formatShiftSelection (data) {
			return data.text;
		}

	}
</script>