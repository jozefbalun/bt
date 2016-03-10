"use strict";


var SCREEN_HEIGHT = 1024; // Tobii T120 Eye Tracker
var SCREEN_WIDTH = 1280;  // Tobii T120 Eye Tracker

function Point(time, x, y) {
    this.time = time;
    this.x = x;
    this.y = y;
}

var newpoint = [];

function GazeDataReceivedSynchronized(gazePoint)
{
  // ignore gaze data with low validity
  if (gazePoint.LeftValidity < 2 || gazePoint.RightValidity < 2)
  {
    // convert timestamp
    //var microseconds = syncManager.RemoteToLocal(gazePoint.TimeStamp);
    var microseconds = Date.Parse(gazePoint.TimeStamp);

    var milliseconds = parseInt((microseconds / 1000));
    var time = milliseconds;

    if (((microseconds / 100) % 10) >= 5) time++; // round

    // convert normalized screen coordinates (float between [0 - 1]) to pixel coordinates
    // coordinates (0, 0) designate the top left corner
    var leftX = gazePoint.LeftGazePoint2D.X * SCREEN_WIDTH;
    var leftY = gazePoint.LeftGazePoint2D.Y * SCREEN_HEIGHT;
    var rightX = gazePoint.RightGazePoint2D.X * SCREEN_WIDTH;
    var rightY = gazePoint.RightGazePoint2D.Y * SCREEN_HEIGHT;

    if (gazePoint.LeftValidity < 2 && gazePoint.RightValidity < 2)
    {
        // average left and right eyes
        var x = parseInt(((leftX + rightX) / 2));
        var y = parseInt(((leftY + rightY) / 2));
        newpoint.push(new Point(time, x, y));
        //fixationDetector.addPoint(time, x, y);
    }
    else if (gazePoint.LeftValidity < 2)
    {
        // use only left eye
        newpoint.push(new Point(time, parseInt(leftX), parseInt(leftY)));
    }
    else if (gazePoint.RightValidity < 2)
    {
      // use only right eye
      newpoint.push(new Point(time, parseInt(rightX), parseInt(rightY)));
    }
  }
}
