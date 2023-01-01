$(document).ready(function(){
    $(".form-input-place").hide();
    $("#place").attr("disabled", "disabled");

    $(".form-input-winner").on("change", function(e){
        let {value} = e.target
        console.log(value)
        if(value == "yes"){
            $(".form-input-place").show();
            $("#place").removeAttr("disabled")
        }else{
            $(".form-input-place").hide();
            $("#place").attr("disabled", "disabled");
        }
    })

    let organizations_table = $("#organizations-table")
    if(organizations_table.length > 0){
        organizations_table.DataTable({
            responsive: true
        });
    }
    
    let events_table = $("#events-table")
    if(events_table.length > 0){
        events_table.DataTable({
            responsive: true
        });
    }
    
    let participants_table = $("#participants-table")
    if(participants_table.length > 0){
        participants_table.DataTable({
            responsive: true
        });
    }

    let event_participants_datatable = $(".event-participants-datatable")
    if(event_participants_datatable.length > 0){
        event_participants_datatable.DataTable({
            responsive: true
        })
    }
})