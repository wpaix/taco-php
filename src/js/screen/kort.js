//----------------------------------------------------------------

Site.kort = {
    videofile_max_bytes: ( 1 * 1000000 ), // 1 mb
}

//----------------------------------------------------------------

Site.kort.upload_ready = () => {
    if( !window.videofile ) return false
    if( !window.videofile_datastring ) return false
    if( !validateString($('#input-fullname').val()) ) return false
    if( !validateEmail($('#input-email').val()) ) return false
    return true
}

//----------------------------------------------------------------

Site.kort.init = () => {

    $('.videobtn').click(()=>{
        $('#input-file').trigger('click')
    })

    $('#input-file').change(function(){
        let videofile = $('#input-file')[0].files[0]
        if( videofile.size > Site.kort.videofile_max_bytes ) {
            Site.msg('Den fil er desværre lidt for stor, den må max være '+(Site.kort.videofile_max_bytes/1000000).toFixed(1)+' mb, og din fil fylder '+(videofile.size/1000000).toFixed(1)+' mb.')
            return
        }
        window.videofile = videofile
        console.log(videofile)
        let fileReader = new FileReader()
        fileReader.onload = (e) => {
            window.videofile_datastring = fileReader.result
            $('.videofile-info .filename').text(videofile.name)
            $('.videofile-info').removeClass('hide')
            $('.videobtn').addClass('hide')
            $('#preview-video-source')[0].src = fileReader.result
            $('#preview-video')[0].load()
        }
        fileReader.readAsDataURL(videofile)
    })

    $('.videofile-info .clearbtn').click(function(){
        if( !confirm('Er du sikker på at du ønsker at fjerne videofilen?') ) return
        window.videofile = undefined
        window.videofile_datastring = undefined
        $('.videofile-info .filename').text('')
        $('.videofile-info').addClass('hide')
        $('.videobtn').removeClass('hide')
    })
    
    $('.gobtn').click(()=>{
        //$('.step1').addClass('hide')
        //$('.step2').removeClass('hide')
        $('.step1').fadeOut(100)
        setTimeout(()=>{ $('.step2').fadeIn(100) },110)
    })

    $('.checkboxer .box').click(function(e){
        $(this).parent('.checkboxer').toggleClass('active')
    })

    $('#terms1 .link').click((e)=>{
        $('#site-legals-1').addClass('active')
    })
    
    $('#terms2 .link').click(()=>{
        $('#site-legals-2').addClass('active')
    })
    
    $('.sendbtn').click(function(){
        if( !window.videofile || !window.videofile_datastring ) { return Site.msg('Du mangler at uploade din video!') }
        
        let input = {
            fullname: $('#input-fullname').val(),
            email: $('#input-email').val(),
            videofile_filename: window.videofile.name,
            videofile_filetype: window.videofile.type,
            video_datastring: window.videofile_datastring,
        }    

        if( !validateString(input.fullname) ) { return Site.msg('Fejl i navn') }
        if( !validateEmail(input.email) ) { return Site.msg('Fejl i email') }
        if( !$('#terms1').hasClass('active') ) { return Site.msg('Fejl i terms 1') }
        if( !$('#terms2').hasClass('active') ) { return Site.msg('Fejl i terms 2') }

        $.post( base_url+'api/submit_application', input)
            .done(function(response){
                Site.msg('Sådan!')
                $('.step2').fadeOut(500)
                setTimeout(()=>{ $('.step3').fadeIn(500) },600)
            })
            .fail(function(response){
                Site.msg('Fejl - prøv igen.')
            }) 
    })

}

//----------------------------------------------------------------

if( $('.screen-kort').length > 0 ) Site.kort.init()
