//------------------------------------------------------------------------------
// ADMIN
//------------------------------------------------------------------------------

  $('body.is-screen-admin #save-application-btn').click(function(){
    let input = {
      application_id: parseInt($('#application_id').val()),
      rating: parseInt($('select#admin-edit-rating').val()),
      tags: $('input#tags').val(),
    }

    $.post(base_url+'api/update_application', input)
      .done(function(response){
        Site.msg('Gemt!')
        setTimeout(function(){ window.location.reload() }, 1000)
      })
      .fail(function(response){
        Site.msg('Fejl - prøv igen.')
      })

  })
  
  //------------------------------------------------------------------------------
  
  $('body.is-screen-admin #delete-application-btn').click(function(){
    
    var sure = confirm('Er du sikker?')
    if( !sure ) return
    var sure2 = confirm('Er du HELT sikker?')
    if( !sure2 ) return
    var sure3 = confirm('Du skal virkelig være sikker, for dette kan ikke gøres om.')
    if( !sure3 ) return
    var input = { application_id: $('#application_id').val(), }

    $.post(base_url+'api/delete_application', input)
      .done(function(response){
        Site.msg('Slettet!')
        setTimeout(function(){ window.location.href = base_url+'admin' }, 1000)
      })
      .fail(function(response){
        Site.msg('Fejl - prøv igen.')
      })      

  })

//------------------------------------------------------------------------------

  $('body.is-screen-admin #admin-search-tag').change(function(){
    var val = $(this).val()
    window.location.href = base_url+'/admin?search='+val
  });

//------------------------------------------------------------------------------