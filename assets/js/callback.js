function do_the_sum(){
  $('#flex1 tr').last().after('<tr style="background:#e8e8e8"><td colspan="2"><div class="text-right"><b>Total : </b></div></td><td><div class="text-right"><b>' + sumOfColumns($('#flex1 tbody'), 3) + '</b></div></td><td>&nbsp;</td></tr>');
}


function sumOfColumns(table, columnIndex) {
    var tot = 0;
    table.find("tr").children("td:nth-child(" + columnIndex + ")")
    .each(function() {
        $this = $(this);
        if (!$this.hasClass("sum") && $this.text() != "") {
         //http://stackoverflow.com/questions/559112/how-to-convert-a-currency-string-to-a-double-with-jquery-or-javascript
          if($.isNumeric(Number($this.text().replace(/[^0-9-\,]+/g,""))))
              tot += parseInt(Number($this.text().replace(/[^0-9-\,]+/g,"")));
        }
    });
    return tot;
}
/*
function do_the_sum_ap(){
  $('#flex1 tr').last().after('<tr><td colspan="2" style="background:#e8e8e8"><div class="text-right"><b>Jumlah Terselesaikan : </b></div></td><td><div class="text-left"><b>' + sumOfColumns($('#flex1 tbody'), 3) + '</b></div></td><td>&nbsp;</td></tr><tr><td colspan="3" style="background:#e8e8e8"><div class="text-right"><b>Total Biaya Jasa : </b></div></td><td><div class="text-right"><b>Rp.' + sumOfColumns($('#flex1 tbody'), 4) + '</b></div></td><td>&nbsp;</td></tr>');
}
function print_message() {
  console.log("Yes i got called in");
  alert("This is a test callback");

}
*/
