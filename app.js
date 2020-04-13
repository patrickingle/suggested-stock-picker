"use strict";

// Modules to control application life and create native browser window
var config = require('config.json')('./settings.json');
const {app, BrowserWindow, Menu} = require('electron');
const path = require('path');
var fs = require('fs');
var http = require('http');

var bodyParser = require('body-parser')
var cors = require('cors');
var killable = require('killable');
var express = require("express");

var rest = express();
var server = null;

// parse application/x-www-form-urlencoded
rest.use(bodyParser.urlencoded({ extended: false }))

// parse application/json
rest.use(bodyParser.json());


//let expired = false;

// Keep a global reference of the window object, if you don't, the window will
// be closed automatically when the JavaScript object is garbage collected.
let mainWindow

function createWindow () {
  // Create the browser window.
  mainWindow = new BrowserWindow({
    width: 1072,
    height: 910,
    icon: __dirname + '/images/stocksplit.ico',
    webPreferences: {
      preload: path.join(__dirname, 'preload.js')
    }
  })

  /**
   * Adding an expiration-timeout.
   * Internal coded expiration data: user_expiry
   * settings.json override date: config.expiry
   * 
   * if today is older than internal expiration but before the user override expiration, permit access
   * OR, if today is before the internal expiration, permit access
   * OTHERWISE, deny access, inform an update download is required
   */
  
  mainWindow.loadFile('views/index.html');


  // Open the DevTools.
  // mainWindow.webContents.openDevTools()

  // Emitted when the window is closed.
  mainWindow.on('closed', function () {
    // Dereference the window object, usually you would store windows
    // in an array if your app supports multi windows, this is the time
    // when you should delete the corresponding element.
    mainWindow = null
  })

  if (config.menu && config.menu == "off") {
    let menu = Menu.buildFromTemplate(menuTemplate);
    Menu.setApplicationMenu(menu);  
  }
}

// This method will be called when Electron has finished
// initialization and is ready to create browser windows.
// Some APIs can only be used after this event occurs.
app.on('ready', createWindow);

// Quit when all windows are closed.
app.on('window-all-closed', function () {
  // On macOS it is common for applications and their menu bar
  // to stay active until the user quits explicitly with Cmd + Q
  if (process.platform !== 'darwin') app.quit()
});

app.on('activate', function () {
  // On macOS it's common to re-create a window in the app when the
  // dock icon is clicked and there are no other windows open.
  if (mainWindow === null) createWindow();
});

rest.get("/", cors(), function(req, res, next){
  res.json("{'about':'Suggested Stock Picker'}");
});

rest.get("/equities/:path,:fileName", cors(), function(req, res, next){
  let fullPathName = req.params.path + "/" + req.params.fileName;
  var directoryPath = path.join(__dirname, fullPathName);
  if (fs.existsSync(directoryPath)) {
    fs.readFile(directoryPath, {encoding: 'utf-8'}, function(err,data){
      if (err) res.json("{error: " + err + "}");
      res.json(JSON.parse(data));
    });    
  } else {
    res.json("{error:'file not found, "+fullPathName+"'}");
  }
});

rest.get("/ls/:path", cors(), function(req, res, next){
  var directoryPath = path.join(__dirname, req.params.path);
  var _files = [];

  fs.readdir(directoryPath, function (err, files) {
    //handling error
    if (err) throw err;
    
    //listing all files using forEach
    files.forEach(function (file) {
        // Do whatever you want to do with the file
        _files.push(file);
    });
    res.json(_files);
  });
});

rest.get("/equities/:pageNo", cors(), function(req,res,next){
  let url = "https://www.nasdaq.com/api/v1/screener?page="+req.params.pageNo+"&pageSize=100";
  var options = {
      host: 'www.nasdaq.com',
      path: '/api/v1/screener?page=' +req.params.pageNo+ '&pageSize=100'
  }
  var request = http.request(options, function (res) {
      var data = '';
      res.on('data', function (chunk) {
          data += chunk;
      });
      res.on('end', function () {
        console.log(data);
        res.json(data);
      });
  });
  request.on('error', function (e) {
      console.log(e.message);
      res.json(e.message);
  });
});

//
// START SERVER LISTENING ON PORT config.port
//
function start() {
    server = rest.listen(config.port, config.host, () => {
        console.log(config.host + " server running on port " + config.port);
    });
  
   
    killable(server);
}

start();

