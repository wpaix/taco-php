if( $('.tv2play-btn').length > 0) {

    $('.tv2play-btn').on('click', function(){
        var $that = $(this)
        playAudio('click.mp3')
        $that.addClass('active')

        setTimeout( function(){
            $that.removeClass('active')
        }, 200)
        setTimeout( function(){
            window.open('https://play.tv2.dk/info/juleoensket?cid=eks:9042459432', '_blank');
        }, 300)

        
    })
}
