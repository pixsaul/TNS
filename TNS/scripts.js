$(document).ready(function() {
	
	//init data tables
	$('#players').DataTable({
        "paging":   false,
        "info":     false,
        "bFilter": false,
        "columnDefs": [
			{ "orderable": false, "targets": 2 }
		]
    });
    
	//do an initial player count
	$('.count').html($(":input.playing[value='Y']:checked").length);
	
	//calculate subs
	$playerCount = $(":input.playing[value='Y']:checked").length;
	if ($playerCount > 0) {
		$cost = (35 / $playerCount).toFixed(2);
		$('.cost').html("&pound;" + $cost + " each");
	}
	
	else {
		$('.cost').html("");	
	}
	
	//Change to playing status
    $('input.playing').click(function(e) {
	    
	    //get player id
	    playerId = $(this).attr("name").replace('playing_','');
	                    
        $.ajax({  
			type: 'POST',  
			url: 'funcs/save.php', 
			data: {playing: $(this).val(), playerId: playerId},
			success: function(response) {
				console.log(response);
    		}
		});
		
		//get new player count
		$('.count').html($(":input.playing[value='Y']:checked").length);
		//calculate subs
		$playerCount = $(":input.playing[value='Y']:checked").length;
		if ($playerCount > 0) {
			$cost = (35 / $playerCount).toFixed(2);
			$('.cost').html("&pound;" + $cost + "");
		}
		//update tr status
		$("input.playing[value='Y']:checked").parent().parent().parent('tr').removeClass('danger').addClass('success');
		$("input.playing[value='N']:checked").parent().parent().parent('tr').removeClass('success').addClass('danger');
		

    });
    
	//Add new player
    $('#newPlayer').submit(function(e) {
		e.preventDefault();

        $.ajax({  
			type: 'POST',  
			url: 'funcs/add.php', 
			data: {name: $('input#name').val()},
			success: function(response) {
				console.log(response);
				//reload page to display new player
				location.reload();
    		}
		});

    });
    
    //Pick the teams
    $('#pickTeams').click(function(e) {
		e.preventDefault();

        $.ajax({  
			type: 'POST',  
			url: 'funcs/pick.php', 
			success: function(response) {
				//console.log(response);
				//reload page to display new player
				location.reload();
    		}
		});

    });
    
    //Record Bib win
    $('#bibWin').click(function(e) {
		e.preventDefault();

        $.ajax({  
			type: 'POST',  
			url: 'funcs/bibWin.php', 
			success: function(response) {
				alert('Win recorded for Bibernian!');
    		}
		});

    });
    
    //Record BibNo win
    $('#bibNoWin').click(function(e) {
		e.preventDefault();

        $.ajax({  
			type: 'POST',  
			url: 'funcs/bibNoWin.php', 
			success: function(response) {
				alert('Win recorded for Athletic Bibno!');
    		}
		});

    });

    
    

    
    //Delete a player
    $('.del').click(function(e) {
	    
	    //Get id of row to be deleted
	   	playerId = $(this).parent().parent().attr("class").replace('player_','');
	            
        //console.log(playerId);
        
        $.ajax({  
			type: 'POST',  
			url: 'funcs/delete.php', 
			data: {playerId: playerId},
			success: function(response) {
				//console.log(response);
				//reload page to show new player list
				location.reload();

    		}
		});
	
    });

    //Clear a status
    $('.clear').click(function(e) {
	    
	    //Get id of row to be cleared
	   	playerId = $(this).parent().parent().attr("class").replace('player_','');
	            
        //console.log(playerId);
        
        $.ajax({  
			type: 'POST',  
			url: 'funcs/clearStatus.php', 
			data: {playerId: playerId},
			success: function(response) {
				//console.log(response);
				//reload page to show new player list
				location.reload();

    		}
		});
	
    });
    
    //Ratings
    var total = 0;
	$('.teamBlock__bibs .r').each(function () {
	    total += parseInt($(this).text(), 10)
	});
	//console.log(total);
		
	var total = 0;
	$('.teamBlock__nobibs .r').each(function () {
	    total += parseInt($(this).text(), 10)
	});
	//console.log(total);

});