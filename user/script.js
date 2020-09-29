update_time();
document.getElementById('time_to_table').value = moment().format('HH:MM');
setInterval(update_time,10000);
function update_time(){
  moment.locale('th');
    $("#show_thaidate").html(moment().add(543, 'year').format('วันdddd ที่ Do MMMM YYYY เวลา LT'));
    console.log((moment().add(543, 'year').format('LT')));
}

// $(document).ready(function() {
//   $('#example').DataTable();
// } );

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

function get_contact(id, user){
  console.log(id);
  $.post("../admin/get_contact.php",
  {
    id: id,
    user: user
  },
  function(data,status){
    if(status === 'success'){
      var data = JSON.parse(data);
      console.log(data);
      document.getElementById('details').innerHTML = data.detail;
      document.getElementById('subjects').innerHTML = data.subject;
      document.getElementById('reply_msg').innerHTML = data.reply_msg;
    }
  });
}

$(document).ready(function() {
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