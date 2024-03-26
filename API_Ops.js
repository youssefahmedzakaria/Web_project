$(document).ready(function(){
    $('#checkActorsBtn').click(function(event){
        event.preventDefault();
        
        //day and month from date picker
        var day = $('#day').val();
        var month = $('#month').val();
        
        $.get('API_Ops.php', {day: day, month: month}, function(data){
            if (data) {
                var jsonData = JSON.parse(data);
                console.log("JSON Data:", jsonData); 
                
                if (Array.isArray(jsonData) && jsonData.length > 0) {
                    console.log("Number of Actors:", jsonData.length);
                } else {
                    console.error("Empty or invalid JSON data received from server.");
                }

                $('#actorsTable').html('');
                for(var i = 0; i < jsonData.length; i++){
                    var actorId = jsonData[i];

                    $('#actorsTable').append('<tr><td>' + actorId + '</td></tr>');
                }
            } else {
                console.error("Empty response received from server.");
            }
        }).fail(function(_, _, error) {
            console.error("Error fetching data:", error);
        });
    });
});
