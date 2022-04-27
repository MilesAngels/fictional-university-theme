import $ from 'jquery';

class Search {
    /* 1. describe and create or initiate our object */
    constructor() {
        //select the magnifying glass icon
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.events();
        this.isOverlayOpen = false;
    }


    /* 2. events */
    events() {
    
        //.bind() allows an object to borrow a method from another object

        //open overlay
        this.openButton.on("click", this.openOverlay.bind(this));

        //close overlay
        this.closeButton.on("click", this.closeOverlay.bind(this));

        //when user presses down either the 's' key or the 'esc' key,
        //we need to call the function keyPressDispatcher to open or
        //close the search overlay
        $(document).on("keydown", this.keyPressDispatcher.bind(this))

    }


    /* 3. methods (function, actions...) */

    //keyboard shurtcuts function to open and close the search overlay
    keyPressDispatcher(e) {
        //console.log(e.keyCode);
        
        //if the 's' key is pressed AND if the variable isOverlayOpen = false
        //then the search overlay will be displayed
        if (e.keyCode == 83 && !this.isOverlayOpen) {
            this.openOverlay();    
        }

        //if the 'esc' key is pressed AND if the variable isOverlayOpen = true
        //then the search overlay will be closed
        if (e.keyCode == 27 && this.isOverlayOpen) {
            this.closeOverlay();
        }
    }

    //open the search window
    openOverlay() {
        //add class tro open the overlay
        this.searchOverlay.addClass("search-overlay--active");

        //prevents the window from scrolling
        $("body").addClass("body-no-scroll");

        this.isOverlayOpen = true;
    }

    //close the search window
    closeOverlay() {
        //remove class to clos overlay
        this.searchOverlay.removeClass("search-overlay--active");

        //makes the window scroll
        $("body").removeClass("body-no-scroll");

        this.isOverlayOpen = false;
    }
}

//export this js file to index.js
export default Search;