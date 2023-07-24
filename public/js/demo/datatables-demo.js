// Call the dataTables jQuery plugin
$(document).ready(function()
{
    $('#datatable').DataTable( {
        "aoColumnDefs": [
            { 'bSortable': false, 'aTargets': [0,1,6] }
        ],
        responsive: true,
    });
});
