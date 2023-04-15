const path = require('path');

module.exports = {
    stats: {
        children: true,
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            'v@': path.resolve('resources/js/vue'),
        },
    },
};
