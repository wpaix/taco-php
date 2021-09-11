//----------------------------------------------------------------

Site.teleportering = {    
    items: [
        { key:'a', teleported:false, hint_text: 'Dette er clue tekst A', },
        { key:'b', teleported:false, hint_text: 'Dette er clue tekst B', },
        { key:'c', teleported:false, hint_text: 'Dette er clue tekst C', },
        { key:'d', teleported:false, hint_text: 'Dette er clue tekst D', },
        { key:'e', teleported:false, hint_text: 'Dette er clue tekst E', },
        { key:'f', teleported:false, hint_text: 'Dette er clue tekst F', },
    ],
    secondsElapsed: 0,
    secondsElapsedTotal: 0,
    round: 0,
}

//----------------------------------------------------------------

Site.teleportering.getItemByKey = (key) => { for( let i in Site.teleportering.items ) if( Site.teleportering.items[i].key === key ) return Site.teleportering.items[i] }
Site.teleportering.getItemByIndex = (index) => { return Site.teleportering.items[index] }

//----------------------------------------------------------------

Site.teleportering.getNextTeleportableItem = () => {
    for( let i in Site.teleportering.items ) if( !Site.teleportering.items[i].teleported ) return Site.teleportering.items[i]
}

Site.teleportering.resetItems = () => {
    for( let i in Site.teleportering.items ) Site.teleportering.items[i].teleported = false
    Site.teleportering.items = shuffleArray(Site.teleportering.items)
    $('.dragzone .items .item').remove()
}

//----------------------------------------------------------------

Site.teleportering.markItemTeleported = (key) => {
    let item = Site.teleportering.getItemByKey(key)
    item.teleported = true
}

Site.teleportering.nextRound = () => {
    Site.teleportering.round++
    $('.round span').text(Site.teleportering.round)
    Site.teleportering.resetItems()
    Site.teleportering.addItemElements()
    Site.teleportering.update_hint_text()
}

//----------------------------------------------------------------

Site.teleportering.addItemElements = () => {
    for( let i in Site.teleportering.items ) {
        let item = Site.teleportering.items[i]
        //console.log(item)
        $('.dragzone .items').append('<div class="item item-'+item.key+' draggable" data-key="'+item.key+'"></div>')
    }
}

//----------------------------------------------------------------

Site.teleportering.update_hint_text = () => {
    let item = Site.teleportering.getNextTeleportableItem()
    if( !item ) $('.hinter').addClass('hide')
    if(  item ) $('.hinter').text(item.hint_text).removeClass('hide')
}

//----------------------------------------------------------------

Site.teleportering.counter_start = () => {
    Site.teleportering.counter_interval = setInterval(()=>{
        Site.teleportering.secondsElapsed++
        Site.teleportering.secondsElapsedTotal++
        $('.time-counter .r span').text(Site.teleportering.secondsElapsed)
        $('.time-counter .t span').text(Site.teleportering.secondsElapsedTotal)
    }, 1000)
}

Site.teleportering.counter_stop = () => {
    clearInterval(Site.teleportering.counter_interval)
}

//----------------------------------------------------------------

// docs/guide: https://interactjs.io/

Site.teleportering.setup_dnd = () => {
    
    window.dragMoveListener = (event) => {
        let target = event.target
        // keep the dragged position in the data-x/data-y attributes
        let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
        let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

        // translate the element
        target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'

        // update the posiion attributes
        target.setAttribute('data-x', x)
        target.setAttribute('data-y', y)
    }

    window.dragEndListener = (event) => {
    }

    interact('.draggable').draggable({
        inertia: true,
        modifiers: [
            interact.modifiers.restrictRect({ restriction: '.dragzone', endOnly: true })
        ],
        autoScroll: false,
        listeners: {
            move:window.dragMoveListener,
            end:window.dragEndListener,
        },
    })

    

    
    interact('.dropzone').dropzone({
        accept: '.item',   // only accept elements matching this CSS selector
        overlap: 0.75,   // Require a 75% element overlap for a drop to be possible
        ondragenter: function (event) {
            var draggableElement = event.relatedTarget
            var dropzoneElement = event.target
        
            // feedback the possibility of a drop
            dropzoneElement.classList.add('drop-target')
            draggableElement.classList.add('can-drop')
            //draggableElement.textContent = 'Dragged in'
        },
        ondragleave: function (event) {
            // remove the drop feedback style
            event.target.classList.remove('drop-target')
            event.relatedTarget.classList.remove('can-drop')
            //event.relatedTarget.textContent = 'Dragged out'
        },
        ondropactivate: function (event) {
            // add active dropzone feedback
            event.target.classList.add('drop-active')
        },
        ondropdeactivate: function (event) {
            // remove active dropzone feedback
            event.target.classList.remove('drop-active')
            event.target.classList.remove('drop-target')
        },
        ondrop: function (event) {
            //event.relatedTarget.textContent = 'Dropped'
            //console.log('item dropped in')
            let $item = $(event.relatedTarget)
            let key = $item.attr('data-key')

            let is_correct_item = ( key === Site.teleportering.getNextTeleportableItem().key )

            if( !is_correct_item ) {
                Site.msg('Forkert')
                return
            }

            if( is_correct_item ) {
                $item.addClass('is-dropped')
                Site.teleportering.markItemTeleported(key)
                Site.teleportering.update_hint_text()
                
                let all_teleported = ( !Site.teleportering.getNextTeleportableItem() )
                if( all_teleported ) {

                    let was_final_round = ( Site.teleportering.round == 5 )
                    let round_seconds_elapsed = Site.teleportering.secondsElapsed

                    Site.teleportering.counter_stop()
                    Site.teleportering.secondsElapsed = 0

                    if(!was_final_round) {
                        Site.msg('Sådan - du klarede runden på '+round_seconds_elapsed+' sekunder')
                        Site.teleportering.nextRound()
                        Site.teleportering.counter_start()
                        return
                    }
                    
                    if(was_final_round) {
                        Site.msg('Bum bum - du klarede alle 5 runder på '+Site.teleportering.secondsElapsedTotal+' sekunder')
                        return
                    }

                }
                //Site.msg('Yes, korrekt')
            }

        },
    })
}

//----------------------------------------------------------------

Site.teleportering.init = () => {
    
    Site.teleportering.setup_dnd()
    Site.teleportering.nextRound()
    Site.teleportering.counter_start()

}

//----------------------------------------------------------------

if( $('.screen-teleportering').length > 0 ) Site.teleportering.init()
