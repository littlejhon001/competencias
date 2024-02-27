var redibujar = [];
estadomenu = document.getElementById("sidebar");
var TOOLBOX = {
	show: true,
	// orient: 'vertical',
	feature: {
		mark: {
			show: true
		},
		dataView: {
			show: true,
			readOnly: false
		},
		magicType: {
			show: true,
			type: ['line', 'bar']
		},
		restore: {
			show: true
		},
		saveAsImage: {
			show: true
		}
	}
};
var TABLECONFG = {
	responsive: {
		details: false
	},
	language: {
		paginate: {
			previous: 'Anterior',
			next: 'Siguiente',
		},
		info: 'Pagina _START_ de _END_ de _TOTAL_ registros',
		search: 'Buscar:',
		emptyTable: 'No hay registros',
		lengthMenu: 'Registros: _MENU_'
	},
	// ordering:  false
};
$(function () {
	window.alert = function (message) {
		new PNotify({
			title: message,
			confirm: {
				confirm: true,
				buttons: [{
					text: 'Cerrar',
				}, {
					text: 'x',
					addClass: 'hidden'
				}]
			}
		});
	};
	loading(false);
	var menu = $('#side-main-menu li a');
	menu.map(function (k, v) {
		if (v.href == location.href) {
			v.parentNode.classList.add('active');
			var el = $(v).closest('ul').closest('li').addClass('active');
			$('a', el).click();
		}
	});
	$(document).ajaxStart(function () {
		loading(true);
	});
	$(document).ajaxComplete(function (a, b) {
		if (b.status !== 200) {
			mensaje(b.statusText, b.status);
		} else if (b.responseJSON) {
			var el = b.responseJSON;
			if (el.error) {
				mensaje('Mensaje...', parsestring(el.error, '<hr>'), 'error');
			}
			if (el.mensaje) {
				mensaje('', parsestring(el.mensaje, '<hr>'), 'notice');
			}
		}
		loading(false);
	});
});
function arrayToObjet(form) {
	return $(form).serializeArray().reduce(function (a, x) { a[x.name] = x.value; return a; }, {});
}
function parsestring(msj, separador) {
	if (separador === undefined) separador = '<hr>';
	if (typeof msj === 'string' || msj instanceof String) {
		return msj;
	} else if (msj instanceof Array || msj.constructor === Array) {
		return msj.join(separador);
	} else if (msj instanceof Object || msj.constructor === Object) {
		return Object.entries(msj).map(function (entry) { return entry.join(':'); }).join(separador);
	}
}
function loading(estado) {
	if (estado) {
		$('#divpreload').show();
	} else $('#divpreload').hide(300);
}
function error(er, code) {
	mensaje('Error: ' + er.status, 'Error al cargar la pagina ' + code, 'error');
}
function mensaje(titulo, texto, tipo) {
	loading(false);
	texto = texto ? texto : '';
	new PNotify({
		title: titulo,
		text: texto,
		type: tipo,
		icon: '',
		// styling:'fontawesome'
		confirm: {
			confirm: true,
			buttons: [{
				text: 'Cerrar',
				addClass: 'bg-primary'
			}, {
				text: 'x',
				addClass: 'hidden'
			}]
		}
	});
	// tipo = notice, success, error, info
}
function confirmar(t, form, tipo) {
	new PNotify({
		title: t ? t : 'Confirmar',
		hide: false,
		addclass: 'stack-modal',
		icon: 'fa fa-question-circle',
		type: tipo ? tipo : 'info',
		stack: {
			'dir1': 'down',
			'dir2': 'left',
			'modal': true,
			'overlay_close': true
		},
		confirm: {
			confirm: true,
			buttons: [{
				text: 'Si',
				addClass: 'bg-success',
				click: function (notice, value) {
					notice.remove();
					form.submit();
				}
			}, {
				text: 'Cancelar'
			}]
		},
		buttons: {
			closer: false,
			sticker: false
		}
	});
}
function closeWindow() {
	window.open('', '_parent', '');
	window.close();
}
function encode64(e) {
	var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1,
		n = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2];
	return (
		n && (e = JSON.stringify(e)),
		(1 === t ? btoa(e) : btoa(btoa(e))).replace(/=/gi, "")
	);
}
function decode64(e) {
	var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 1,
		n = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2];
	return (e = 1 === t ? atob(e) : atob(atob(e))), n && (e = JSONparse(e)), e;
}
function JSONparse(t) {
	try {
		return JSON.parse(t);
	} catch (e) {
		return window.history.back(), {};
	}
}