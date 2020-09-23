update_time();
setInterval(update_time,10000);
function update_time(){
  moment.locale('th');
    $("#show_thaidate").html(moment().add(543, 'year').format('สถานะพนักงานทั้งหมดประจำวันdddd ที่ Do MMMM YYYY เวลา LT'));
    document.getElementById('time_to_table').value = moment().format('LT:ss');
    // console.log((moment().add(543, 'year').format('LT')));
}

$(document).ready(function() {
  $('#example').DataTable();
  const startOfMonth = moment().format('YYYY-MM-DD');;
  const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');
  document.getElementById('start_date').value = startOfMonth;
  // document.getElementById('end_date').value = endOfMonth;
  // console.log(startOfMonth, endOfMonth)
} );

function get_data(id){
  $.post("get_data.php",
  {
    id: id,
  },
  function(data,status){
    if(status === 'success'){
      var data = JSON.parse(data);
      document.getElementById('edit_id').value = data.id;
      document.getElementById('checkin').value = data.checkin_time.split(':')[0]+":" + data.checkin_time.split(':')[1];
      document.getElementById('checkout').value = data.checkout_time.split(':')[0]+":" + data.checkout_time.split(':')[1];
      document.getElementById('note1').value = data.note1;
      document.getElementById('note2').value = data.note2;
    }
  });
};

function get_contact(id){
  console.log(id);
  $.post("get_contact.php",
  {
    id: id,
  },
  function(data,status){
    if(status === 'success'){
      var data = JSON.parse(data);
      document.getElementById('id').value = data.id;
      document.getElementById('detail').innerHTML = data.detail;
      document.getElementById('subject').innerHTML = data.subject;
      document.getElementById('reply_msg').value = data.reply_msg;
    }
  });
}