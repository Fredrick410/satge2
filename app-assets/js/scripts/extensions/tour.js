/*=========================================================================================
	File Name: ext-component-tour.js
	Description: extra component tour for webpage guide
	----------------------------------------------------------------------------------------
	Item Name: Frest HTML Admin Template
	Version: 1.0
	Author: Pixinvent
	Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/





$(document).ready(function() {
    // tour initialize
    displayTour();
    $(window).resize(displayTour)
    var tour1 = new Shepherd.Tour({
        classes: 'shadow-md bg-purple-dark',
        scrollTo: true
    })

    // tour step 1
    tour1.addStep('step-1', {
        text: 'Here is page title.',
        attachTo: '.main-menu bottom',
        buttons: [

            {
                text: "Skip",
                action: tour1.complete
            },
            {
                text: 'Next',
                action: tour1.next
            },
        ]
    });
    // tour step 2
    tour1.addStep('step-2', {
        text: 'Check your notifications from here.',
        attachTo: '.dropdown-notification .bx-bell bottom',
        buttons: [

            {
                text: "Skip",
                action: tour1.complete
            },

            {
                text: "previous",
                action: tour1.back
            },
            {
                text: 'Next',
                action: tour1.next
            },
        ]
    });
    // tour step 3
    tour1.addStep('step-3', {
        text: 'Click here for user options.',
        attachTo: '.dropdown-user-link img bottom',
        buttons: [

            {
                text: "Skip",
                action: tour1.complete
            },

            {
                text: "previous",
                action: tour1.back
            },
            {
                text: 'Next',
                action: tour1.next
            },
        ]
    });
    // tour step 4
    tour1.addStep('step-4', {
        text: 'Buy this awesomeness at affordable price!',
        attachTo: '.nav-item .menu-title bottom',
        buttons: [

            {
                text: "previous",
                action: tour1.back
            },

            {
                text: "Finish",
                action: tour1.complete
            },
        ]
    });

    // function to remove tour on small screen
    function displayTour() {
        window.resizeEvt;
        if ($(window).width() > 576) {
            $('#tour').on("click", function() {
                clearTimeout(window.resizeEvt);
                tour1.start();
            })
        } else {
            $('#tour').on("click", function() {
                clearTimeout(window.resizeEvt);
                tour.cancel()
                window.resizeEvt = setTimeout(function() {
                    alert("Tour only works for large screens!");
                }, 250);;
            })
        }
    }
});