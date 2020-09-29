update_time();
setInterval(update_time,10000);
function update_time(){
  moment.locale('th');
    $("#show_thaidate").html(moment().add(543, 'year').format('สถานะพนักงานทั้งหมดประจำวันdddd ที่ Do MMMM YYYY เวลา LT'));
    document.getElementById('time_to_table').value = moment().format('LT:ss');
    // console.log((moment().add(543, 'year').format('LT')));
}

// $(document).ready(function() {
//   $('#example').DataTable();
//   const startOfMonth = moment().format('YYYY-MM-DD');;
//   const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');
//   document.getElementById('start_date').value = startOfMonth;
//   // document.getElementById('end_date').value = endOfMonth;
//   // console.log(startOfMonth, endOfMonth)
// } );

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
  $.post("get_contact.php",
  {
    id: id,
    user: 'admin'
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

$(document).ready(function() {
  const startOfMonth = moment().format('YYYY-MM-DD');
  const endOfMonth   = moment().endOf('month').format('YYYY-MM-DD');
  document.getElementById('start_date').value = startOfMonth;
  document.getElementById('adddate').value = startOfMonth;
  // Setup - add a text input to each footer cell
  $('#example thead tr').clone(true).appendTo( '#example thead' );
  $('#example thead tr:eq(1) th').each( function (i) {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

      $( 'input', this ).on( 'keyup change', function () {
          if ( table.column(i).search() !== this.value ) {
              table
                  .column(i)
                  .search( this.value )
                  .draw();
          }
      } );
  } );

  var table = $('#example').DataTable( {
      orderCellsTop: true,
      fixedHeader: true
  } );
} );

function get_user_data(id){
  $.post("get_user_data.php",
  {
    id: id,
  },
  function(data,status){
    if(status === 'success'){
      var data = JSON.parse(data);
      console.log(data);
      document.getElementById('usernames').value = data.username;
      document.getElementById('pnames').value = data.pname;
      document.getElementById('fnames').value = data.fname;
      document.getElementById('lnames').value = data.lname;
      document.getElementById('positions').value = data.position;
      document.getElementById('user_types').value = data.id;
      document.getElementById('emails').value = data.email;
    }
  });
};