var express = require('express');
var app = express();
var cors = require('cors');
var http = require('http').Server(app);
var io = require('socket.io')(http);
var open = require('open');
var bodyParser = require('body-parser');

app.use(bodyParser.json()); // for parsing application/json
app.use(express.static(__dirname + '/front/dist'));
app.use(cors());

app.post('/new-message', function (req, res) {
    console.log("Message received");

    emitMessage(req.body.channel, req.body.data);
    res.json({"success": true});
});

http.listen(3000, function(){
    console.log('Laravel Debugger listening on *:3000');
    open('http://localhost:3000');
});

function emitMessage(channel, message){
    io.emit(channel, message);
    console.log('Message emitted to channel: ' + channel);
}