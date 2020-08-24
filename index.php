<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Memory</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
  <div class="infos fadeIn animated">
    <h2>Memory</h2>
    <h3 class="status"></h3>
  </div>
  <div class="blocks fadeIn animated">
    <div class="row">
      <div class="block block1" onclick="game.userSendInput('1')"> </div>
      <div class="block block2" onclick="game.userSendInput('2')"> </div>
      <div class="block block3" onclick="game.userSendInput('3')"> </div>
    </div>
    <div class="row">
      <div class="block block4" onclick="game.userSendInput('4')"> </div>
      <div class="block block5" onclick="game.userSendInput('5')"> </div>
      <div class="block block6" onclick="game.userSendInput('6')"> </div>
    </div>
    <div class="row">
      <div class="block block7" onclick="game.userSendInput('7')"> </div>
      <div class="block block8" onclick="game.userSendInput('8')"> </div>
      <div class="block block9" onclick="game.userSendInput('9')"> </div>
    </div>
    <div class="row">
      <div class="inputStatus"></div>
    </div>
    <div class="row">
    <button class="button-three" onclick="setTimeout(function(){
            game.startLevel()
          },1000)">Start</button>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    var Blocks = function(blockAssign, setAssign) {
      this.allOn = false
      this.blocks = blockAssign.map((d, i) =>
        ({
          name: d.name,
          el: $(d.selector),
          audio: this.getAudioObject(d.pitch)
        })
      )
      this.soundSets = setAssign.map((d, i) =>
        ({
          name: d.name,
          sets: d.sets.map((pitch) => this.getAudioObject(pitch))
        })
      )
    }
    Blocks.prototype.flash = function(note) {
      let block = this.blocks.find(d => d.name == note)
      if (block) {
        block.audio.currentTime = 0
        block.audio.play()
        block.el.addClass("active")
        setTimeout(() => {
          if (this.allOn == false) {
            block.el.removeClass("active")
          }
        }, 100)
      }
    }
    Blocks.prototype.turnOnAll = function(note) {
      this.allOn = true
      this.blocks.forEach(d => {
        d.el.addClass("active")
      })
    }
    Blocks.prototype.turnOffAll = function(note) {
      this.allOn = false
      this.blocks.forEach(d => {
        d.el.removeClass("active")
      })
    }
    Blocks.prototype.getAudioObject = function(pitch) {
      var audio = new Audio("https://awiclass.monoame.com/pianosound/set/" + pitch + ".wav")
      audio.setAttribute("preload", "auto")
      return audio
    }
    Blocks.prototype.playSet = function(type) {
      this.soundSets
        .find(set => set.name == type).sets
        .forEach(o => {
          o.currentTime = 0
          o.play()
        })
    }


    var Game = function() {
      this.blocks = new Blocks(
        [{
            selector: ".block1",
            name: "1",
            pitch: "1"
          },
          {
            selector: ".block2",
            name: "2",
            pitch: "2"
          },
          {
            selector: ".block3",
            name: "3",
            pitch: "3"
          },
          {
            selector: ".block4",
            name: "4",
            pitch: "4"
          }, {
            selector: ".block5",
            name: "5",
            pitch: "5"
          }, {
            selector: ".block6",
            name: "6",
            pitch: "6"
          }, {
            selector: ".block7",
            name: "7",
            pitch: "7"
          }, {
            selector: ".block8",
            name: "8",
            pitch: "8"
          }, {
            selector: ".block9",
            name: "9",
            pitch: "9"
          }
        ],
        [{
            name: "correct",
            sets: [1, 3, 5, 8]
          },
          {
            name: "wrong",
            sets: [2, 4, 5.5, 7]
          }
        ]
      )
      this.levels = [
        "123",
        "52324",
        "29125",
        "457239",
        "418841",
        "556899",
        "1148956",
        "99845575",
        "966114466",
        "9999444522",
        "55533997744"
      ]
      this_setting = this
      this.currentLevel = 0
      this.playInterval = 1000
      this.mode = "waiting"
    }
    Game.prototype.startLevel = function() {
      this.showMessage("Level " + this.currentLevel)
      this.startGame(this.levels[this.currentLevel])
    }
    Game.prototype.showMessage = function(message) {
      console.log(message)
      $(".status").text(message)
    }
    Game.prototype.startGame = function(answer) {
      this.mode = "gamePlay"
      this.answer = answer
      let notes = this.answer.split("")
      let _this = this

      this.showStatus("")
      this.timer = setInterval(function() {
        let char = notes.shift()
        if (!notes.length) {
          clearInterval(_this.timer)
          _this.startUserInput()
        }
        _this.playNote(char)
      }, this.playInterval)
    }
    Game.prototype.playNote = function(note) {
      // console.log(note)
      this.blocks.flash(note)

    }
    Game.prototype.startUserInput = function() {
      this.userInput = ""
      this.mode = "userInput"
    }
    Game.prototype.userSendInput = function(inputChar) {
      if (this.mode == "userInput") {
        let tempString = this.userInput + inputChar
        this.playNote(inputChar)
        this.showStatus(tempString)
        if (this.answer.indexOf(tempString) == 0) {
          if (this.answer == tempString) {
            selfc = this
            this.currentLevel += 1
            $.ajax({
              type: "POST",
              url: "api.php",
              data: {
                name: '<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'ไม่ระบุตัวตน' ?>',
                type: 'update',
                point: this.currentLevel
              },
              success: function(response) {
                console.log(selfc.currentLevel)
              }
            });
            this.mode == "waiting"
            setTimeout(() => {
              if(this_setting.playInterval > 501){
                this_setting.playInterval -= selfc.currentLevel*50
              }else{
                this_setting.playInterval = 400
              }
              
              this.startLevel()
              console.log(this_setting.playInterval)
            }, 1000)
          }
          this.userInput += inputChar
        } else {
          this.currentLevel = 0
          this.mode == "reset"
          setTimeout(() => {
          window.location.href = 'totalScore.php'
            // this.startLevel()
          }, 1000)
        }
      }
    }
    Game.prototype.showStatus = function(tempString) {
      $(".inputStatus").html("")
      this.answer.split("").forEach((d, i) => {
        var circle = $("<div class='circle'></div>")
        if (i < tempString.length) {
          circle.addClass("correct")
        }
        $(".inputStatus").append(circle)
      })

      if (tempString == this.answer) {
        $(".inputStatus").addClass("correct")
        this.showMessage("Correct!")
        setTimeout(() => {
          this.blocks.turnOnAll()
          this.blocks.playSet("correct")
        }, 1000)
      } else {
        $(".inputStatus").removeClass("correct")
      }
      if (tempString == "") {
        this.blocks.turnOffAll()
      }
      if (this.answer.indexOf(tempString) != 0) {
        this.showMessage("Wrong...")
        $(".inputStatus").addClass("wrong")
        // this.blocks.turnOnAll()
        this.blocks.playSet("wrong")
      } else {
        $(".inputStatus").removeClass("wrong")

      }
    }

    var game = new Game()

    //--------------------
    <?php if (!(isset($_SESSION['name']))) { ?>
      $(document).ready(function() {
        const {
          value: name
        } = Swal.fire({
          title: 'Input Your Name',
          input: 'text',
          inputPlaceholder: 'Enter your Name'
        }).then(res => {
          if (res.value != "") {
            console.log(res.value)
            $.ajax({
              type: "post",
              url: "api.php",
              data: {
                name: res.value,
                type: 'register'
              },
              success: function(response) {
                console.log(response)
                setTimeout(function() {
                  game.startLevel()
                }, 1500)
              }
            });
          }
        })

      });
    <?php } ?>
  </script>


</body>

</html>