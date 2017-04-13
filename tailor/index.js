// SOURCE: https://github.com/zalando/tailor/blob/master/examples/basic-css-and-js/index.js
 
'use strict';

const http = require('http');

const Tailor = require('node-tailor');

const tailor = new Tailor({
    templatesPath: __dirname + '/templates/'
});

// Root Server
http.createServer(function (req, res) {
    if (req.url === '/favicon.ico') {
        res.writeHead(200, { 'Content-Type': 'image/x-icon' } );
        return res.end('');
    }

    tailor.requestHandler(req, res);
}).listen(3000, function () {
    console.log('Tailor server listening on port 3000');
});