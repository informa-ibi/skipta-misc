/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var config = require('RiteChat');
var cluster = require('cluster');
var numCPUs = require('os').cpus().length;
 
if (cluster.isMaster) {
  // Fork workers.
  require('os').cpus().forEach(function(){
    cluster.fork();
  });
  // In case the worker dies!
  cluster.on('exit', function(worker, code, signal) {
    console.log('worker ' + worker.process.pid + ' died');
  });
  // As workers come up.
  cluster.on('listening', function(worker, address) {
    console.log("A worker with #"+worker.id+" is now connected to " +address.address + ":" + address.port);
  });
  cluster.on('online', function(worker) {
  console.log("Yay, the worker responded after it was forked");
});
  // When the master gets a msg from the worker increment the request count.
  var reqCount = 0;
  Object.keys(cluster.workers).forEach(function(id) {
    cluster.workers[id].on('message',function(msg){
      if(msg.info && msg.info == 'ReqServMaster'){
        reqCount += 1;
      }
    });
  });
  // Track the number of request served.
  setInterval(function() {
    //console.log("Number of request served = ",reqCount);
  }, 1000);
 
} else {

var fs = require('fs');



var app = require('http').createServer()
  , io = require('socket.io').listen(app);

app.listen(config.notificationPort);

//for testing
function handler (req, res) {
      res.writeHead(200);
    res.end("welcome to RiteAid notification service\n");
}

//production settings
//io.enable('browser client minification');  // send minified client
//io.enable('browser client etag');          // apply etag caching logic based on version number
//io.enable('browser client gzip');          // gzip the file
//io.set('log level', 3);                              // reduce logging
//io.set('match origin protocol', 'true');


process.on('uncaughtException', function (err) { // handling exceptions here...
  console.log("=====Exception occurred====="+err);
});


var spawn = require('child_process').spawn;
var exec = require('child_process').exec;
var servedhostname = 'localhost';
var socketType = '';
var dir=config.dir;
process.on('uncaughtException', function (err) { // handling exceptions here...
  console.log("=====Exception occurred====="+err);
});
//io.configure(function() {
//    io.set('log level', 3);
//});
var child;
io.sockets.on('connection', function(socket) {  
    socket.on('getUnreadNotifications', function(userId,socketId,jsonObject) {
        child = spawn(dir+"/yiic", ['ncom', 'getUnreadNotifications', '--userId=' + userId]);
        child.stdout.setEncoding('utf-8');
        child.stdout.on('data', function(data) {
            socket.emit('getUnreadNotificationsRes', data,socketId,jsonObject);
        });
        child.stderr.on('data', function(data) {
            console.log('stderr: ' + data);
        });

    });
        socket.on('getAllNotificationByUserId', function(userId,page,socketId) {
        child = spawn(dir+"/yiic", ['ncom', 'getAllNotificationByUserId', '--userId=' + userId,'--startLimit='+page]);
        child.stdout.setEncoding('utf-8');
        child.stdout.on('data', function(data) {
            socket.emit('getAllNotificationByUserIdResponse', data,socketId);
        });
        child.stderr.on('data', function(data) {
            console.log('stderr: ' + data);
        });

    });
    
  socket.on('getBadgesUnlocked', function(data,jsonObject,socketId) {
         console.log("*************Get badges unlocked called");
        child = spawn(dir+"/yiic", ['ncom', 'getBadgesUnlocked', '--userId=' + data.userId, '--isMobile=' + data.isMobile]);
        child.stdout.setEncoding('utf-8');
        child.stdout.on('data', function(data) {
            console.log("*******child.stdout.on******Get badges unlocked called");
            socket.emit('getBadgesUnlockedRes', data,jsonObject,socketId);
        });
        child.stderr.on('data', function(data) {
            console.log('stderr: ' + data);
        });

    });

    socket.on('disconnectcp', function() {
        console.log('stderr: please terminate child');
        child.kill('SIGTERM');
    });
    socket.on('disconnectcpdb', function() {
        console.log('stderr: please terminate childd');
        childd.kill('SIGTERM');
    });
});
}

