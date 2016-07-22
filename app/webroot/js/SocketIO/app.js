//var io = require('socket.io').listen(8000);
var io = require('socket.io').listen(8000,function(){
    io.log.info('============== WELCOME to SOCKETIO ======================');
    io.log.info('SocketIO Server Running on '+io.server._connectionKey);
    io.log.info('=========================================================');
    console.log('\n');
});
io.sockets.on('connection', function (socket) {
  socket.on('new_connect', function (data) {
    io.log.debug(data);
  });
      
  socket.on('announcment', function (data) {
    socket.broadcast.emit('announcment', data);
    io.log.debug(data);
  });

/*
 * New Post Socket Notification
 *
**/
  socket.on('new_post', function (data) {
    socket.broadcast.emit('new_post', data);
    io.log.debug(data);
  });
});
