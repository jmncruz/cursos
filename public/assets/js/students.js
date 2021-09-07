$('#cep').change(function(){
    cep = $('#cep').val();
    console.log(cep)
    $.ajax({
        url: 'https://serviceweb.aix.com.br/aixapi/api/cep/'+cep,
        type: 'GET',
        data: {
            value: cep,
        },
        dataType: 'JSON',

        success: function(data){
            $('#bairro').val(data.bairro)
            $('#cidade').val(data.cidade)
            $('#estado').val(data.estado)
            $('#logradouro').val(data.logradouro)
            console.log(data);
        }
    });
    return false;

})

$('button').click(function(){
    let id = $('#search-id').val()

    $.ajax({
        url: '/admin/students/show/'+id,
        type: 'GET',
        data: {
            value: id,
        },
        dataType: 'JSON',

        success: function(data){
            $('.empty').empty()
            let photo = data.img_path;
            console.log(photo.replace('public', 'storage'))
            $('.empty').append('<tr><td>'+data.id+'</td><td><img src="/'+photo.replace('public', 'storage')+'" alt="Photo"/></td><td>'+data.status+'</td><td>'+data.name+'</td><td>'+data.courses+'</td><td>'+data.created_at+'</td><td>'+data.updated_at+'</td><td>Em Breve</td></tr>')
            console.log(data)
        }
    });
    return false;

})
$('.delete').click(function(){
    let split_id = $(this).attr('id').split('-');
    let fild_id = split_id[1];

    $.ajax({
        url: '/admin/students/delete',
        type: 'GET',
        data: {
            id: fild_id
        },
        dataType: 'JSON',

        success: function(data){
            console.log(data);
            window.location.href = "/admin/students/show";
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
        url: '/admin/students/update',
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
