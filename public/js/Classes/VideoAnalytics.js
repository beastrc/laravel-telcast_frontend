var Video = (function () {
    function Video(element) {
      this.element = mainPlayer;
      //document.getElementById(element);
      this.intervalForPlay;
      this.countPlay = 0;
      this.childCounter = 1;
      this.trackArr = [];
      this.currentTime = 0;
      this.playTime;
      this.pauseTime;
      this.canplay;
      this.isPlay = false;
      this.isPause = false;
      this._init();
    }

    Video.prototype._init = function(){
      var inst = this;
      inst.bindPlay();
      inst.bindPause();
      inst.bindTimeUpdate();
      inst.bindLoadData();
      inst.bindWaiting();
      inst.bindCanPlay();
    }

    Video.prototype.bindPlay = function(o){
      var inst = this;
      inst.element.on("play", function(e) {
          // e.stopPropagation();
          if (!inst.playTime) {
              inst.playTime = 0;
          }
          inst.isPlay = true;
          inst.isPause = false;
          inst.playTime = parseInt(inst.element.currentTime());
      }, true);
    }

    Video.prototype.bindPause = function(o){
      var inst = this;
      inst.element.on("pause", function(e) {
          // e.stopPropagation();
          inst.isPlay = false;
          inst.isPause = true;
          inst.pauseTime = parseInt(inst.element.currentTime());
          clearInterval(inst.intervalForPlay);
          inst.intervalForPlay = false;
      }, true);
    }

    Video.prototype.bindTimeUpdate = function(o){
      var inst = this;
      inst.element.on("timeupdate", function() {
          if ( inst.currentTime <= parseInt(inst.element.currentTime())) {
              inst.currentTime = parseInt(inst.element.currentTime());
          }
          if (inst.isPause) {
              inst.pauseTime = parseInt(inst.element.currentTime());
              inst.isPause = false;
          }
          else{
            inst.playTime = parseInt(inst.element.currentTime());
          }
          if (inst.canplay && !inst.intervalForPlay && inst.isPlay) {
              inst.counter(inst.playTime, inst.pauseTime);
          }
      }, true);

    }

    Video.prototype.bindLoadData = function(o){
      var inst = this;
      inst.element.on("loadeddata", function() {
          console.log("loadeddata");
      }, true);

    }

    Video.prototype.bindWaiting = function(o){
      var inst = this;
      inst.element.on("waiting", function(e) {
        // e.stopPropagation();
          console.log("waiting");
          clearInterval(inst.intervalForPlay);
          inst.intervalForPlay = false;
      }, true);
    }

    Video.prototype.bindCanPlay = function(o){
      var inst = this;
      inst.element.on("canplay", function() {
          if (!inst.canplay) {
              inst.canplay = parseInt(inst.element.duration());
          }
      }, true);
    }

    Video.prototype.counter = function(play, pause){
        var inst = this;
        inst.countPlay = play;
        if (play == pause) {
            pause = inst.element.currentTime();
        }
        inst.intervalForPlay = setInterval(function(){
            if (pause > inst.countPlay) {
                if (inst.trackArr[inst.countPlay]) {
                    inst.trackArr[inst.countPlay] = inst.trackArr[inst.countPlay]+1;
                }
                else{
                    inst.trackArr[inst.countPlay] = 1;
                }
            }
            else{
                inst.trackArr[inst.countPlay] = inst.childCounter;  
            }
            inst.countPlay++;
            if (inst.countPlay == inst.canplay) {
                clearInterval(inst.intervalForPlay);
            }
            console.log(inst.trackArr);  
        },1000);
    }
    Video.prototype.clearCounter = function(){
        var inst = this;
        clearInterval(inst.intervalForPlay);
        inst.intervalForPlay = false;
    }
    return Video;
}());