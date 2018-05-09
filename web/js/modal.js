/**
 * Created by Temp on 21.02.2017.
 */
var $currentTable;
var this_row;

$(document).on('ready pjax:success', function() {
    $('.modalButton').click(function(e){
        e.preventDefault(); //for prevent default behavior of <a> tag.
        var tagname = $(this)[0].tagName;
        $('#editModalId').modal('show').find('.modalContent').load($(this).attr('href'));
    });
});

function rowClick(e){
    var rowIndex;
    $currentTable = $(this).closest('tbody');
    rowIndex = $('tr', $currentTable).index( $(this).closest('tr'));
    $( $currentTable).data( 'rowIndex', rowIndex);
    $('tr', $currentTable).removeClass('selected');
    $(this).addClass('selected');
    this_row = $(this);
}

jQuery(document).ready(function($){
    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#lesson-learned-form-id", function () {
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find(".has-error").length) {
                return false;
            }
            // submit form
            $.ajax({
                url    : form.attr("action"),
                type   : "post",
                data   : form.serialize(),
                success: function (response) {
                    $("#editModalId").modal("toggle");
                    $.pjax.reload({container:"#lessons-grid-container-id"}); //for pjax update
                },
                error  : function () {
                    console.log("internal server error");
                }
            });
            return false;
        });
    });
});

function initTable(){
    var $rows = $( 'tr', this);
    $rows.on( 'click', rowClick);
    $(this).data("rowTotal", $rows.length);
}

function arrows(e){
    var rowIndex = $( $currentTable).data( 'rowIndex')
        , rowTotal = $('tbody').find('tr').length;
    if( e.keyCode == 38  &&  rowIndex > 0) {
        rowIndex--;
    } else if( e.keyCode == 40  &&  rowIndex < (rowTotal-1)) {
        rowIndex++;
    } else if( e.keyCode == 13 ) {
        var link = $('.selected').find('[title="Update"]').first();
        link.click();
        e.preventDefault();
    } else return;
    $( $currentTable).data( 'rowIndex', rowIndex);
    $('tr', $currentTable).removeClass('selected');
    $('tr', $currentTable).eq( rowIndex).addClass('selected');
}

$('table').each(initTable);
$(window).keydown(arrows);
