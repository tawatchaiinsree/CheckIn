update_time();
setInterval(update_time,1000);
function update_time(){
  moment.locale('th');
    $("#show_thaidate").html(moment().add(543, 'year').format('วันdddd ที่ Do MMMM YYYY เวลา LT:ss'));
    document.getElementById('time_to_table').value = moment().format('LT:ss');
    console.log((moment().add(543, 'year').format('LT')));
}

$(document).ready(function() {
  $('#example').DataTable();
} );