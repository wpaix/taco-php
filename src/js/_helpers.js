//------------------------------------------------------------------------------

function rotateArray(arr, num) {
    arr = JSON.parse(JSON.stringify(arr))
    for (let i = 0; i < num; i++) arr.unshift(arr.pop())
    return arr
}

//------------------------------------------------------------------------------
// THROTTLE
//------------------------------------------------------------------------------

// simple throttle func: http://sampsonblog.com/simple-throttle-function/
  function old_throttle (callback, limit) {
    var wait = false;                 // Initially, we're not waiting
    return function () {              // We return a throttled function
      if (!wait) {                  // If we're not waiting
        callback.call();          // Execute users function
        
        wait = true;              // Prevent future invocations
        setTimeout(function () {  // After a period of time
          wait = false;         // And allow future invocations
        }, limit);
  
      }
    }
  }
  

//------------------------------------------------------------------------------
// EASES
//------------------------------------------------------------------------------

  $.easing.easeInOutCirc = function (x, t, b, c, d) {
    if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
    return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
  };

  
//------------------------------------------------------------------------------
// VALIDATIONS
//------------------------------------------------------------------------------

  
//------------------------------------------------------------------------------
// LOGGING
//------------------------------------------------------------------------------
  
  //function dlog(input){ if( Site.is_local ) console.warn(input) }


