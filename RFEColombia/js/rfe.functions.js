// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
	$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
} 
// Change hash for page-reload
$('.nav-tabs a').on('shown', function (e) {
	window.location.hash = e.target.hash;
	window.scrollTo(0, 0);
})

/* JavaScript to register flight to a VID */
function showDisclaimer() {
	$('#closebutton').hide();
	$('#singlebutton1').hide();
	$('#cancelbutton').show();
	$('#singlebutton').show();
	$('#modalFlightsbody').fadeTo(600,0.3);
	$('#disclaimer').fadeTo(600,0.85);
}

/* JavaScript to cancel disclaimer */
function hideDisclaimer() {
	$('#closebutton').show();
	$('#singlebutton1').show();
	$('#cancelbutton').hide();
	$('#singlebutton').hide();
	$('#modalFlightsbody').fadeTo(600,1);
	$('#disclaimer').fadeTo(600,0);
}

/* JavaScript to register flight to a VID */
function searchFlights(value) {
	if(value !== '') {
		$('#resulttable').show();
		$('#bookingtable').hide();
		$('#resultbody').html('<tr><td colspan=9 style="text-align: center;"><h4><i class="fa fa-circle-o-notch fa-spin"></i> Loading... </h4></td></tr>');
		$.get('phpinc/ajax_searchflight.php?s='+value, function(returnData) {
			  if (!returnData) {
					$('#resultbody').html('<tr><td colspan=9 style="text-align: center;"><h4><img src="images/no.png"> No results</h4></td></tr>');
			  } else {
					$('#resultbody').html(returnData);
			  }
		 });
	} else {
		 $('#resulttable').hide();
		 $('#bookingtable').show();
	}
}

/* JavaScript to logout */
function logout() {
	$("#modalLogoff").html('<center><br/><img src="images/loading.gif"/><br/><h4>Logging off</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "logout.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		data    : {},
	}).done(function (result) {
		$("#modalLogoff").html('<div style="margin:0;padding:10px;" class="alert alert-success"><h4>You\'re now logged off.</h4><br/>This page will be reloaded as soon as you close this modal.</div>');

	});
	
	$('#modalLogoff').on('hidden', function () {
		window.location.reload(true);
	})
	
};

