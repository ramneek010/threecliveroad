// global variable for the player
        var player;

        // this function gets called when API is ready to use
        function onYouTubePlayerAPIReady() {
          // create the global player from the specific iframe (#video)
          player = new YT.Player('video', {
            events: {
              // call this function when player is ready to use
              'onReady': onPlayerReady
            }
          });
        }

        function onPlayerReady(event) {

          // bind events
          var playButton = document.getElementById("play-button");
          playButton.addEventListener("click", function() {
            player.playVideo();
              playButton.style.display='none';
              pauseButton.style.display='block';
          });

          var pauseButton = document.getElementById("pause-button");
          pauseButton.addEventListener("click", function() {
            player.pauseVideo();
              playButton.style.display='block';
              pauseButton.style.display='none';
          });

        }

        // Inject YouTube API script
        var tag = document.createElement('script');
        tag.src = "http://www.youtube.com/player_api";
        var firstScriptTag = document.getElementsByTagName('script')[1];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);