
    const selectTyped = document.querySelector('.typed');
    if (selectTyped) {
        const typed_strings = ["I'm a Student", "I'm a Developer"]; // Your typing texts
        new Typed('.typed', {
            strings: typed_strings,
            loop: true,
            typeSpeed: 100,
            backSpeed: 50,
            backDelay: 2000, 
        });
    }
