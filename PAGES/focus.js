"use strict";

function theTimer(){

    //Hamna högst upp på sidan
    scroll(0,0)  
  
    //Töm nuvarande innehåll i wrapper
    wrapper.innerHTML = "";
  
    wrapper.innerHTML = `
    <div id="theTimerWrapper">



    <div class="bgSun"></div>
    <div class="water"></div>

    <div class="maincontainer">
        <div class="clockContainer">
            <div class="pomodoroDisplay">
                <h2 class="currentClockStat">Ready?</h2>
                <div class="timeDisplay">25:00</div>
                <div class="controls">
                    <div class="startClock"><i class="fas fa-play"></i> START</div>
                    <div class="pauseClock"><i class="fas fa-pause"></i> PAUSE</div>
                    <div class="restartClock"><i class="fas fa-sync-alt"></i> RESET</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="cloud1"></div>
    <div class="cloud2"></div>
    <div class="cloud3"></div>
    
    <div class="cloud">
        <div class="timeIntervalsContainer">
            <div class="sessionContainer">
                <div class="increaseSession"><i class="fas fa-angle-double-up"></i></div>
                <div>Session</div>
                <div class="currentSession">25</div>
                <div class="decreaseSession"><i class="fas fa-angle-double-down"></i></div>
            </div>
            <div class="breakContainer">
                <div class="increaseBreak"><i class="fas fa-angle-double-up"></i></div>
                <div>Break</div>
                <div class="currentBreak">5</div>
                <div class="decreaseBreak"><i class="fas fa-angle-double-down"></i></div>
            </div>
        </div>
    </div>
    
    </div>
    `;
    navList.classList.remove("selectedNav");
    navFocus.classList.add("selectedNav");
    navProfile.classList.remove("selectedNav");



    
// POMODORO
var startClock = document.querySelector(".startClock")
    var pauseClock = document.querySelector(".pauseClock")
    var restartClock = document.querySelector(".restartClock")
    var timeIntervalsContainer = document.querySelector(".timeIntervalsContainer")
    var currentClockStat = document.querySelector(".currentClockStat")

    var sessionRunning = true;

    startClock.addEventListener("click", function() {

        startClock.style.display = "none"
        pauseClock.style.display = "block"
        restartClock.style.display = "block"

        if (sessionRunning) {
            currentClockStat.innerHTML = "Session"
        } else {
            currentClockStat.innerHTML = "Break"
        }

        if (!timerStarted) {
            setStartInterval()
            
            cloud.style.top = "500px"
            cloud1.style.top = "300px"
            cloud2.style.top = "200px"
            cloud2.style.left = "200px"
            cloud3.style.top = "450px"
            timeIntervalsContainer.style.opacity = "0.0"
        }

        startTimer()
    })

    pauseClock.addEventListener("click", function() {

        startClock.style.display = "block"
        pauseClock.style.display = "none"
        restartClock.style.display = "block"
        currentClockStat.innerHTML = "Ready?"

        pauseTimer()
    })

    restartClock.addEventListener("click", function() {

        startClock.style.display = "block"
        pauseClock.style.display = "none"
        restartClock.style.display = "none"

        resetTimer()
        
        cloud.style.left = "46%"
        cloud1.style.left = "25%"
        cloud2.style.left = "75%"
        cloud3.style.left = "54%"
        timeIntervalsContainer.style.opacity = "0.8"
        sunSet.classList.add("bgSunClass");
    })


    var currentBreak = document.querySelector(".currentBreak")
    var currentSession = document.querySelector(".currentSession")

    var selecetedBreakTime = parseInt(currentBreak.innerHTML)
    var selecetedSessionTime = parseInt(currentSession.innerHTML)

    var increaseBreak = document.querySelector(".increaseBreak")
    var increaseSession = document.querySelector(".increaseSession")
    var decreaseBreak = document.querySelector(".decreaseBreak")
    var decreaseSession = document.querySelector(".decreaseSession")

    var currentSessionTime
    var currentBreakTime
    var currentTimeDisplayed
    var timeDisplay = document.querySelector(".timeDisplay")



    increaseSession.addEventListener("click", function() {

        if (selecetedSessionTime < 60) {
            selecetedSessionTime++

            currentSession.innerHTML = selecetedSessionTime.toString()

            currentMinutInt = selecetedSessionTime

            displayClock()
        }
    })

    decreaseSession.addEventListener("click", function() {

        if (selecetedSessionTime > 1) {

            selecetedSessionTime--

            currentSession.innerHTML = selecetedSessionTime.toString()

            currentMinutInt = selecetedSessionTime

            displayClock()
        }
    })

    increaseBreak.addEventListener("click", function() {

        if (selecetedBreakTime < 30) {
            selecetedBreakTime++

            currentBreak.innerHTML = selecetedBreakTime.toString()
        }
    })

    decreaseBreak.addEventListener("click", function() {

        if (selecetedBreakTime > 1) {
            selecetedBreakTime--

            currentBreak.innerHTML = selecetedBreakTime.toString()
        }
    })

    var currentMinutInt = selecetedSessionTime
    var currentSecondInt = 0;
    var currentMinutString = currentMinutInt.toString();
    var currentSecondSting = currentSecondInt.toString();


    function displayClock() {

        console.log("time display")

        currentMinutString = currentMinutInt.toString();
        currentSecondSting = currentSecondInt.toString();

        checkTime(currentMinutInt, currentSecondInt)

        currentTimeDisplayed = currentMinutString + ":" + currentSecondSting

        timeDisplay.innerHTML = currentTimeDisplayed;
    }



    function checkTime(currentMinutInt, currentSecondInt) {

        if (currentMinutInt < 10) {

            currentMinutString = "0" + currentMinutString
        }
        if (currentSecondInt < 10) {

            currentSecondSting = "0" + currentSecondSting
        }
    }

    var finalSessionTimer
    var finalBreakTimer
    var currentStatDisplay
    var timerStarted = false;


    function setStartInterval() {

        finalSessionTimer = selecetedSessionTime;
        finalBreakTimer = selecetedBreakTime;

        currentStatDisplay = finalSessionTimer

        timerStarted = true;
    }


    var myTimer
    var seconds = 60
    var pomodoroSessionStat = true;

    function startTimer() {

        myTimer = setInterval(function() {

            if (seconds == 60) {

                currentStatDisplay = currentStatDisplay - 1
                currentMinutInt = currentStatDisplay
            }

            seconds = seconds - 1
            currentSecondInt = seconds


            if (seconds == 0 && currentMinutInt == 0) {

                if (pomodoroSessionStat) {
                    seconds = 60
                    currentStatDisplay = finalBreakTimer
                    currentMinutInt = currentStatDisplay

                    pomodoroSessionStat = false;
                    sessionRunning = false;
                    currentClockStat.innerHTML = "Break"
                    
                   /* url = "sound/hellodarknessmyoldfriend.mp3";

                    playSound(url)*/
                    
                    sunSet.classList.remove("bgSunClass");

                } else {
                    seconds = 60
                    currentStatDisplay = finalSessionTimer
                    currentMinutInt = currentStatDisplay

                    pomodoroSessionStat = true;
                    sessionRunning = true;
                    currentClockStat.innerHTML = "Session"
                    
                   /* url = "sound/work.mp3";

                    playSound(url)*/
                    
                    sunSet.classList.add("bgSunClass");
                }
            }

            if (seconds < 1) {
                seconds = 60
            }

            displayClock()

        }, 1000);
    }

    function pauseTimer() {
        clearInterval(myTimer);
    }

    function resetTimer() {

        clearInterval(myTimer);

        currentMinutInt = finalSessionTimer
        currentSecondInt = 0;
        seconds = 60

        displayClock()

        timerStarted = false;
        pomodoroSessionStat = true;
        sessionRunning = true;
        currentClockStat.innerHTML = "Ready?"
    }


  /* var url = "sound/hellodarknessmyoldfriend.mp3";
   
    function playSound(url) {
        var audio = document.createElement('audio');
        audio.style.display = "none";
        audio.src = url;
        audio.autoplay = true;
        audio.onended = function() {
            audio.remove() //Remove when played.
        };
        document.body.appendChild(audio);
    }
    */

    var sunSet = document.querySelector(".bgSun")
    var maincontainer = document.querySelector(".maincontainer")
    var cloud = document.querySelector(".cloud") 
    var cloud1 = document.querySelector(".cloud1") 
    var cloud2 = document.querySelector(".cloud2") 
    var cloud3 = document.querySelector(".cloud3") 

    setTimeout(function() {

        sunSet.classList.add("bgSunClass");

        setTimeout(function() {
            maincontainer.style.opacity = "0.8"
        }, 4000);
        
        setTimeout(function() {
            timeIntervalsContainer.style.opacity = "0.8"
        }, 7000);
        
        setTimeout(function() {
            
            cloud.style.left = "46%"
            cloud1.style.left = "25%"
            cloud2.style.left = "75%"
            cloud3.style.left = "54%"
            
        }, 2000);
    }, 500);

}