/* JavaScript to register flight to a VID */
function registerPosition(vid,name,id,modalID) {
	$('#disclaimer').hide();
	$('#modalFlightsbody').fadeTo(1,1);
	$("#modalFlightsbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Please, standby! We\'re booking your flight.</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_bookflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { s: "book", vid: vid, name: name, id: id, },
	}).done(function (result) {
		$("#modalFlightsbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The flight has been booked succesfully!<br/><br/>Stand by for the page\'s automatic reload.</div><div id="sendingmail"><img src="images/loadingsmallball.gif"/> Standby, sending mail...</div>');
		$.ajax({
			type    : "GET",
			url     : "phpinc/sendmail.php",
			dataType: "html",
			contentType: 'application/x-www-form-urlencoded',
			beforeSend: function(jqXHR) {
				jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
			},
			data    : { id: id, action: 'bookdone' },
		}).done(function (result) {
			$("#sendingmail").hide();
			$("#modalFlightsbody").append('<div class="alert alert-warning">If you registered a mail in your profile, you\'ll receive a mail with booking\'s details.</div>');
			window.location.reload(true);
		});
	});
}
/* JavaScript to add flight as admin */
function addFlight() {

	var acft1         = $("#acft1").val();
	var route1        = $("#route1").val();
	var flightnumber  = $("#flightnumber").val();
	var radiocallsign = $("#radiocallsign").val();
	var origin        = $("#origin").val();
	var destination   = $("#destination").val();
	var deptime       = $("#deptime").val();
	var arrtime       = $("#arrtime").val();
	var gate          = $("#gate").val();
	var vid1          = $("#vid1").val();
	var name1         = $("#name1").val();
	
	$("#modalFlightsfooter").html('');
	$("#modalFlightsbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Adding the flight</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_addflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { acft: acft1, route: route1, radiocallsign: radiocallsign, flightnumber: flightnumber, origin: origin, destination: destination, deptime: deptime, arrtime: arrtime, gate: gate, vid: vid1, name: name1, },
	}).done(function (result) {
		$("#modalFlightsbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The flight has been added!</div>');
		window.location.reload(true);
	});
};
/* JavaScript to update flight as admin */
function updatePosition(id) {

	var acft0        = $("#acft0").val();
	var route0       = $("#route0").val();
	var flightnumber = $("#flightnumber").val();
	var radiocallsign = $("#radiocallsign").val();
	var origin       = $("#origin").val();
	var destination  = $("#destination").val();
	var deptime      = $("#deptime").val();
	var arrtime      = $("#arrtime").val();
	var gate         = $("#gate").val();
	var turnover     = $("#turnover").val();
	var vid0         = $("#vid0").val();
	
	if (!flightnumber) {
		$("#errorMessages").html('<center>Please, fill a suitable Flight Number before send this form.</center>');
		$("#errorMessages").effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',2000);
		return;
	}
	if (!origin) {
		$("#errorMessages").html('<center>Please, fill a suitable Origin before send this form.</center>');
		$("#errorMessages").effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',2000);
		return;
	}
	if (!destination) {
		$("#errorMessages").html('<center>Please, fill a suitable Destination before send this form.</center>');
		$("#errorMessages").effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',2000);
		return;
	}
	if (!acft0) {
		$("#errorMessages").html('<center>Please, fill a suitable Aircraft before send this form.</center>');
		$("#errorMessages").effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',500).effect('highlight',2000);
		return;
	}
	
	$("#modalFlightsfooter").html('');
	$("#modalFlightsbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Updating the flight.</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_updateflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { acft: acft0, route: route0, id: id, flightnumber: flightnumber, radiocallsign: radiocallsign, origin: origin, destination: destination, deptime: deptime, arrtime: arrtime, gate: gate, turnover: turnover, vid: vid0, },
	}).done(function (result) {
		$("#modalFlightsbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The flight has been updated.</div>');
		window.location.reload(true);
	});
};
/* JavaScript to delete flight as admin */
function deletePosition(id) {
	$("#modalFlightsfooter").html('');
	$("#modalFlightsbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Deleting the flight.</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_deleteflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { id: id, },
	}).done(function (result) {
		$("#modalFlightsbody").html('<div class="alert alert-error"><center>The flight has been deleted.</center></div>');
		window.location.reload(true);
	});
};
/* JavaScript to update event as admin */
function updateEvent(id) {

	var division     = $("#division").val();
	var divisioniso  = $("#divisioniso").val();
	var datestart    = $("#datestart").val();
	var timestart    = $("#timestart").val();
	var dateend      = $("#dateend").val();
	var timeend      = $("#timeend").val();
	var apticao      = $("#apticao").val();
	var aptname      = $("#aptname").val();
	var timezone     = $("#timezone").val();
	var privatebook  = $("#privatebook").val();
	var sendermail   = $("#sendermail").val();
	var useradiocallsign = $("#useradiocallsign").val();
	var status       = $("#status").val();
	
	$("#modalFlightsfooter").html('');
	$("#modalFlightsbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Updating the flight.</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_updateevent.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { id: id, division: division, divisioniso: divisioniso, datestart: datestart, timestart: timestart, dateend: dateend, timeend: timeend, apticao: apticao, aptname: aptname, timezone: timezone, privatebook: privatebook, sendermail: sendermail, useradiocallsign: useradiocallsign, status: status },
	}).done(function (result) {
		$("#modalFlightsbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The event been updated.</div>');
		window.location.reload(true);
	});
};
/* Unbook a position */
function removePosition(id,accordid) {
	$("#"+accordid).hide();
	$("#"+accordid).html('');
	$("#ajaxinfo").html('<center><img src="images/loading.gif"/><br/><h4>Deleting your flight!</h4></center>');
	$("#ajaxinfo").show();
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_bookflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { s: "unbook", id: id, },
	}).done(function (result) {
		$("#ajaxinfo").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The flight has been deleted successfully!</div>');
		//$("#ajaxinfo").delay(3000).slideUp(1000);
		$("#ajaxinfo").delay(3000).queue(function(){
			$(this).addClass('animated lightSpeedOut');
			$(this).dequeue();
		});
		$("#ajaxinfo").removeClass('animated lightSpeedOut');
		setTimeout(function () {
			 $("#ajaxinfo").slideUp(1000);
		}, 4000);
		//location.reload(true);
	});
};
/* JavaScript to add a slot for private */
function addSlot() {

	var newslot = $("#newslot").val();
	
	$("#modalbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Adding the slot</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_addflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { addslot: "add", newslot: newslot,  },
	}).done(function (result) {
		$("#modalbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The slot has been added!</div>');
		window.location.reload(true);
	});
};
/* Grant slot to a pilot */
function grantSlot(id,slot) {
	$("#modalbody").html('<center><img src="images/loading.gif"/><br/><h4>Granting the slot!</h4></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_grantslot.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { action: "grant", id: id, slot: slot },
	}).done(function (result) {
		$("#modalbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The slot has been granted successfully!</div>');
	});
	$.ajax({
		type    : "GET",
		url     : "phpinc/sendmail.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { id: id, action: 'privatedone' },
	}).done(function (result) {
		$("#modalbody").append('<div class="alert alert-warning">The member has been informed by mail.</div>');
		window.location.reload(true);
	});
};
/* Revoke slot from a pilot */
function revokeSlot(id,slot) {
	$("#modalbody").html('<center><img src="images/loading.gif"/><br/><h4>Revoking the slot</h4></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_grantslot.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { action: "revoke", id: id, slot: slot },
	}).done(function (result) {
		$("#modalbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The slot has been revoked successfully!</div>');
		window.location.reload(true);
	});
};
/* JavaScript to register flight to a VID */
function sendBookmail(id) {
	$('.panel-collapse').collapse('hide');
	$("#maillabel"+id).removeClass('label').removeClass('label-inverse').html('<i class="fa fa-envelope-o  fa-spin"></i>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/sendmail.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { id: id, action: 'bookdone' },
	}).done(function (result) {
		$("#maillabel"+id).html('Mail Sent!').addClass('label').effect("highlight").effect("highlight").effect("highlight").effect("highlight").effect("highlight");
	});
}
/* JavaScript to add an admin to the system */
function addAdmin() {

	var newadmin = $("#newadmin").val();
	
	$("#modalbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Adding the admin</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_addflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { addadmin: "add", newadmin: newadmin,  },
	}).done(function (result) {
		$("#modalbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The admin has been added!</div>');
		window.location.reload(true);
	});
};

