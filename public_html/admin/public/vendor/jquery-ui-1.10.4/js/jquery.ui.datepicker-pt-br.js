/* Brazilian initialisation for the jQuery UI date picker plugin. */
jQuery(function($){
	$.datepicker.regional['pt-BR'] = {
	       closeText: 'Fechar',
	       prevText: '&#x3c;Anterior',
	       nextText: 'Pr&oacute;ximo&#x3e;',
	       currentText: 'Hoje',
	       monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	       monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	       dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
	       dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	       dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	       weekHeader: 'Sm',
	       dateFormat: 'dd/mm/yy',
	       firstDay: 0,
	       isRTL: false,
	       showMonthAfterYear: false,
	       yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);

	$.timepicker.regional['pt-BR'] = {
		timeOnlyTitle: 'Selecione o tempo',
		timeText: 'Tempo',
		hourText: 'Horas',
		minuteText: 'Minutes',
		secondText: 'Segundos',
		millisecText: 'Milissegundos',
		timezoneText: 'Time Zone',
		currentText: 'Agora',
		closeText: 'Feito',
		timeFormat: 'HH:mm:ss',
		amNames: ['AM', 'A'],
		pmNames: ['PM', 'P'],
		isRTL: false
	};
	$.timepicker.setDefaults($.timepicker.regional['pt-BR']);

});