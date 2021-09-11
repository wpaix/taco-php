
;(function () {

    var $el = $('.puzzlegame')
    if( !$el.length ) return

    var puzzleRound = 1
    var time = 0
    var started = false
    var timeoutHandle = null

    var $startButton    = $el.find('.start-button')
    var $resetButton    = $el.find('.reset-button')
    var $closeButton    = $('.game .close')

    var $timer          = $el.find('.timer-value')
    var $progress       = $el.find('.progress-value')
    var $round          = $el.find('.game-round-value')
    var $welcome        = $el.find('.welcome')
    var $success        = $el.find('.success')

    gsap.set('.puzzles, .timer, .progress', { display: 'none', autoAlpha: 0})

    function updateDocument() {
        $timer.text(time)
        $round.text(puzzleRound)
        $progress.text(puzzleRound)
    }

    function timerTick() {
        time++
        updateDocument()
    }

    function startGame() {
        started = true
        timeoutHandle = setInterval(timerTick, 1000)
        playAudio("knap_lyd.mp3", 1)
        gsap.timeline()
            .add(hideWelcome())
            .add(showPuzzle(puzzleRound))
            .add(function() { puzzle(puzzleRound) });
    }

    function stopGame() {
        clearInterval(timeoutHandle)
        started = false
    }

    function resetGame() {
        stopGame(puzzleRound)

        gsap.timeline()
            .add(hidePuzzle(puzzleRound), 0)
            .add(hideSuccess(), 0)
            .add(clearProps(), 0)
            .add(showWelcome())

        puzzleRound = 1
        time = 0

        updateDocument()
    }

    

    function puzzleCompleted(puzzleNumber) {
        if (!started) return

        var tl = gsap.timeline()
            .add(hidePuzzle(puzzleNumber))

        if (puzzleNumber < 6) {
            puzzleRound = puzzleNumber + 1
            tl.add(showPuzzle(puzzleRound))
            puzzle(puzzleRound)
        } else {
            stopGame()
            tl.add(showSuccess())
        }
    }

    function clearProps() {
        return gsap.timeline()
            .set('.puzzle .tile', {delay: 0.2, clearProps:"all"})
            .set('.puzzles, .timer, .progress', { display: 'none', autoAlpha: 0})
    }

    function showSuccess() {
        return gsap.timeline()
            .set($success, { display: "flex" })
            .to('.timer, .progress', 0.4, { autoAlpha: 0 }, "=+1") // Delay to give a chance to load
            .to($success, 0.4, { autoAlpha: 1 }, "=+1") // Delay to give a chance to load
    }

    function hideSuccess() {
        return gsap.set($success, { display: "none", autoAlpha: 0 });
    }

    function hideWelcome() {
        return gsap.timeline()
            .to($welcome,                           0.3, {autoAlpha: 0,})
            .set($welcome,                               { display: "none" })
            .set('.puzzles, .timer, .progress',          { display: 'block'}) 
            .to('.puzzles, .timer, .progress',      0.3, { autoAlpha: 1})
            
    }

    function showWelcome() {
        return gsap.timeline()
            .set($welcome, { display: "block" })
            .to($welcome, 0.5, {
                autoAlpha: 1,
            });
    }

    $startButton.on('click', startGame)
    $resetButton.on('click', resetGame)
    $closeButton.on('click', resetGame)

    // On resize => Re-Run
    $(window).resize(function () {
        if (started) {
            puzzle(puzzleRound)
        }
    });

    function $getPuzzle(number) {
        return $('.puzzle[data-round=' + number + ']')
    }

    function showPuzzle(number) {
        var $puzzle = $getPuzzle(number);

        gsap.timeline()
            .set($puzzle,        { display: 'block' })
            .to($puzzle,    0.3, { autoAlpha: 1 }, '=+1'); // Delay to give a chance to load
    }

    function hidePuzzle(number) {
        var $puzzle = $getPuzzle(number);

        gsap.set($puzzle, { display: "none", autoAlpha: 0 });
    }


    function puzzle(puzzleNumber) {
        var $puzzle = $getPuzzle(puzzleNumber);
        var $tiles = $puzzle.find(".tile");

        var rowSize = $tiles.first().height();
        var colSize = $tiles.first().width();

        var totalRows = 3;
        var totalCols = 3;

        var cells = [];

        // restart timeline
        gsap.timeline()
            .set($puzzle, { backgroundColor: "rgba(231, 175, 103, 0.31)" })
            .set($tiles, { autoAlpha: 1, scale: 1 });

        // Map cell locations to array
        for (var row = 0; row < totalRows; row++) {
            for (var col = 0; col < totalCols; col++) {
                cells.push({
                    row: row,
                    col: col,
                    x: col * colSize,
                    y: row * rowSize,
                });
            }
        }

        var container = $puzzle.get()[0];
        var listItems = Array.from($tiles.get()); // Array of elements
        var sortables = listItems.map(Sortable); // Calling Sortable(element, index) for each tile

        //----------------------------------------------------
        // SORTABLE FUNC - Run on each tile
        //----------------------------------------------------

        function Sortable(element, index) {
            var content = element.querySelector(".content");
            var order = element.getAttribute("data-order");

            var dragger = new Draggable(element, {
                onDragStart: downAction,
                onRelease: upAction,
                onDrag: dragAction,
                cursor: "inherit",
            });

            var position = {
                x: gsap.getProperty(element, "x"),
                y: gsap.getProperty(element, "y"),
            };

            // Public properties and methods
            var sortable = {
                cell: cells[index],
                dragger: dragger,
                element: element,
                index: index,
                setIndex: setIndex,
            };
            
            gsap.set(element, {
                x: sortable.cell.x,
                y: sortable.cell.y,
            });

            // SET INDEX - when done dragging
            //----------------------------------------------------
            function setIndex(index) {
                var cell = cells[index];
                //var dirty = position.x !== cell.x || position.y !== cell.y;

                sortable.cell = cell;
                sortable.index = index;

                // Don't layout if you're dragging
                if (!dragger.isDragging ) layout();

            }

            var animation = gsap.to(content, 0.3, {
                boxShadow: "rgba(0,0,0,0.2) 0px 16px 32px 0px",
                force3D: true,
                scale: 1.1,
                paused: true,
            });

            // ON DOWN FUNCT - touching/clicking tile
            //----------------------------------------------------
            function downAction() {
                animation.play();
                this.update();
            }

            // ON DRAG FUNCT - Dragging tile
            //----------------------------------------------------
            function dragAction() {

                var col = clamp(
                    Math.round(this.x / colSize),
                    0,
                    totalCols - 1
                );
                var row = clamp(
                    Math.round(this.y / rowSize),
                    0,
                    totalRows - 1
                );
                
                var cell = sortable.cell;
                var sameCol = col === cell.col;
                var sameRow = row === cell.row;

                

                // Check if position has changed
                if (!sameRow || !sameCol) {
                    // Calculate the new index
                    var index = totalCols * row + col;
                    // Update the model
                    changeIndex(sortable, index, sameRow, sameCol);
                }
            }

            // UP ACTION FUNC - Release tile
            //----------------------------------------------------

            function upAction() {
                animation.reverse();
                layout();
                check_if_won();
            }

            // LAYOUT FUNCT
            //----------------------------------------------------

            function layout() {           
                gsap.to(element, 0.3, {
                    x: sortable.cell.x,
                    y: sortable.cell.y,
                });
            }

            return sortable;
        } //Sortable()

        //----------------------------------------------------
        // CHANGE INDEX
        //----------------------------------------------------

        function changeIndex(item, to, sameRow, sameCol) {
            // Check if adjacent to new position
            
            if ((sameRow && !sameCol) || (!sameRow && sameCol)) {
                // Swap positions in array
                var temp = sortables[to];
                sortables[to] = item;
                sortables[item.index] = temp;               
            } else {
                // Change position in array
                arrayMove(sortables, item.index, to);   
            }

            // change element's position in DOM. Not always necessary.
            // sortables.forEach(function (sortable) {
            //     container.appendChild(sortable.element);
            // });

            // Set index for each sortable
            sortables.forEach(function (sortable, index) {
                sortable.setIndex(index);
            });

        }

        //----------------------------------------------------
        // CHECK IF WON
        //----------------------------------------------------

        function check_if_won() {
            var correct_tiles = 0;

            sortables.forEach(function (sortable, index) {
                var correct_index = sortable.element.getAttribute(
                    "data-order"
                );
                if (correct_index == index) correct_tiles++;
            });

            if (correct_tiles == 9) {
                // Success
                gsap.timeline({
                    delay: 0.5,
                    ease: Power4.easeInOut,
                })
                .to($puzzle, 0.4, { backgroundColor: "transparent" }, 0)
                .staggerTo(
                    $tiles, 0.5, { autoAlpha: 0, scale: 0.9 }, 0.04, "-=0.3"
                )
                .add(function () {
                    puzzleCompleted(puzzleNumber);
                });

                playAudio("success.mp3", 1);
            }
        }
    } // puzzle()

    //----------------------------------------------------
    // HELPERS
    //----------------------------------------------------

    // Changes an elements's position in array
    function arrayMove(array, from, to) {
        array.splice(to, 0, array.splice(from, 1)[0]);
    }

    // Clamps a value to a min/max
    function clamp(value, a, b) {
        return value < a ? a : value > b ? b : value;
    }

})();
