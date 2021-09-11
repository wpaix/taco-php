//----------------------------------------------------------------

Site.kravle9sere = {
    
}

//----------------------------------------------------------------

Site.kravle9sere.on_kravle9sere_requested = () => {

    anime({
        targets: '.content .inner1',
        scale: [ 1,0 ],
        rotate: [ 0, -20 ],
        duration: 1000,
        easing: 'easeInElastic',
        complete: ()=>{
            $('.content .inner1').text('Tak!')
            anime({
                targets: '.content .inner1',
                scale: [ 0,1 ],
                rotate: [ -20, 0 ],
                duration: 1000,
                easing: 'easeOutElastic',
            })
        },
    })

}

Site.kravle9sere.init = () => {
    
    anime({
        targets: '.screen-kravle9sere .centerer',
        scale: [ 0,1 ],
        duration: 2000,
        easing: 'easeOutElastic',
    })

    $('.sendbtn').click(function(){
        let input = {
            email: $('#input-email').val(),
        }    
        if( !validateEmail(input.email) ) { return Site.msg('Fejl i email') }
        
        $.post( base_url+'api/send_kravle9sere', input)
            .done(function(response){
                Site.msg('Sådan, dine kravle9sere er på vej!')                
                Site.kravle9sere.on_kravle9sere_requested()
            })
            .fail(function(response){
                Site.msg('Fejl - prøv igen.')
            }) 

    })

}

//----------------------------------------------------------------

if( $('.screen-kravle9sere').length > 0 ) Site.kravle9sere.init()

