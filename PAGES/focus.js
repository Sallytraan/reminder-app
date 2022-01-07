"use strict";

function theTimer(){

    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="theTimerWrapper">

  <div class = "container">
    <svg  class = "clock__time-visualizer" width="160" height="160" viewBox="0 0 160 160">
    <circle id = "progress-bar" cx="80" cy="80" r="77" fill="none" stroke="#33d4d8" stroke-width="1" 
    stroke-dasharray="484" stroke-dashoffset="" />
    </svg>
    <svg  class = "clock__time-visualizer clock__time-visualizer-background" width="160" height="160" viewBox="0 0 160 160">
    <circle cx="80" cy="80" r="77" fill="none" stroke="#542541" stroke-width="1" 
     />
    </svg>
    <div class = "clock"> 
      <p class = "clock__timer" id = "DOMClock">25:00</p>
      <p class = "clock__session-type"> session in progress</p>
    </div>
    <div class = "clock clock__background"> 
    </div>
    <div class = "control-container">
      <div class = "control-panel control-panel--session">
        <p class = "control-panel__title"> session length </p>
        <p  class = "control-panel__duration"> <span id = "session-length" > 25 </span> min </p>
        <div class = button-controls> 
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 428.6 428.6" id ="add-session-length" class = "button-controls__button"><path d="M214.3 15c26.9 0 53 5.3 77.6 15.7 23.7 10 45.1 24.4 63.4 42.7S388 113 398 136.8c10.4 24.6 15.7 50.7 15.7 77.6 0 26.9-5.3 53-15.7 77.6-10 23.7-24.4 45.1-42.7 63.4-18.3 18.3-39.6 32.7-63.4 42.7-24.6 10.4-50.7 15.7-77.6 15.7s-53-5.3-77.6-15.7c-23.7-10-45.1-24.4-63.4-42.7C55 337.1 40.6 315.8 30.6 292 20.3 267.3 15 241.2 15 214.3c0-26.9 5.3-53 15.7-77.6 10-23.7 24.4-45.1 42.7-63.4C91.7 55 113 40.6 136.8 30.6 161.3 20.3 187.4 15 214.3 15m0-15C96 0 0 96 0 214.3s96 214.3 214.3 214.3 214.3-96 214.3-214.3S332.7 0 214.3 0z"/><path d="M367.9 205.7H221.8V59.6h-15v146.1h-146v15h146v146h15v-146h146.1z"/></svg>
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 428.6 428.6" id = "subtract-session-length" class="button-controls__button"><path d="M214.3 15c26.9 0 53 5.3 77.6 15.7 23.7 10 45.1 24.4 63.4 42.7S388 113 398 136.8c10.4 24.6 15.7 50.7 15.7 77.6 0 26.9-5.3 53-15.7 77.6-10 23.7-24.4 45.1-42.7 63.4-18.3 18.3-39.6 32.7-63.4 42.7-24.6 10.4-50.7 15.7-77.6 15.7s-53-5.3-77.6-15.7c-23.7-10-45.1-24.4-63.4-42.7C55 337.1 40.6 315.8 30.6 292 20.3 267.3 15 241.2 15 214.3c0-26.9 5.3-53 15.7-77.6 10-23.7 24.4-45.1 42.7-63.4C91.7 55 113 40.6 136.8 30.6 161.3 20.3 187.4 15 214.3 15m0-15C96 0 0 96 0 214.3s96 214.3 214.3 214.3 214.3-96 214.3-214.3S332.7 0 214.3 0z"/><path d="M60.8 205.7h307.1v15H60.8z"/></svg>
        </div>
      </div>
      <div class = "control-panel control-panel--break">
        <p class = "control-panel__title"> break length </p>
        <p class = "control-panel__duration"> <span id = "break-length">5</span> min </p>
        <div class = button-controls> 
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 428.6 428.6" id = "add-break-length" class = "button-controls__button"><path d="M214.3 15c26.9 0 53 5.3 77.6 15.7 23.7 10 45.1 24.4 63.4 42.7S388 113 398 136.8c10.4 24.6 15.7 50.7 15.7 77.6 0 26.9-5.3 53-15.7 77.6-10 23.7-24.4 45.1-42.7 63.4-18.3 18.3-39.6 32.7-63.4 42.7-24.6 10.4-50.7 15.7-77.6 15.7s-53-5.3-77.6-15.7c-23.7-10-45.1-24.4-63.4-42.7C55 337.1 40.6 315.8 30.6 292 20.3 267.3 15 241.2 15 214.3c0-26.9 5.3-53 15.7-77.6 10-23.7 24.4-45.1 42.7-63.4C91.7 55 113 40.6 136.8 30.6 161.3 20.3 187.4 15 214.3 15m0-15C96 0 0 96 0 214.3s96 214.3 214.3 214.3 214.3-96 214.3-214.3S332.7 0 214.3 0z"/><path d="M367.9 205.7H221.8V59.6h-15v146.1h-146v15h146v146h15v-146h146.1z"/></svg>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 428.6 428.6" id = "subtract-break-length" class="button-controls__button"><path d="M214.3 15c26.9 0 53 5.3 77.6 15.7 23.7 10 45.1 24.4 63.4 42.7S388 113 398 136.8c10.4 24.6 15.7 50.7 15.7 77.6 0 26.9-5.3 53-15.7 77.6-10 23.7-24.4 45.1-42.7 63.4-18.3 18.3-39.6 32.7-63.4 42.7-24.6 10.4-50.7 15.7-77.6 15.7s-53-5.3-77.6-15.7c-23.7-10-45.1-24.4-63.4-42.7C55 337.1 40.6 315.8 30.6 292 20.3 267.3 15 241.2 15 214.3c0-26.9 5.3-53 15.7-77.6 10-23.7 24.4-45.1 42.7-63.4C91.7 55 113 40.6 136.8 30.6 161.3 20.3 187.4 15 214.3 15m0-15C96 0 0 96 0 214.3s96 214.3 214.3 214.3 214.3-96 214.3-214.3S332.7 0 214.3 0z"/><path d="M60.8 205.7h307.1v15H60.8z"/></svg>
        </div>
      </div>
    </div>
    <div class = "start-reset">
      <svg id = "start" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 610.3 300.5" class = "start-reset__button start-reset__button--start">
        <defs>
          <linearGradient id="grad1" x1="0%" y1="0%" x2="0%" y2="100%">
             <stop offset="0%" style="stop-color:rgb(255,146,64);stop-opacity:1" />
             <stop offset="100%" style="stop-color:rgb(237,105,44);stop-opacity:1" />
          </linearGradient>
        </defs>
      <path fill = "url(#grad1)"d="M148.7 298.5c-39.4 0-76.5-15.5-104.6-43.5C16.1 226.9.6 189.8.6 150.4S16.1 73.8 44.1 45.8c28-28.1 65.2-43.5 104.6-43.5h313.5c39.4 0 76.5 15.5 104.6 43.5 28 28.1 43.5 65.2 43.5 104.6 0 39.4-15.4 76.6-43.5 104.6-28 28.1-65.2 43.5-104.6 43.5H148.7zm0-289.1c-37.5 0-72.8 14.7-99.6 41.4-26.7 26.7-41.4 62.1-41.4 99.6s14.7 72.9 41.4 99.6c26.7 26.7 62.1 41.4 99.6 41.4h313.5c37.5 0 72.8-14.7 99.6-41.4 26.7-26.7 41.4-62.1 41.4-99.6 0-37.5-14.7-72.9-41.4-99.6-26.7-26.7-62.1-41.4-99.6-41.4H148.7z"/><text class="start-reset__button-text" transform="translate(142.684 198.123)" font-size="163.77" font-family="Roboto-Thin">start</text></svg>
      
        <svg id ="reset" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 610.3 300.5" class = "start-reset__button start-reset__button--reset">
   <defs>
          <linearGradient id="grad1" x1="0%" y1="0%" x2="0%" y2="100%">
             <stop offset="0%" style="stop-color:rgb(255,146,64);stop-opacity:1" />
             <stop offset="100%" style="stop-color:rgb(237,105,44);stop-opacity:1" />
          </linearGradient>
   </defs>
      
     <text class="start-reset__button-text" transform="translate(131.406 198.123)" font-size="163.77" font-family="Roboto-Thin">reset</text><path fill = "url(#grad1)"d="M148.7 298.5c-39.4 0-76.5-15.5-104.6-43.5C16.1 226.9.6 189.8.6 150.4S16.1 73.8 44.1 45.8c28-28.1 65.2-43.5 104.6-43.5h313.5c39.4 0 76.5 15.5 104.6 43.5 28 28.1 43.5 65.2 43.5 104.6 0 39.4-15.4 76.6-43.5 104.6-28 28.1-65.2 43.5-104.6 43.5H148.7zm0-289.1c-37.5 0-72.8 14.7-99.6 41.4-26.7 26.7-41.4 62.1-41.4 99.6s14.7 72.9 41.4 99.6c26.7 26.7 62.1 41.4 99.6 41.4h313.5c37.5 0 72.8-14.7 99.6-41.4 26.7-26.7 41.4-62.1 41.4-99.6 0-37.5-14.7-72.9-41.4-99.6-26.7-26.7-62.1-41.4-99.6-41.4H148.7z"/></svg>
    </div>
  </div>


<audio id = "audio"> 
  <source src = "http://renatovisuals.github.io/personal/Google_Event.mp3" type = "audio/mpeg">
</audio>

    </div>
    `;
    navList.classList.remove("selectedNav");
    navFocus.classList.add("selectedNav");
    navProfile.classList.remove("selectedNav");

    function Pomodoroclock (elements){
        var startTime,
            sessionLength = 25,
            breakLength = 5,
            breakInitiated = false,
            activeSessionDuration,
            isRunning = false,
            that = this,
            remainingTime;
            this.elements = elements;
        
        //updates current time and calls delta function to calcualte time passed. 
        function update(){
          if(isRunning){
          var currentTime = Date.now();
          //ternary used to switch between break length and session length
          breakInitiated ? activeSessionDuration = breakLength : activeSessionDuration = sessionLength;
          delta(currentTime,activeSessionDuration);
          updateProgressBar(elements.progressBar);
          }
        }
        //updateProgressBar updates the stroke-dasharray attribute of the progress bar
        function updateProgressBar(progressBar){
          var dasharrayLength = Number(progressBar.getAttribute('stroke-dasharray'));
          var sessionDuration = convertToMilliseconds(activeSessionDuration);
          var remainingTime = delta(Date.now(),activeSessionDuration)
          var progress = (remainingTime/sessionDuration);
          if(isRunning){
          elements.progressBar.setAttribute("stroke-dashoffset", progress*dasharrayLength-5);
          }else{
          elements.progressBar.setAttribute("stroke-dashoffset",dasharrayLength);
          }
          
        }
        //delta uses the current time in miliseconds or Date.now and calculates the time left in miliseconds
        function delta(time,sessionInMinutes){
          var timeElapsed = time - startTime;
          var sessionInMiliseconds = convertToMilliseconds(sessionInMinutes);
          var timeLeft = sessionInMiliseconds - timeElapsed;
          timeReformat(timeLeft);
          return timeLeft;
        }
        
        //timeReformat reformats the argument given in milliseconds to minutes and seconds
        function timeReformat(time){
          var formattedTime = new Date(time);
          var minutes = formattedTime.getMinutes();
          var seconds = formattedTime.getSeconds();
          if (minutes<10){
            minutes = "0"+ minutes;
          }
          if(seconds<10){
            seconds = "0" + seconds
          }
          remainingTime = minutes + ":" + seconds;
          that.updateDOMClock(remainingTime);
          
          if(minutes==0 && seconds==0 && isRunning){
          var i = 0;
          while(i<1){
          sessionSwitch();
          i++;
          }
          }
        }
          
        function sessionSwitch(){
            //this ternary switches to the break color scheme and back again
            breakInitiated ? elements.domElementChange("session") : elements.domElementChange("break");
            breakInitiated ? breakInitiated = false : breakInitiated = true;
            startTime = Date.now();
            remainingTime = null;
            elements.playAudio();
            //console.log(breakInitiated);
        }
        
        function convertToMilliseconds(val){
          return val*60000;
        }
      
        this.start = function(){
          //var length = progressBar.getTotalLength();
          //console.log(length);
          isRunning = true;
          startTime = Date.now();
          setInterval(update,50);
          elements.playAudio();
          elements.domElementChange("session");
         
        }
        
        this.reset = function(){
          isRunning = false;
          updateProgressBar(elements.progressBar);
          startTime = null;
          breakInitiated = false;
          timeReformat(convertToMilliseconds(sessionLength));
          
          elements.domElementChange("reset");
         
          
        }
        
        this.updateDOMClock = function(clockTime){ 
        elements.clockInterface.innerHTML = clockTime;
        }
        
        this.addSessionLength = function(DOMSessLength){
          sessionLength++;
          DOMSessLength.innerHTML = sessionLength;
        if(isRunning){
          isRunning = false
          updateProgressBar(elements.progressBar);
          clock.reset();
        }
        timeReformat(convertToMilliseconds(sessionLength));
        
        }
        
        this.subtractSessionLength = function(DOMSessLength){
          if(sessionLength>1){
          sessionLength--;
          DOMSessLength.innerHTML = sessionLength;
          }
          if(isRunning){
          isRunning = false;
          updateProgressBar(elements.progressBar);
          clock.reset();
         }
         timeReformat(convertToMilliseconds(sessionLength));
        }
        
        this.addBreakLength = function (DOMBreakLength){
          breakLength++;
          DOMBreakLength.innerHTML = breakLength;
          if(isRunning){
          this.reset();
          }
        }
        
        this.subtractBreakLength = function (DOMBreakLength){
          if(breakLength>1){
            breakLength--;
            DOMBreakLength.innerHTML = breakLength;
          }
          if(isRunning){
          this.reset();
          }
        }
        
        
      };
      
        
      var clock = new Pomodoroclock({
        //all DOM elements needed for clock operation are defined in this object.
        clockNotification:document.querySelector(".clock__session-type"),
        clockInterface: document.getElementById("DOMClock"),
        clockBackground:document.querySelector(".clock__background"),
        progressBar: document.getElementById("progress-bar"),
        playAudio: function(){
          var audio = document.getElementById("audio");
          audio.volume = 1.0 ;
          audio.play();
        },
        domElementChange(sessionType){
        var that = this;
          if(sessionType == "break"){
            this.clockNotification.classList.toggle("clock__session-type--reveal");
            this.clockBackground.classList.add("clock__background--break");
            setTimeout(function(){that.clockNotification.classList.add("clock__session-type--reveal")},300);
            this.clockNotification.innerHTML = "break in progress";
            console.log("break switch is working!");
          }else if(sessionType == "session"){
            this.clockBackground.classList.remove("clock__background--break");
            this.clockNotification.classList.toggle("clock__session-type--reveal");
            setTimeout(function(){that.clockNotification.classList.add("clock__session-type--reveal")},300);
            this.clockNotification.innerHTML = "session in progress";
            console.log("session switch is working!");
          }else {
            this.clockBackground.classList.remove("clock__background--break");
            this.clockNotification.classList.remove("clock__session-type--reveal");
            this.clockNotification.innerHTML = "session in progress";
          }
        }
      });
      
      var DOMSessLength = document.getElementById("session-length");
      var DOMBreakLength = document.getElementById("break-length");
      
      
      
      
      // session length button events
        
      document.getElementById("add-session-length").addEventListener("click",function(){
        clock.addSessionLength(DOMSessLength);
        document.querySelector(".clock__background").classList.remove("clock__background--rotate");
      });
      
      document.getElementById("subtract-session-length").addEventListener("click",function(){
      clock.subtractSessionLength(DOMSessLength);  
       document.querySelector(".clock__background").classList.remove("clock__background--rotate");
      });
      
      // break length button events
      
      document.getElementById("add-break-length").addEventListener("click",function(){
        clock.addBreakLength(DOMBreakLength);
      });
      
      document.getElementById("subtract-break-length").addEventListener("click",function(){
        clock.subtractBreakLength(DOMBreakLength);
      });
      
      //start button event
      
      document.getElementById("start").addEventListener("click",function(){
        clock.start();
        document.querySelector(".clock__background").classList.add("clock__background--rotate");
      })
      
      //reset button event
        
      document.getElementById("reset").addEventListener("click",function(){
       clock.reset();
       console.log(clock);
       document.querySelector(".clock__background").classList.remove("clock__background--rotate");
      });
      
      
      //document.getElementById("DOMClock").innerHTML = clock.update();
      

    
// POMODORO

}