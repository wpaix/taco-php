//----------------------------------------------------------------

Site.nisernavn = {
    names: [ 'Flemming', 'Torben', 'Torsten', 'Gert', 'Ulrik', 'Hans', 'Ejnar', 'Jimmy', 'Tommy', 'Brian', 'John', 'Peder', 'Jan', 'Poul', 'Dan', 'Henrik', 'Lars', 'Anders', 'Dennis', 'Michael', 'Steffen', 'Bjarne', 'Arno', 'Leif', 'Klaus', 'Allan', 'Ditlev', 'Ejvind', 'Kenneth', 'René', 'Jannick', 'Morten', 'Dario', 'Jørgen', 'Mussa', 'Niels', 'Per', 'Preben', 'Karsten', 'Steen', 'Richardt', 'Harald', 'Mogens', 'Arne', 'Birger', 'Thorkild', 'Dirch', 'Charles', 'Bent', 'Bengt', 'Bernard ', 'Boris', 'Jim', 'Kenny', 'Ib', 'Ove', 'Glenn', 'Jes', 'Johnny', 'Kjeld ', 'Heino', 'Mustafa ', 'Troels', 'Vagn', 'Henning', 'Olav', 'Søren', 'Åge', 'Leif ', 'Birger', 'Kim', 'Hans', 'Torvald', 'Jesper', 'Erling', 'Heino', 'Chresten', 'Joakim', 'Bjarke', 'Johan', 'Lennart', 'Claes', 'Helge', 'Dikael', 'Morten Brian', 'Mark Flemming', 'Sune', 'Frank', 'Tom', 'Stig', 'Gunnar', 'Mik', 'Mike', 'Nick', 'Andreas', 'Leonardo', 'Kenn', 'Jørn', 'Belinda', 'Bolette', 'Marianne', 'Ulla', 'Birgitte', 'Inge', 'Tina', 'Heidi', 'Birthe', 'Hanne', 'Dorte', 'Grethe', 'Else', 'Tove', 'Bente ', 'Lis', 'Jette', 'Birgit', 'Pia', 'Jeanette', 'Stine', 'Mette', 'Janni', 'Malene', 'Gitte', 'Jessica', 'Lene', 'Lena', 'Kira', 'Karina', 'Jytte', 'Jonna', 'Ragnhild', 'Bodil', 'Carina', 'Connie', 'Lonnie', 'Birte', 'Inger', 'Stephanie', 'Glennie', 'Gerda', 'Lizette', 'Lisanette', 'Helle', 'Susanne', 'Gitte', 'Natascha', 'Dorthe', 'Sabine', 'Vivian', 'Charlotte', 'Christina', 'Betina', 'Trine', 'Sanne', 'Linette', 'Anette', 'Dorthe', 'Ann-bet', 'Britt', 'Britta', 'Yvonne', 'Marian', 'Marion', 'Tanja', 'Sascha', 'Vivi', 'Vicky', 'Sabrina', 'Shila', 'Sanja', 'Camilla', 'Lone', 'Sandra', 'Anastacia', 'Alice', 'Cindie', 'Jasmin', 'Katja', 'Dorit', 'Alberte', 'Jessica', 'Laila', 'Vibeke', 'Jutta', 'Lotte', 'Tove', 'Pernille', 'Gurli', 'Margrethe', 'Gudrun', 'Gitta', 'Bonnie', 'Minna', 'Hanne', 'Diana', 'Kis' ],
    letter: undefined,
    sign: undefined,
}

//----------------------------------------------------------------

Site.nisernavn.generateName = ( letter, sign ) => {
    let index = letter * sign
    console.log('index',index)
    let names = rotateArray(Site.nisernavn.names, index)
    return names[0]
}

Site.nisernavn.render = () => {
    
    
    if(  Site.nisernavn.letter !== undefined ) $('.inputter-letter .visual').text( $('.screen-9sernavn #input-letter').find('option:selected').text() )
    if(  Site.nisernavn.sign !== undefined ) $('.inputter-sign .visual').text( $('.screen-9sernavn #input-sign').find('option:selected').text() )

    var ready = ( Site.nisernavn.letter !== undefined && Site.nisernavn.sign !== undefined )
    $('.namebox').toggleClass('hide',!ready)
    if( ready ) {
        var name = Site.nisernavn.generateName( Site.nisernavn.letter, Site.nisernavn.sign )
        $('.namebox .name').text(name)
    }
}

//----------------------------------------------------------------

Site.nisernavn.init = () => {
    
    $('.screen-9sernavn #input-letter').change(function(){
        Site.nisernavn.letter = $(this).val()
        Site.nisernavn.render()
    })
    
    $('.screen-9sernavn #input-sign').change(function(){ 
        Site.nisernavn.sign = $(this).val()
        Site.nisernavn.render()
    })

    $('.inputter-letter .visual').click(()=>{ $('select#input-letter').focus() })
    $('.inputter-sign .visual').click(()=>{ $('select#input-sign').focus() })

}

//----------------------------------------------------------------

if( $('.screen-9sernavn').length > 0 ) Site.nisernavn.init()
