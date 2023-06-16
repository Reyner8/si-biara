$(document).ready(function () {
    $('#datatable').DataTable();
});



let i = 0;
const editPembinaan =  document.querySelectorAll('.editPembinaan');
const editPenugasan =  document.querySelectorAll('.editPenugasan');

editPenugasan.forEach(function(node) {
    i++
    let newID = `editPenugasan-${i}`;
    node.setAttribute('id', newID);
    ClassicEditor
            .create( document.querySelector( `#${newID}` ) )
            .catch( error => {
                console.error( error );
    } );
});

editPembinaan.forEach(function(node) {
    i++
    let newID = `editPembinaan-${i}`;
    node.setAttribute('id', newID);
    ClassicEditor
            .create( document.querySelector( `#${newID}` ) )
            .catch( error => {
                console.error( error );
    } );
});

ClassicEditor
        .create( document.querySelector( '#textarea' ) )
        .catch( error => {
            console.error( error );
} );

ClassicEditor
        .create( document.querySelector( '#textarea1' ) )
        .catch( error => {
            console.error( error );
} );

ClassicEditor
        .create( document.querySelector( '#textarea2' ) )
        .catch( error => {
            console.error( error );
} );


ClassicEditor
        .create( document.querySelector( '#tambahpembinaan' ) )
        .catch( error => {
            console.error( error );
} );

ClassicEditor
        .create( document.querySelector( '#tambahpenugasan' ) )
        .catch( error => {
            console.error( error );
} );
