$('.delete').click(function(){
    let split_id = $(this).attr('id').split('-');
    let fild_id = split_id[1];

    $.ajax({
        url: '/admin/courses/delete',
        type: 'GET',
        data: {
            id: fild_id
        },
        dataType: 'JSON',

        success: function(data){
            console.log(data);
            window.location.href = "/admin/courses/show";
        }
    });
    return false;

})

$('.blur').blur(function(){

    let split_id = $(this).attr('id').split('-');
    let fild_name = split_id[0];
    let fild_id = split_id[1];
    let value = $(this).text(); 

    $.ajax({
        url: '/admin/courses/update',
        type: 'GET',
        data: {
            field: fild_name,
            value: value,
            id: fild_id
        },
        dataType: 'JSON',

        success: function(data){
            console.log(data);
        }
    });
    return false;

})
$('.new-course').click(function(){
    value = $('.input').val();
    
    $.ajax({
        url: '/admin/courses/storage',
        type: 'GET',
        data: {
            value: value,
        },
        dataType: 'JSON',

        success: function(data){
            console.log(data);
            window.location.href = "/admin/courses/show";
        }
    });
    return false;

})
