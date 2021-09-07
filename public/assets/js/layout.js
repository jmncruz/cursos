$('.bi-chevron-right').click(function(){
    $('.menu').css('display','block')
    $('.bi-gear-wide-connected').css('display','none')
    $('.bi-cash-coin').css('display','none')
    $('.bi-chevron-right').css('display','none')
    $('.bi-chevron-left').css('display','block')
})

$('.bi-chevron-left').click(function(){
    $('.menu').css('display','none')
    $('.bi-gear-wide-connected').css('display','block')
    $('.bi-cash-coin').css('display','block')
    $('.bi-chevron-right').css('display','block')
    $('.bi-chevron-left').css('display','none')
})