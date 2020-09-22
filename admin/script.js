update_time();
setInterval(update_time,10000);
function update_time(){
  moment.locale('th');
    $("#show_thaidate").html(moment().add(543, 'year').format('วันdddd ที่ Do MMMM YYYY เวลา LT'));
    document.getElementById('time_to_table').value = moment().format('LT:ss');
    console.log((moment().add(543, 'year').format('LT')));
}

$(document).ready(function() {
  $('#example').DataTable();
  const startOfMonth = moment().startOf('month').format('YYYY-MM-DD');
  const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');
  document.getElementById('start_date').value = startOfMonth;
  document.getElementById('end_date').value = endOfMonth;
  // console.log(startOfMonth, endOfMonth)
} );
