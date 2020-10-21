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
   // console.log("Number of request served = ",reqCount);
  }, 1000);
 
} else {
console.log("I m worker----------"+cluster.worker.id);

var fs = require('fs');



var app = require('http').createServer(function(req, res){
    console.log("create server----");
     process.send({ info : 'ReqServMaster' });
})
  , io = require('socket.io').listen(app);

app.listen(config.searchPort);

//for testing
//function handler (req, res) {
//    console.log("handler--------------------");
//      res.writeHead(200);
//    res.end("welcome to Skiptaneo search service started\n");
//}

//production settings
//io.enable('browser client minification');  // send minified client
//io.enable('browser client etag');          // apply etag caching logic based on version number
//io.enable('browser client gzip');          // gzip the file
//io.set('log level', 3);                              // reduce logging
////io.set('match origin protocol', 'true');
//
//io.set('transports', [
// 'flashsocket'
//  , 'htmlfile'
//  , 'xhr-polling'
//  , 'jsonp-polling'
//  ]);
var spawn = require('child_process').spawn;
var exec = require('child_process').exec;
var child;
var dir=config.dir;

process.on('uncaughtException', function (err) { // handling exceptions here...
  console.log("=====Exception occurred====="+err);
});
io.sockets.on('connection', function(client)
{  
     process.send({ info : 'ReqServMaster' });
    client.on('uncaughtException', function(err) {
        console.log('Caught exception: ' + err);
    });
    
     client.on('projectSearch', function(searchText,offset,pageLength,userSearch,groupsSearch,subGroupsSearch,hastagsSearch,postSearch,loginUserId,curbsideCategory,socketId)
    {  
       child = spawn(dir+"/yiic", ['ncom', 'projectSearch', '--searchText=' + searchText,'--offset=' + offset,'--pageLength=' + pageLength,'--userSearch=' + userSearch,'--groupsSearch=' + groupsSearch,'--subGroupsSearch=' + subGroupsSearch,'--hastagsSearch=' + hastagsSearch,'--postSearch=' + postSearch,'--loginUserId=' + loginUserId, '--curbsideCategory='+curbsideCategory]);
       child.stdout.setEncoding('utf-8');
       child.stdout.on('data', function(data) {
           //console.log(data);
        client.emit('projectSearchResponse', data,socketId);
       });
       child.stderr.on('data', function(data) {
        console.log('stderr: ' + data);
       });
    });
 client.on('mobileSearch', function(searchdata,socketId)
    {  //console.log("xxxxxxxxasdasttttttttttttttdasxxxxxx"+searchdata.timezoneName);
       child = spawn(dir+"/yiic", ['ncom', 'mobileSearch', '--searchText=' + searchdata.search,'--offset=' + searchdata.mobileOffset,'--pageLength=' + searchdata.mobilePageLength,'--userSearch=' + searchdata.userSearch,'--loginUserId=' + searchdata.loginUserId, '--isPostExist=' + searchdata.isPostExist,'--isNewsExist=' + searchdata.isNewsExist,'--isGroupsExist=' + searchdata.isGroupsExist,
'--isCurbsideCategoryExist=' + searchdata.isCurbsideCategoryExist,'--timezoneName='+searchdata.timezoneName]);

       child.stdout.setEncoding('utf-8');
       child.stdout.on('data', function(data) {
          // console.log("111111111"); 	
        client.emit('mobileSearchResponse', data,socketId);
       });
       child.stderr.on('data', function(data) {
        console.log('stderr123: ' + data);
       });
    });
  client.on('getUsersForSearch', function(searchdata,socketId)
    {  //console.log("xxxxgetUsersForSearchxxxxxxxxxx"+searchdata.search+"1111111111"+searchdata.mobileOffset+"2222222222r"+searchdata.mobilePageLength+"33333333r");
       child = spawn(dir+"/yiic", ['ncom', 'getUsersForSearch', '--searchText=' + searchdata.search,'--offset=' + searchdata.mobileOffset,'--pageLength=' + searchdata.mobilePageLength]);
       child.stdout.setEncoding('utf-8');
       child.stdout.on('data', function(data) {
         //  console.log("111111111========sagar========="+data); 	
        client.emit('getUsersForSearchResponse', data,socketId);
       });
       child.stderr.on('data', function(data) {
        console.log('stderr123: ' + data);
       });
    });
   client.on('saveBrowseDetails', function(sessionObject,address) {
    //    child = spawn(dir+"/yiic", ['track', 'saveBrowseDetails', '--sessionObj=' + sessionObject]);
         child = spawn(dir+"/yiic", ['track', 'saveBrowseDetails', '--sessionObj=' + sessionObject,'--clientIP=' + address]);
       
        child.stderr.on('data', function(data) {
            console.log('stderr: ' + data);
        });

    });
    client.on('disconnect', function(userId)
    {
        
    });
});
}

