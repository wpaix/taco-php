
let App = {
	baseurl: window.location.href,
	showGraphRowsMax:20,
}


$('.toggler .toggle').click(function(){
	let $toggler = $(this).parents('.toggler')
	let $toggle = $(this)
	let $toggles = $toggler.find('.toggle')
	let val = $toggle.attr('data-val')
	$toggler.attr('data-val', val)
	$toggles.removeClass('active')
	$toggle.addClass('active')
})

$('#insertweightkg').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') $('#saveweightbtn').trigger('click')
})

$('#saveweightbtn').click(function(){
	
	let kg = $('#insertweightkg').val()
	let clothing = $('#insertclothing').attr('data-val')
	
	let date = $('#insertdater').val()
	
	if( !kg ) {
		alert('Husk KG')
		return
	}
	
	if( !clothing ) {
		alert('Husk tøj')
		return
	}
	
	var data = {
		kg: kg,
		clothing: clothing,
		date: date,
	}
	
	$.post( App.baseurl +  '?api=submit', data, function(){
		$('body').html('...')
		setTimeout(function(){
			window.location.reload()
		}, 100)		
	})
	
})



$('[data-delete-entry]').click(function(){
	
	let uid = $(this).attr('data-uid')	
	let entry = getEntry(uid)
	
	let sure = confirm('Slet '+entry.kg+' kg ('+entry.date+') ?')
	if( !sure ) return
	
	let sure2 = confirm('Sikker?')
	if( !sure2 ) return
	
	var data = {
		uid:uid,
	}
	
	$.post( App.baseurl +  '?api=entry_delete', data, function(){
		$('body').html('...')
		setTimeout(function(){
			window.location.reload()
		}, 100)		
	})
	
})

//----------------------------------------------------------------------------------

$('.edit-rate').click(function(){
	var old_val = $(this).text()
	var new_val = prompt(old_val)
	var new_val = Number (new_val)
	if( !(new_val >= 0) ) return
	$(this).text(new_val)
	recalculate__project()
})

function recalculate__project(){
	var rate = parseFloat($('.edit-rate').text())
	var hrs = 0
	var total = 0
	$('.timelogs-table .value-hrs').each(function(){ hrs += parseFloat($(this).text()) || 0 })
	$('.timelogs-table .input-hrs').each(function(){ hrs += parseFloat($(this).val()) || 0 })

	var total_dkk = hrs * rate

	$('.totals-line .hours .val').text(hrs)
	$('.totals-line .amount .val').text(total_dkk)
}

$(document).on('change', '.timelogs-table .input-hrs', recalculate__project)

//----------------------------------------------------------------------------------

function get_today_string(){
	var d = new Date()
	var date = new Intl.DateTimeFormat('en-GB').format(d)
	var hr = new Intl.DateTimeFormat('en', { hour: '2-digit', hour12:false, }).format(d)
	var min = new Intl.DateTimeFormat('en', { minute: '2-digit' }).format(d)
	var s = date + ' ' + hr + ':' + min	
	return s
}

//----------------------------------------------------------------------------------

$('.add-timelog-btn').click(function(){
	var $row = $('.timelogs-table tbody tr:first-of-type').clone()
	$row.find('td:first-child input').val('')
	$row.find('td:nth-child(2) textarea').val('')
	//$row.find('td:nth-child(3) input').val('')
	$row.find('td:nth-child(4) input').val(get_today_string())
	$('.timelogs-table tbody').prepend($row)
	$row.find('td:first-child input').val('').focus()
})

$(document).on('click', '.timelogs-table .row-remove-btn', function(){
	if( !$(this).hasClass('clicked') ) return $(this).addClass('clicked')
	var sure = confirm('Er du sikker på at du ønsker at slette? Dette kan ikke fortrydes.')
	if(!sure) return
	$(this).closest('tr').remove()
})

$(document).on('mouseout', '.timelogs-table .row-remove-btn', function(){
	$(this).removeClass('clicked')
})

function save_timelogs(){
	// traverse table and get info
	// ajax to api endpoint
	// show feedback saved
}

//----------------------------------------------------------------------------------

$('.create-project-btn').click(function(){

	var project = {
		client_slug: $(this).attr('data-client-slug'),
	}
	project.name = prompt('Titel?')
	project.color = prompt('Farve?')
	project.hour_rate = prompt('Timepris?')
	console.log(project)

	$.post( '/api/create_project', project )
		.done(function(){
			alert('done!')
		})
		.fail(function(){
			alert('Fejl')
		})
})

//----------------------------------------------------------------------------------    
    
    $(window).resize(function(){
        
	})
	
    
//----------------------------------------------------------------------------------    