//video controls
var items= document.getElementsByClassName("play-button");
for (i = 0; i < items.length; i++){
    items[i].onclick = function(env){
        if (env.composedPath()[1].children[1].paused) {
            env.composedPath()[1].children[1].play(); 
        }
        else {
            env.composedPath()[1].children[1].pause(); 
        }
    }
}