/* JavaScript to edit an admin from the system*/
function editAdmin(id) {

	var privileges = $("#privileges").val();
	
	$("#modalbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Editing the admin</h4><br/></center>');	
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_updateadmin.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { id: id, level: privileges },
	}).done(function (result) {
		$("#modalbody").html('<div class="alert alert-success"><center>The admin has been updated.</center></div>');
		window.location.reload(true);
	});
};
/* JavaScript to delete an admin from the system*/
function deleteAdmin(id) {
	$("#modalbody").html('<center><br/><img src="images/loading.gif"/><br/><h4>Deleting the admin</h4><br/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_deleteflight.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { deladmin: "del", id: id, },
	}).done(function (result) {
		$("#modalbody").html('<div class="alert alert-error"><center>The admin has been deleted.</center></div>');
		window.location.reload(true);
	});
};
/* JavaScript to save user mail */
function saveMail(id) {
	var membermail = $("#membermail").val();
	
	$("#modalMailbody").html('<center><br/><img src="images/loading.gif"/></center>');
	$.ajax({
		type    : "GET",
		url     : "phpinc/ajax_registermail.php",
		dataType: "html",
		contentType: 'application/x-www-form-urlencoded',
		beforeSend: function(jqXHR) {
			jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
		},
		data    : { id: id, membermail: membermail, },
	}).done(function (result) {
		$("#modalMailbody").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>Your mail has been registered.</div>');
		window.location.reload(true);
	});
};
/* JavaScript to load modal for a flight */
function loadModal(id) {
	$("#modalFlights").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Flight details</h4></br></center>');
	$("#modalFlights").load('phpinc/modal_flight.php', {'id': id });
};
function loadAdd(id) {
	$("#modalAdd").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Flight details</h4></br></center>');
	$("#modalAdd").load('phpinc/modal_add.php');
};
function loadEdit(id) {
	$("#modalEdit").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Flight details</h4></br></center>');
	$("#modalEdit").load('phpinc/modal_edit.php', {'id': id });
};
function loadDelete(id) {
	$("#modalDelete").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Flight details</h4></br></center>');
	$("#modalDelete").load('phpinc/modal_delete.php', {'id': id });
};
function loadEditEvent(id) {
	$("#modalEditEvent").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Event config</h4></br></center>');
	$("#modalEditEvent").load('phpinc/modal_editevent.php', {'id': id });
};
function loadSlotManage(id) {
	$("#modalSlotManage").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Slot Management System</h4></br></center>');
	$("#modalSlotManage").load('phpinc/modal_slotmanagement.php', {'id': id });
};
function loadAdminEdit(id) {
	$("#modalAdmin").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Admin Control System</h4></br></center>');
	$("#modalAdmin").load('phpinc/modal_admincontrol.php', {'id': id });
};
function loadModalAirport(icao) {
	$("#modalAirport").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Airport details</h4></br></center>');
	$("#modalAirport").load('phpinc/modal_airport.php', {'icao': icao });
};
function loadPrivate(id) {
	$("#modalFlights").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Flight details</h4></br></center>');
	$("#modalFlights").load('phpinc/modal_private.php', {'id': id });
};
/* JavaScript to edit an admin from the system*/
function loadEditAdminMenu(id) {
	$("#modalAdmin").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Admin Details</h4></br></center>');
	$("#modalAdmin").load('phpinc/modal_editadmin.php', {'id': id });
};
/* JavaScript to retrieve METAR from airport */
function loadMETAR(icao,div) {
	div = typeof div !== 'undefined' ? div : "collapsemetarcontent";
	$('#'+div).load('phpinc/getweather.php', {'icao': icao, 'wx': 'metar' });
};
/* JavaScript to retrieve TAF from airport */
function loadTAF(icao,div) {
	div = typeof div !== 'undefined' ? div : "collapsetafcontent";
	$("#"+div).load('phpinc/getweather.php', {'icao': icao, 'wx': 'taf' });
};
/* JavaScript to retrieve name for airports */
function loadApt(icao,div) {
	$("#"+div).load('phpinc/getweather.php', {'icao': icao, 'wx': 'name' });
};
/* JavaScript to retrieve aircraft types */
function loadAcft(icao) {
	$("#acftdiv").load('phpinc/getweather.php', {'icao': icao, 'wx': 'acft' });
};