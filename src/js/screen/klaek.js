//----------------------------------------------------------------

Site.klaek = {
    activeEggIndex: undefined,
    eggs: [
        { val:1,valmax:10, },
        { val:1,valmax:10, },
        { val:1,valmax:10, },
        { val:1,valmax:10, },
        { val:1,valmax:10, },
        { val:1,valmax:20, },
    ],
}

//----------------------------------------------------------------

Site.klaek.tapEgg = (index) => {
    let egg = Site.klaek.eggs[index-1]
    if(!egg) return
    egg.val++
    if( egg.val > egg.valmax ) egg.val = egg.valmax

    $('.eggs .egg.num'+index).find('.img .count').text(egg.val)
    $('.egg-single.num'+index).find('.img .count').text(egg.val)
    // update IMG
}

Site.klaek.openEgg = (index) => {
    Site.klaek.activeEggIndex = index
    let $t = $('.egg-single.num'+index)
    $t.addClass('active')
    $('.egg-single').not($t).removeClass('active')
}

Site.klaek.closeEgg = () => {
    // animate egg single out to its .eggs .egg.eq(activeEggIndex) position
    // remove it
    // enable all the other eggs (class)
    Site.klaek.activeEggIndex = undefined
    $('.egg-single').removeClass('active')
    $('.eggs').addClass('active')
}

//----------------------------------------------------------------

Site.klaek.init = () => {

    $('.eggs .egg').click(function(){
        Site.klaek.activeEggIndex = $(this).index()+1
        Site.klaek.openEgg(Site.klaek.activeEggIndex)
    })
    
    $('.egg-single .img').click(function(){
        Site.klaek.tapEgg(Site.klaek.activeEggIndex)
    })
    
    $('.egg-single .dim').click(function(){
        Site.klaek.closeEgg()
    })
    $('.egg-single .close').click(function(){
        Site.klaek.closeEgg()
    })

    $('.resetbtn').click(function(){
        for( let index in Site.klaek.eggs ) {
            Site.klaek.eggs[index].val = 1
            let num = (1+parseInt(index))
            $('.eggs .egg.num'+num).find('.img .count').text('1')
            $('.egg-single.num'+num).find('.img .count').text('1')
            // update IMG
        }
    })
}

//----------------------------------------------------------------

if( $('.screen-klaek').length > 0 ) Site.klaek.init()
