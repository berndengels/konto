try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {
    console.error(e);
}
