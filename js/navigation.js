(function () {
    const siteNavigation = document.getElementById('site-navigation');

    // Return early if the navigation doesn't exist.
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.querySelector('.emg-menu-toggle');
    const menu = siteNavigation.querySelector('.emg-menu');

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    if (!menu.classList.contains('nav-menu')) {
        menu.classList.add('nav-menu');
    }

    // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
    button.addEventListener('click', function () {
        siteNavigation.classList.toggle('toggled');
        const isExpanded = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
        menu.style.display = isExpanded ? 'none' : 'block'; // Toggle menu visibility
    });

    // Hide menu items initially on mobile
    if (window.innerWidth <= 768) {
        menu.style.display = 'none';
    }

    // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
    document.addEventListener('click', function (event) {
        const isClickInside = siteNavigation.contains(event.target);

        if (!isClickInside) {
            siteNavigation.classList.remove('toggled');
            button.setAttribute('aria-expanded', 'false');
            menu.style.display = 'none'; // Hide the menu
        }
    });

    // Get all the link elements within the menu.
    const links = menu.getElementsByTagName('a');

    // Get all the link elements with children within the menu.
    const linksWithChildren = menu.querySelectorAll(
        '.menu-item-has-children > a, .page_item_has_children > a'
    );

    // Toggle focus each time a menu link is focused or blurred.
    for (const link of links) {
        link.addEventListener('focus', toggleFocus, true);
        link.addEventListener('blur', toggleFocus, true);
    }

    // Toggle focus each time a menu link with children receives a touch event.
    for (const link of linksWithChildren) {
        link.addEventListener('touchstart', toggleFocus, false);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        if (event.type === 'focus' || event.type === 'blur') {
            let self = this;
            // Move up through the ancestors of the current link until we hit .nav-menu.
            while (!self.classList.contains('nav-menu')) {
                // On li elements toggle the class .focus.
                if ('li' === self.tagName.toLowerCase()) {
                    self.classList.toggle('focus');
                }
                self = self.parentNode;
            }
        }

        if (event.type === 'touchstart') {
            const menuItem = this.parentNode;
            event.preventDefault();
            for (const link of menuItem.parentNode.children) {
                if (menuItem !== link) {
                    link.classList.remove('focus');
                }
            }
            menuItem.classList.toggle('focus');
        }
    }
    var linkClicked = document.querySelectorAll('.emg-menu li a');
    var arrayFromSpread = [...linkClicked];

    console.log('first link clicked', arrayFromSpread);
    var numClass = arrayFromSpread.length;
    console.log(numClass);

    for (var i = 0; i < numClass; i++) {
        arrayFromSpread[i].addEventListener(
            'click',

            function (event) {
                // Remove "active" class from all links
                arrayFromSpread[i].classList.add('active');
                // Add "active" class to the clicked link
                // this.classList.add('active');

                // Prevent the default behavior of the link (e.g., navigating to a new page)
            },
            false
        );
    }
})();
