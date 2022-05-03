import $ from 'jquery';

class Search {
    /* 1. describe and create or initiate our object */
    constructor() {
        this.addSearchHTML();
        this.resultsDiv = $("#search-overlay__results");
        //select the magnifying glass icon
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
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
        $(document).on("keydown", this.keyPressDispatcher.bind(this));

        //when user stops typing, the function typingLogic is called
        //it waits for 2 seconds
        this.searchField.on("keyup", this.typingLogic.bind(this));

    }


    /* 3. methods (function, actions...) */

    //keyboard shurtcuts function to open and close the search overlay
    keyPressDispatcher(e) {
        //console.log(e.keyCode);
        
        //if the 's' key is pressed AND if the variable isOverlayOpen = false
        //then the search overlay will be displayed
        if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
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
        //
        this.searchField.val('');
        //puts the cursor on the search box
        setTimeout(() => this.searchField.focus(), 301);
        console.log('it works');
        this.isOverlayOpen = true;

        //this.typingTimer;
    }

    //close the search window
    closeOverlay() {
        //remove class to clos overlay
        this.searchOverlay.removeClass("search-overlay--active");

        //makes the window scroll
        $("body").removeClass("body-no-scroll");

        this.isOverlayOpen = false;
    }

    //function that waits for user to stop typing before displaying results
    typingLogic() {
        //alert('hello form the typing logic')
        
        if(this.searchField.val() != this.previousValue) {
            //clears the timer each time the user types a letter
            clearTimeout(this.typingTimer);

            if(this.searchField.val()) {
                if(!this.isSpinnerVisible) {
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
    
                //timeout timer that will get executed when 2 seconds have passed
                //after the user have stopped typing
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            }
            else {
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }

            
        }
        
        this.previousValue = this.searchField.val();
    }

    //function that gets the result of the search
    //we want this to iterate through multiple posts, pages
    getResults() {
        $.when($.getJSON(universityData.root_url + '/wp-json/wp/v2/posts?search=' + this.searchField.val()), 
        $.getJSON(universityData.root_url + '/wp-json/wp/v2/pages?search=' + this.searchField.val())
        ).then((posts, pages) => {
            //concatenates all incoming data that was retrived from the JSON file
            //we add the [0] so we only get the JSON information that we will need
            var combinedResults = posts[0].concat(pages);
            //access the data of the json file and display it
            //this also displays all the result of the query
            this.resultsDiv.html(`
                <h2 class="search-overlay__section-title">General Information</h2>
                ${combinedResults.length ? '<ul class="link-list min-list">' : '<p>No general inormation matched that search.</p>'}
                    ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
                ${combinedResults.length ? '</ul>' : ''}
            `);

            this.isSpinnerVisible = false;
        });

    }

    addSearchHTML() {
        $("body").append(`
        <div class="search-overlay">
            <div class="search-overlay__top">
                <div class="container">
                    <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                    <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term" autocomplete="off">
                    <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                </div>
            </div>
            <div class="container">
                <div id="search-overlay__results"></div>
            </div>
        </div>
        `)
    }
    
}

//export this js file to index.js
export default Search;