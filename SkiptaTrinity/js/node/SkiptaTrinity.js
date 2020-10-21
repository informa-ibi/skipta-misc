


exports.proxyPort = "8080";
exports.streamPort = "8081";
exports.chatPort = "8082";
exports.notificationPort = "8083";
exports.searchPort = "8084";

exports.search = "http://localhost:"+exports.searchPort;
exports.chat = "http://localhost:"+exports.chatPort;
exports.stream = "http://localhost:"+exports.streamPort;
exports.notification = "http://localhost:"+exports.notificationPort;
exports.dir = "/usr/share/nginx/www/SkiptaTrinity/protected";
exports.loglevel = "error";
/*
 * Production setttings 
 *  
exports.search = "http://www.skiptaneo.com:8089";
exports.chat = "http://www.skiptaneo.com:8087";
exports.stream = "http://www.skiptaneo.com:8086";
exports.notification = "http://www.skiptaneo.com:8088";
*/
