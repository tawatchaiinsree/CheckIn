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
} );

function get_contact(id){
  console.log(id);
  $.post("get_contact.php",
  {
    id: id,
  },
  function(data,status){
    if(status === 'success'){
      var data = JSON.parse(data);
      document.getElementById('detail').innerHTML = data.detail;
      document.getElementById('subject').innerHTML = data.subject;
      document.getElementById('reply_msg').innerHTML = data.reply_msg;
    }
  });
}