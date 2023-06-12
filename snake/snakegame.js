//global variables

var button = document.getElementById("start");
button.addEventListener("click", start);

var backgroundColor = '#808080';


let gridScale = 15;
let size = 500;
let scale = size/gridScale;
var can = document.getElementById("gameSurface");
var canvas = can.getContext("2d");

var highScore = 0;
var score = 0;


//classes

class grid{
    constructor(){
        // Creating a sizexsize matrix
        var matrix = [];
        for (let i = 0; i < gridScale; i++) {
            var row = [];
            for (let j = 0; j < gridScale; j++) {
                row.push(0); // Initializing each element with 0
            }
            matrix.push(row);
        }
        this.myMatrix = matrix;
        this.draw();
    }

    
    draw() {
        
        for(var i = 0; i < gridScale; i++){
            
            for(var j = 0; j < gridScale; j++){
                
                if(this.myMatrix[i][j] == 0){
                    //nothing (grey Block)
                    var insideSize = 0.9;
                    fillRect(i*scale, j*scale, scale, scale, '#000000');
                    fillRect(i*scale + (scale-insideSize*scale)*0.5, j*scale + (scale-insideSize*scale)*0.5, scale*insideSize, scale*insideSize, '#333')
                }else if(this.myMatrix[i][j] == -1){
                    //apple (Red Box)
                    fillRect(i*scale, j*scale, scale, scale, '#bd0202');
                }else if(this.myMatrix[i][j] == -2){
                    //wall (Brown Box)
                    fillRect(i*scale, j*scale, scale, scale, '#452e01');
                }else if(this.myMatrix[i][j] > 0){
                    //snake (green Box)
                    fillRect(i*scale, j*scale, scale, scale, '#369e02');
                }
            }
        }
    }
    
}

class player{
    constructor(x, y, directionX, directionY, lenght){
        this.posX = x;
        this.posY = y;
        this.directionX = directionX;
        this.directionY = directionY;
        this.lenght = lenght;
    }

    up(){
        this.directionX = 0; 
        this.directionY = -1;
    }
    down(){
        this.directionX = 0; 
        this.directionY = 1;
    }
    left(){
        this.directionX = -1; 
        this.directionY = 0;
    }
    right(){
        this.directionX = 1; 
        this.directionY = 0;
    }

    move(){
        this.posX = this.posX + this.directionX;
        this.posY = this.posY + this.directionY;
    }
}

//funkions

function fillRect(x,y, width, height, color){
    canvas.beginPath();
    canvas.fillStyle = color;
    canvas.rect(x,y,width,height);
    canvas.fill();
}


//"main"-Method
function start(){
    //UI
    document.getElementById("game").removeChild(button);
    document.getElementById("gameOver").textContent = '';
    //objegts
    myGrid = new grid();
    myPlayer = new player(0, 4, 1, 0, 3);  

    //get player input
    document.addEventListener("keydown", function(){
        if(event.keyCode == 37){
            //left arrow press
            if(myPlayer.directionX != 1){
                myPlayer.left();
            }
            
        }else if(event.keyCode == 38){
            //arrow up
            if(myPlayer.directionY != 1){
                myPlayer.up();
            }
        }
        else if(event.keyCode == 39){
            //arrow right
            if(myPlayer.directionX != -1){
                myPlayer.right();
            }
            
        }
        else if(event.keyCode == 40){
            //arrow down
            if(myPlayer.directionY != -1){
                myPlayer.down();
            }
            
        }
    })

    //spawn first apple
    myGrid.myMatrix[5][4] = -1;
    
    //time Variables
    const STEP = 10;

    var moveTime = 0;
    var moveSpeed = 130;


    //score
    score = 0;
    //update 
    interval = window.setInterval(function(){

        score = myPlayer.lenght;
        document.getElementById("score").textContent = "Score: " + score;
        if(score > highScore){
            highScore = score;
            document.getElementById("highScore").textContent = "Highscore: " + highScore;
        }
        
        //update every 500 milliseconds
        if(moveTime > moveSpeed){
            moveTime = 0;
        myPlayer.move();

        
        

        //player stuff
        //check for out of bounds
        if(myPlayer.posX < 0 || myPlayer.posX >= gridScale || myPlayer.posY < 0 || myPlayer.posY >= gridScale){
            //die
            death();
        }
        //check for apples
        if(myGrid.myMatrix[myPlayer.posX][myPlayer.posY] == -1){
            myPlayer.lenght += 1;
            spawnApple();
            spawnWall();
        }
        //check for walls
        if(myGrid.myMatrix[myPlayer.posX][myPlayer.posY] == -2){
            death();
        }
        //check for snake Body
        if(myGrid.myMatrix[myPlayer.posX][myPlayer.posY] >= 1){
            //die
            death();  
        }
        
        
        
        //grid stuff

        //Schlangen Length -1
        for(var i = 0; i < gridScale; i++){
            for(var j = 0; j < gridScale; j++){
                
                if(myGrid.myMatrix[i][j] >= 1){
                    myGrid.myMatrix[i][j] -= 1;
                }
            }
        }

        myGrid.myMatrix[myPlayer.posX][myPlayer.posY] = myPlayer.lenght;
        myGrid.draw();
        }

        


        //update Timers
        moveTime += STEP;
        
    }, STEP)

    
    
}

function spawnApple(){
    freePlace = false;
    while(!freePlace){
        var x = Math.floor(Math.random() * gridScale);
        var y = Math.floor(Math.random() * gridScale);
        if(myGrid.myMatrix[x][y] == 0){
            myGrid.myMatrix[x][y] = -1;
            freePlace = true;
        }
    } 
}

function spawnWall(){
    freePlace = false;
    while(!freePlace){
        var x = Math.floor(Math.random() * gridScale);
        var y = Math.floor(Math.random() * gridScale);
        if(myGrid.myMatrix[x][y] == 0 && x != myPlayer.posX && y != myPlayer.posY){
            myGrid.myMatrix[x][y] = -2;
            freePlace = true;
        }
    } 
}

function death(){
    window.clearInterval(interval);
    document.getElementById("game").appendChild(button);
    delete myPlayer;

    document.getElementById("gameOver").textContent = 'gameOver';
    /*
    for(var i = 0; i < gridScale; i++){
        for(var j = 0; j < gridScale; j++){
            myGrid.myMatrix[i][j] = 0;
        }
    }
    myGrid.myMatrix.draw();
    */
}
