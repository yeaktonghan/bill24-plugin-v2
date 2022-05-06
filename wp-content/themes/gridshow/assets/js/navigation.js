/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
    var gridshow_secondary_container, gridshow_secondary_button, gridshow_secondary_menu, gridshow_secondary_links, gridshow_secondary_i, gridshow_secondary_len;

    gridshow_secondary_container = document.getElementById( 'gridshow-secondary-navigation' );
    if ( ! gridshow_secondary_container ) {
        return;
    }

    gridshow_secondary_button = gridshow_secondary_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof gridshow_secondary_button ) {
        return;
    }

    gridshow_secondary_menu = gridshow_secondary_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof gridshow_secondary_menu ) {
        gridshow_secondary_button.style.display = 'none';
        return;
    }

    gridshow_secondary_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === gridshow_secondary_menu.className.indexOf( 'nav-menu' ) ) {
        gridshow_secondary_menu.className += ' nav-menu';
    }

    gridshow_secondary_button.onclick = function() {
        if ( -1 !== gridshow_secondary_container.className.indexOf( 'gridshow-toggled' ) ) {
            gridshow_secondary_container.className = gridshow_secondary_container.className.replace( ' gridshow-toggled', '' );
            gridshow_secondary_button.setAttribute( 'aria-expanded', 'false' );
            gridshow_secondary_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            gridshow_secondary_container.className += ' gridshow-toggled';
            gridshow_secondary_button.setAttribute( 'aria-expanded', 'true' );
            gridshow_secondary_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    gridshow_secondary_links    = gridshow_secondary_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( gridshow_secondary_i = 0, gridshow_secondary_len = gridshow_secondary_links.length; gridshow_secondary_i < gridshow_secondary_len; gridshow_secondary_i++ ) {
        gridshow_secondary_links[gridshow_secondary_i].addEventListener( 'focus', gridshow_secondary_toggleFocus, true );
        gridshow_secondary_links[gridshow_secondary_i].addEventListener( 'blur', gridshow_secondary_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function gridshow_secondary_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'gridshow-focus' ) ) {
                    self.className = self.className.replace( ' gridshow-focus', '' );
                } else {
                    self.className += ' gridshow-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( gridshow_secondary_container ) {
        var touchStartFn, gridshow_secondary_i,
            parentLink = gridshow_secondary_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, gridshow_secondary_i;

                if ( ! menuItem.classList.contains( 'gridshow-focus' ) ) {
                    e.preventDefault();
                    for ( gridshow_secondary_i = 0; gridshow_secondary_i < menuItem.parentNode.children.length; ++gridshow_secondary_i ) {
                        if ( menuItem === menuItem.parentNode.children[gridshow_secondary_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[gridshow_secondary_i].classList.remove( 'gridshow-focus' );
                    }
                    menuItem.classList.add( 'gridshow-focus' );
                } else {
                    menuItem.classList.remove( 'gridshow-focus' );
                }
            };

            for ( gridshow_secondary_i = 0; gridshow_secondary_i < parentLink.length; ++gridshow_secondary_i ) {
                parentLink[gridshow_secondary_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( gridshow_secondary_container ) );
} )();


( function() {
    var gridshow_headnavi_container, gridshow_headnavi_button, gridshow_headnavi_menu, gridshow_headnavi_links, gridshow_headnavi_i, gridshow_headnavi_len;

    gridshow_headnavi_container = document.getElementById( 'gridshow-headnavi-navigation' );
    if ( ! gridshow_headnavi_container ) {
        return;
    }

    gridshow_headnavi_button = gridshow_headnavi_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof gridshow_headnavi_button ) {
        return;
    }

    gridshow_headnavi_menu = gridshow_headnavi_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof gridshow_headnavi_menu ) {
        gridshow_headnavi_button.style.display = 'none';
        return;
    }

    gridshow_headnavi_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === gridshow_headnavi_menu.className.indexOf( 'nav-menu' ) ) {
        gridshow_headnavi_menu.className += ' nav-menu';
    }

    gridshow_headnavi_button.onclick = function() {
        if ( -1 !== gridshow_headnavi_container.className.indexOf( 'gridshow-toggled' ) ) {
            gridshow_headnavi_container.className = gridshow_headnavi_container.className.replace( ' gridshow-toggled', '' );
            gridshow_headnavi_button.setAttribute( 'aria-expanded', 'false' );
            gridshow_headnavi_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            gridshow_headnavi_container.className += ' gridshow-toggled';
            gridshow_headnavi_button.setAttribute( 'aria-expanded', 'true' );
            gridshow_headnavi_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    gridshow_headnavi_links    = gridshow_headnavi_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( gridshow_headnavi_i = 0, gridshow_headnavi_len = gridshow_headnavi_links.length; gridshow_headnavi_i < gridshow_headnavi_len; gridshow_headnavi_i++ ) {
        gridshow_headnavi_links[gridshow_headnavi_i].addEventListener( 'focus', gridshow_headnavi_toggleFocus, true );
        gridshow_headnavi_links[gridshow_headnavi_i].addEventListener( 'blur', gridshow_headnavi_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function gridshow_headnavi_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'gridshow-focus' ) ) {
                    self.className = self.className.replace( ' gridshow-focus', '' );
                } else {
                    self.className += ' gridshow-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( gridshow_headnavi_container ) {
        var touchStartFn, gridshow_headnavi_i,
            parentLink = gridshow_headnavi_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, gridshow_headnavi_i;

                if ( ! menuItem.classList.contains( 'gridshow-focus' ) ) {
                    e.preventDefault();
                    for ( gridshow_headnavi_i = 0; gridshow_headnavi_i < menuItem.parentNode.children.length; ++gridshow_headnavi_i ) {
                        if ( menuItem === menuItem.parentNode.children[gridshow_headnavi_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[gridshow_headnavi_i].classList.remove( 'gridshow-focus' );
                    }
                    menuItem.classList.add( 'gridshow-focus' );
                } else {
                    menuItem.classList.remove( 'gridshow-focus' );
                }
            };

            for ( gridshow_headnavi_i = 0; gridshow_headnavi_i < parentLink.length; ++gridshow_headnavi_i ) {
                parentLink[gridshow_headnavi_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( gridshow_headnavi_container ) );
} )();













( function() {
    var gridshow_primary_container, gridshow_primary_button, gridshow_primary_menu, gridshow_primary_links, gridshow_primary_i, gridshow_primary_len;

    gridshow_primary_container = document.getElementById( 'gridshow-primary-navigation' );
    if ( ! gridshow_primary_container ) {
        return;
    }

    gridshow_primary_button = gridshow_primary_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof gridshow_primary_button ) {
        return;
    }

    gridshow_primary_menu = gridshow_primary_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof gridshow_primary_menu ) {
        gridshow_primary_button.style.display = 'none';
        return;
    }

    gridshow_primary_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === gridshow_primary_menu.className.indexOf( 'nav-menu' ) ) {
        gridshow_primary_menu.className += ' nav-menu';
    }

    gridshow_primary_button.onclick = function() {
        if ( -1 !== gridshow_primary_container.className.indexOf( 'gridshow-toggled' ) ) {
            gridshow_primary_container.className = gridshow_primary_container.className.replace( ' gridshow-toggled', '' );
            gridshow_primary_button.setAttribute( 'aria-expanded', 'false' );
            gridshow_primary_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            gridshow_primary_container.className += ' gridshow-toggled';
            gridshow_primary_button.setAttribute( 'aria-expanded', 'true' );
            gridshow_primary_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    gridshow_primary_links    = gridshow_primary_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( gridshow_primary_i = 0, gridshow_primary_len = gridshow_primary_links.length; gridshow_primary_i < gridshow_primary_len; gridshow_primary_i++ ) {
        gridshow_primary_links[gridshow_primary_i].addEventListener( 'focus', gridshow_primary_toggleFocus, true );
        gridshow_primary_links[gridshow_primary_i].addEventListener( 'blur', gridshow_primary_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function gridshow_primary_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'gridshow-focus' ) ) {
                    self.className = self.className.replace( ' gridshow-focus', '' );
                } else {
                    self.className += ' gridshow-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( gridshow_primary_container ) {
        var touchStartFn, gridshow_primary_i,
            parentLink = gridshow_primary_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, gridshow_primary_i;

                if ( ! menuItem.classList.contains( 'gridshow-focus' ) ) {
                    e.preventDefault();
                    for ( gridshow_primary_i = 0; gridshow_primary_i < menuItem.parentNode.children.length; ++gridshow_primary_i ) {
                        if ( menuItem === menuItem.parentNode.children[gridshow_primary_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[gridshow_primary_i].classList.remove( 'gridshow-focus' );
                    }
                    menuItem.classList.add( 'gridshow-focus' );
                } else {
                    menuItem.classList.remove( 'gridshow-focus' );
                }
            };

            for ( gridshow_primary_i = 0; gridshow_primary_i < parentLink.length; ++gridshow_primary_i ) {
                parentLink[gridshow_primary_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( gridshow_primary_container ) );
} )();